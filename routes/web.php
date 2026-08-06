<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\BlogController as AdminBlogController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\BlogController as PublicBlogController;
use App\Http\Controllers\Admin\VideoController as AdminVideoController;
use App\Http\Controllers\VideoController as PublicVideoController;
use App\Http\Controllers\EbookController as PublicEbookController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\HeroController;
use App\Http\Controllers\Admin\CarouselController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\GalleryAdopsiController;
use App\Http\Controllers\Admin\EbookController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\AdopsiPublicController;
use App\Http\Controllers\Member\AdopsiController as MemberAdopsiController;
use App\Http\Controllers\Admin\AdopsiController as AdminAdopsiController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ModerasiController as AdminModerasiController;
use App\Http\Controllers\Admin\PerangkatDesaController;
use App\Http\Controllers\Admin\TimProklimController;

/*
|--------------------------------------------------------------------------
| Halaman Publik
|--------------------------------------------------------------------------
*/

Route::get('/', [PublicBlogController::class, 'home'])->name('home');
Route::get('/pustaka', [HomeController::class, 'pustaka'])->name('pustaka');
Route::get('/pustaka/kategori/{slug}', [HomeController::class, 'pustakaByCategory'])->name('pustaka.kategori');
Route::redirect('/ebook', '/pustaka');
Route::redirect('/video', '/pustaka');

// Ebook Publik
Route::get('/pustaka/ebook/{ebook}', [PublicEbookController::class, 'show'])->name('ebook.show');
Route::get('/pustaka/ebook/{ebook}/download', [PublicEbookController::class, 'download'])->name('ebook.download');
Route::get('/destinasi', function () { return redirect('/tentang#wisata'); })->name('destinasi');
Route::get('/tentang', [App\Http\Controllers\TentangController::class, 'index'])->name('tentang');
Route::redirect('/temukan-kami', '/tentang#kontak')->name('temukan');
Route::redirect('/lokasi', '/tentang#kontak');

// Testimonial / Kesan Pengunjung Publik
Route::get('/testimoni', [TestimonialController::class, 'index'])->name('testimoni.index');
Route::get('/testimoni/isi', [TestimonialController::class, 'create'])->name('testimoni.create');
Route::post('/testimoni/store', [TestimonialController::class, 'store'])->name('testimoni.store');

// Destinasi Detail Pages
Route::view('/destinasi/pantai-karang-jahe', 'destinations.pantai-karang-jahe')->name('destinasi.pantai-karang-jahe');
Route::view('/destinasi/situs-perahu-kuno', 'destinations.situs-perahu-kuno')->name('destinasi.situs-perahu-kuno');

// Blog Publik
Route::prefix('blog')->name('blog.')->group(function () {
    Route::redirect('/', '/pustaka')->name('index');
    Route::get('/{slug}', [PublicBlogController::class, 'show'])->name('show');
});

// Video Publik
Route::prefix('video')->name('video.')->group(function () {
    Route::redirect('/', '/pustaka')->name('index');
    Route::get('/{slug}', [PublicVideoController::class, 'show'])->name('show');
});

Route::post('/kirim-pesan', [ContactController::class, 'store'])->name('contact.store');

/*
|--------------------------------------------------------------------------
| Modul My Cemara (Publik)
|--------------------------------------------------------------------------
*/
Route::prefix('adopsi')->name('adopsi.')->group(function () {
    Route::get('/', [AdopsiPublicController::class, 'index'])->name('index');
    Route::get('/paket/{paket}', [AdopsiPublicController::class, 'show'])->name('show');
});

/*
|--------------------------------------------------------------------------
| Auth (Login Terpisah User & Admin / Register / Logout)
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

// Login User / Member
Route::get('/login/user', [AuthController::class, 'showUserLogin'])->name('login.user');
Route::post('/login/user', [AuthController::class, 'userLogin'])->name('login.user.submit');

// Login Admin
Route::get('/login/admin', [AuthController::class, 'showAdminLogin'])->name('login.admin');
Route::post('/login/admin', [AuthController::class, 'adminLogin'])->name('login.admin.submit');

// Registrasi
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/daftar', [AuthController::class, 'showMemberRegister'])->name('member.register');
Route::post('/daftar', [AuthController::class, 'memberRegister']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Member Dashboard & Management (My Cemara)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:member'])->prefix('member')->name('member.')->group(function () {
    Route::get('/adopsi', [MemberAdopsiController::class, 'dashboard'])->name('adopsi.dashboard');
    Route::get('/adopsi/buat/{paket}', [MemberAdopsiController::class, 'create'])->name('adopsi.create');
    Route::post('/adopsi', [MemberAdopsiController::class, 'store'])->name('adopsi.store');
    Route::get('/adopsi/{adopsi}', [MemberAdopsiController::class, 'show'])->name('adopsi.show');
    Route::get('/adopsi/{adopsi}/bayar', [MemberAdopsiController::class, 'bayar'])->name('adopsi.bayar');
    Route::post('/adopsi/{adopsi}/bayar', [MemberAdopsiController::class, 'uploadBukti'])->name('adopsi.bayar.upload');
    Route::get('/pohon/{pohon}/sertifikat', [MemberAdopsiController::class, 'sertifikat'])->name('pohon.sertifikat');
    Route::get('/pohon/{pohon}/sertifikat/download', [MemberAdopsiController::class, 'sertifikatWord'])->name('pohon.sertifikat.download');
});

/*
|--------------------------------------------------------------------------
| Admin (Proteksi Auth & Role Admin)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

    // Admin Landing Page Redirects to Moderasi Hub
    Route::get('/', function () {
        return redirect()->route('admin.moderasi.index');
    })->name('dashboard');
    Route::get('/dashboard', function () {
        return redirect()->route('admin.moderasi.index');
    });

    // Admin Moderasi Gabungan (Testimoni + Pesan + Adopsi)
    Route::get('/moderasi', [AdminModerasiController::class, 'index'])->name('moderasi.index');

    // CRUD Blog Admin
    Route::resource('/blog', AdminBlogController::class);

    // CRUD Kategori Berita Admin
    Route::resource('/categories', AdminCategoryController::class)->except(['show']);

    // Konten Unggulan di Beranda
    Route::post('/featured/{type}/mode',  [\App\Http\Controllers\Admin\FeaturedController::class, 'updateMode'])->name('featured.mode');
    Route::post('/featured/{type}/items', [\App\Http\Controllers\Admin\FeaturedController::class, 'updateItems'])->name('featured.items');

    // Inline Image Upload for TinyMCE
    Route::post('/berita/upload-image', [\App\Http\Controllers\Admin\BeritaImageController::class, 'store'])->name('berita.image.upload');

    // CRUD Video Admin
    Route::resource('/video', AdminVideoController::class);

    // Pesan Masuk Admin
    Route::get('/pesan', [ContactMessageController::class, 'index'])->name('pesan.index');
    Route::patch('/pesan/{id}/read', [ContactMessageController::class, 'markAsRead'])->name('pesan.read');
    Route::post('/pesan/read-all', [ContactMessageController::class, 'markAllAsRead'])->name('pesan.read-all');

    // CRUD Perangkat Desa
    Route::get('/perangkat-desa', [PerangkatDesaController::class, 'index'])->name('perangkat-desa.index');
    Route::get('/perangkat-desa/create', [PerangkatDesaController::class, 'create'])->name('perangkat-desa.create');
    Route::post('/perangkat-desa', [PerangkatDesaController::class, 'store'])->name('perangkat-desa.store');
    Route::get('/perangkat-desa/{id}/edit', [PerangkatDesaController::class, 'edit'])->name('perangkat-desa.edit');
    Route::put('/perangkat-desa/{id}', [PerangkatDesaController::class, 'update'])->name('perangkat-desa.update');
    Route::delete('/perangkat-desa/{id}', [PerangkatDesaController::class, 'destroy'])->name('perangkat-desa.destroy');

    // CRUD Tim ProKlim
    Route::get('/tim-proklim', [TimProklimController::class, 'index'])->name('tim-proklim.index');
    Route::get('/tim-proklim/create', [TimProklimController::class, 'create'])->name('tim-proklim.create');
    Route::post('/tim-proklim', [TimProklimController::class, 'store'])->name('tim-proklim.store');
    Route::get('/tim-proklim/{id}/edit', [TimProklimController::class, 'edit'])->name('tim-proklim.edit');
    Route::put('/tim-proklim/{id}', [TimProklimController::class, 'update'])->name('tim-proklim.update');
    Route::delete('/tim-proklim/{id}', [TimProklimController::class, 'destroy'])->name('tim-proklim.destroy');

    // Ubah Hero Background
    Route::get('/hero', [HeroController::class, 'edit'])->name('hero.edit');
    Route::post('/hero', [HeroController::class, 'update'])->name('hero.update');
    Route::post('/hero/update-custom', [HeroController::class, 'updateCustom'])->name('hero.update-custom');
    Route::post('/hero/restore', [HeroController::class, 'restore'])->name('hero.restore');
    Route::post('/about-image', [HeroController::class, 'updateAboutImage'])->name('about-image.update');
    Route::post('/culture-image', [HeroController::class, 'updateCultureImage'])->name('culture-image.update');

    // CRUD Carousel Admin
    Route::post('/carousel', [CarouselController::class, 'store'])->name('carousel.store');
    Route::put('/carousel/{id}', [CarouselController::class, 'update'])->name('carousel.update');
    Route::delete('/carousel/{id}', [CarouselController::class, 'destroy'])->name('carousel.destroy');

    // CRUD Gallery Admin
    Route::post('/gallery', [GalleryController::class, 'store'])->name('gallery.store');
    Route::put('/gallery/{id}', [GalleryController::class, 'update'])->name('gallery.update');
    Route::delete('/gallery/{id}', [GalleryController::class, 'destroy'])->name('gallery.destroy');

    // CRUD Gallery Adopsi Admin
    Route::post('/gallery-adopsi', [GalleryAdopsiController::class, 'store'])->name('gallery-adopsi.store');
    Route::put('/gallery-adopsi/{id}', [GalleryAdopsiController::class, 'update'])->name('gallery-adopsi.update');
    Route::delete('/gallery-adopsi/{id}', [GalleryAdopsiController::class, 'destroy'])->name('gallery-adopsi.destroy');

    // CRUD Ebook Admin
    Route::post('/ebook', [EbookController::class, 'store'])->name('ebook.store');
    Route::put('/ebook/{id}', [EbookController::class, 'update'])->name('ebook.update');
    Route::delete('/ebook/{id}', [EbookController::class, 'destroy'])->name('ebook.destroy');

    // Moderasi Testimoni Admin
    Route::get('/testimoni', [TestimonialController::class, 'adminIndex'])->name('testimoni.index');
    Route::patch('/testimoni/{id}/approve', [TestimonialController::class, 'approve'])->name('testimoni.approve');
    Route::delete('/testimoni/{id}', [TestimonialController::class, 'destroy'])->name('testimoni.destroy');

    // Admin Adopsi Cemara
    Route::prefix('adopsi')->name('adopsi.')->group(function () {
        Route::get('/', [AdminAdopsiController::class, 'index'])->name('index');
        Route::get('/{adopsi}', [AdminAdopsiController::class, 'show'])->name('show');
        Route::post('/{adopsi}/verifikasi', [AdminAdopsiController::class, 'verifikasi'])->name('verifikasi');
        Route::post('/{adopsi}/tolak', [AdminAdopsiController::class, 'tolak'])->name('tolak');
        Route::post('/pohon/{pohon}/monitoring', [AdminAdopsiController::class, 'storeMonitoring'])->name('monitoring.store');
    });
});

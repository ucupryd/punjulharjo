<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\BlogController as AdminBlogController;
use App\Http\Controllers\BlogController as PublicBlogController;
use App\Http\Controllers\Admin\VideoController as AdminVideoController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\VideoController as PublicVideoController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\HeroController;

/*
|--------------------------------------------------------------------------
| Halaman Publik
|--------------------------------------------------------------------------
*/

Route::get('/', [PublicBlogController::class, 'home'])->name('home');
Route::view('/tentang', 'tentang')->name('tentang');
Route::view('/temukan-kami', 'temukan-kami')->name('temukan');

// Destinasi Detail Pages
Route::view('/destinasi/pantai-karang-jahe', 'destinations.pantai-karang-jahe')->name('destinasi.pantai-karang-jahe');
Route::view('/destinasi/situs-perahu-kuno', 'destinations.situs-perahu-kuno')->name('destinasi.situs-perahu-kuno');

// Blog Publik
Route::prefix('blog')->name('blog.')->group(function () {
    Route::get('/', [PublicBlogController::class, 'index'])->name('index');
    Route::get('/{slug}', [PublicBlogController::class, 'show'])->name('show');
});

// Video Publik
Route::prefix('video')->name('video.')->group(function () {
    Route::get('/', [PublicVideoController::class, 'index'])->name('index');
    Route::get('/{slug}', [PublicVideoController::class, 'show'])->name('show');
});

Route::post('/kirim-pesan', [ContactController::class, 'store'])->name('contact.store');


/*
|--------------------------------------------------------------------------
| Auth (Login/Logout Admin)
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


/*
|--------------------------------------------------------------------------
| Admin (Proteksi Auth)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // CRUD Blog Admin
    Route::resource('/blog', AdminBlogController::class);

    // CRUD Video Admin
    Route::resource('/video', AdminVideoController::class);

    // Hanya lihat pesan (read-only)
    Route::get('/pesan', [ContactMessageController::class, 'index'])->name('pesan.index');

    // 🔹 Tambah route untuk ubah hero background
    Route::get('/hero', [HeroController::class, 'edit'])->name('hero.edit');
    Route::post('/hero', [HeroController::class, 'update'])->name('hero.update');
});

@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    @php
        $heroBg = \App\Models\SiteSetting::getValue('hero_background');
        $heroBgUrl = $heroBg 
            ? (str_starts_with($heroBg, 'http') || str_contains($heroBg, 'storage/') ? asset($heroBg) : Storage::url($heroBg)) 
            : asset('images/hero-bg.jpg');
    @endphp

    <section class="relative text-center min-h-[60vh] flex flex-col justify-center items-center bg-transparent">
        <div class="absolute inset-0 bg-center bg-cover bg-no-repeat"
             style="background-image: url('{{ $heroBgUrl }}');">
        </div>
        <div class="absolute inset-0 bg-slate-950/40"></div>

        <div class="relative z-10 px-4 mt-16">
            <h1 class="text-3xl md:text-6xl font-heading text-white mb-4 drop-shadow-lg md:whitespace-nowrap">
                Lokasi Kami
            </h1>
            <p class="text-base md:text-xl text-gray-100 max-w-2xl mx-auto drop-shadow opacity-90">
                Kunjungi Desa Wisata Punjulharjo dan rasakan langsung keindahan budaya serta pesonanya.
            </p>
        </div>

        <!-- Multi-layered Aesthetic Wave Divider -->
        <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-none z-10">
            <svg class="relative block w-full h-[80px]" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <!-- Layer 1: Back Wave (Translucent Sky-Blue) -->
                <path d="M0,90 C320,130,420,40,740,70 C1040,95,1120,60,1200,80 L1200,120 L0,120 Z" fill="rgba(14, 165, 233, 0.2)"></path>
                <!-- Layer 2: Middle Wave (Translucent White) -->
                <path d="M0,60 C240,90,380,30,700,60 C1000,85,1080,45,1200,55 L1200,120 L0,120 Z" fill="rgba(255, 255, 255, 0.35)"></path>
                <!-- Layer 3: Front Wave (Translucent White/Cream) -->
                <path d="M0,30 C150,60,350,10,600,40 C850,70,1050,30,1200,40 L1200,120 L0,120 Z" fill="rgba(255, 255, 255, 0.5)"></path>
            </svg>
        </div>
    </section>

    <!-- Lokasi Kami -->
    <section class="py-10 md:py-20 bg-transparent px-4 md:px-6">
        <div class="max-w-5xl mx-auto text-center">
            <h2 class="text-2xl md:text-4xl font-heading text-sky-600 mb-6 md:mb-8">Lokasi Kami</h2>
            <p class="text-gray-700 leading-relaxed max-w-3xl mx-auto mb-6 md:mb-10 text-sm md:text-base">
                Desa Punjulharjo terletak di Kecamatan Rembang, Kabupaten Rembang, Jawa Tengah.
                Desa ini dapat dijangkau dengan mudah menggunakan kendaraan pribadi maupun umum,
                sekitar <strong>5 km dari pusat kota Rembang</strong>.
            </p>

            <div class="rounded-none overflow-hidden shadow border border-sky-100 max-w-3xl mx-auto bg-white p-2">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15855.531271081694!2d111.3857503757342!3d-6.685363393311915!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e774775d710fa53%3A0xe54d6ea6a6c221a9!2sPunjulharjo%2C%20Kec.%20Rembang%2C%20Kabupaten%20Rembang%2C%20Jawa%20Tengah!5e0!3m2!1sid!2sid!4v1720680000000!5m2!1sid!2sid" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="border-none rounded-none"></iframe>
            </div>
        </div>
    </section>

    <!-- Kontak -->
    <section class="py-10 md:py-20 bg-sky-50/30 backdrop-blur-sm px-4 md:px-6">
        <div class="max-w-6xl mx-auto grid md:grid-cols-2 gap-8 md:gap-12 items-center">
            <div>
                <h2 class="text-2xl md:text-4xl font-heading text-sky-600 mb-4 md:mb-6">Hubungi Kami</h2>
                <p class="text-gray-700 mb-4 md:mb-6 text-sm md:text-base">
                    Jika kamu ingin mengetahui lebih banyak tentang kegiatan wisata, event budaya, atau ingin berkolaborasi
                    dengan kami — jangan ragu untuk menghubungi tim Desa Wisata Punjulharjo.
                </p>

                <ul class="space-y-3 md:space-y-4 text-gray-700 text-sm md:text-base">
                    <li>
                        <strong>📍 Alamat Desa Wisata:</strong><br>
                        <a href="https://maps.app.goo.gl/jhFMynBy4wUFiuCA7" target="_blank" class="hover:text-sky-600 transition">Punjulharjo, Kec. Rembang, Kabupaten Rembang, Jawa Tengah 59219</a>
                    </li>
                    <li><strong>📞 Telepon:</strong> +62 812 3456 7890</li>
                    <li><strong>✉️ Email:</strong> info@desapunjulharjo.id</li>
                    <li><strong>👁️ Jam Operasional:</strong> 08.00 - 17.00 WIB</li>
                </ul>

                <div class="flex space-x-3 mt-6">
                    <a href="https://www.instagram.com/desawisatapunjulharjo/" target="_blank" 
                       class="w-10 h-10 rounded-full bg-slate-100 text-slate-700 flex items-center justify-center hover:bg-[#e1306c] hover:text-white transition-all duration-300 shadow-sm" 
                       title="Instagram">
                        <i class="fa-brands fa-instagram text-lg"></i>
                    </a>
                    <a href="https://www.youtube.com/@desawisatapunjulharjo9639" target="_blank" 
                       class="w-10 h-10 rounded-full bg-slate-100 text-slate-700 flex items-center justify-center hover:bg-[#ff0000] hover:text-white transition-all duration-300 shadow-sm" 
                       title="YouTube">
                        <i class="fa-brands fa-youtube text-lg"></i>
                    </a>
                    <a href="https://www.tiktok.com/@desawisata.punjul" target="_blank" 
                       class="w-10 h-10 rounded-full bg-slate-100 text-slate-700 flex items-center justify-center hover:bg-black hover:text-white transition-all duration-300 shadow-sm" 
                       title="TikTok">
                        <i class="fa-brands fa-tiktok text-lg"></i>
                    </a>
                </div>
            </div>

            <div class="bg-white rounded-none shadow p-6 md:p-8 border border-slate-200">
                <h3 class="text-xl md:text-2xl font-heading text-sky-600 mb-4 text-center">Kirim Pesan</h3>

                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded-none mb-4 text-center">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('contact.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-left text-gray-700 mb-2" for="name">Nama</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}"
                            class="w-full border border-gray-300 rounded-none px-4 py-2 focus:ring focus:ring-sky-300 outline-none"
                            placeholder="Nama lengkap" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-left text-gray-700 mb-2" for="email">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                            class="w-full border border-gray-300 rounded-none px-4 py-2 focus:ring focus:ring-sky-300 outline-none"
                            placeholder="Email aktif" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-left text-gray-700 mb-2" for="message">Pesan</label>
                        <textarea id="message" name="message" rows="4"
                            class="w-full border border-gray-300 rounded-none px-4 py-2 focus:ring focus:ring-sky-300 outline-none"
                            placeholder="Tulis pesan kamu di sini..." required>{{ old('message') }}</textarea>
                    </div>

                    <button type="submit"
                        class="w-full bg-sky-500 hover:bg-sky-600 text-white font-medium py-2 rounded-none transition">
                        Kirim Pesan
                    </button>
                </form>
            </div>

        </div>
    </section>

    <!-- Akses Transportasi -->
    <section class="py-10 md:py-20 bg-transparent px-4 md:px-6">
        <div class="max-w-5xl mx-auto text-center">
            <h2 class="text-2xl md:text-4xl font-heading text-sky-600 mb-6 md:mb-8">Akses ke Desa Wisata Punjulharjo</h2>
            <p class="text-gray-700 mb-6 md:mb-10 text-sm md:text-base">
                Kamu bisa mencapai desa wisata ini menggunakan berbagai moda transportasi. Berikut panduan rutenya:
            </p>
            <div class="grid md:grid-cols-3 gap-6 md:gap-10 text-left">
                <div class="p-5 md:p-6 bg-white rounded-none shadow-sm hover:shadow transition border border-sky-100">
                    <h3 class="text-xl font-heading mb-2 text-sky-600">🚗 Kendaraan Pribadi</h3>
                    <p class="text-gray-700 text-sm leading-relaxed">
                        Dari Kota Rembang, ambil arah timur menuju Pantai Karang Jahe. Setelah 5 km, kamu akan menemukan
                        penunjuk arah ke Desa Punjulharjo.
                    </p>
                </div>
                <div class="p-5 md:p-6 bg-white rounded-none shadow-sm hover:shadow transition border border-sky-100">
                    <h3 class="text-xl font-heading mb-2 text-sky-600">🚌 Transportasi Umum</h3>
                    <p class="text-gray-700 text-sm leading-relaxed">
                        Naik bus jurusan Rembang - Lasem, turun di perempatan Punjulharjo, lalu lanjut dengan ojek lokal
                        sekitar 10 menit.
                    </p>
                </div>
                <div class="p-5 md:p-6 bg-white rounded-none shadow-sm hover:shadow transition border border-sky-100">
                    <h3 class="text-xl font-heading mb-2 text-sky-600">🚴‍♂️ Wisata Sepeda</h3>
                    <p class="text-gray-700 text-sm leading-relaxed">
                        Untuk pecinta petualangan, rute bersepeda dari Kota Rembang menuju Punjulharjo menawarkan
                        pemandangan sawah dan pantai yang indah.
                    </p>
                </div>
            </div>
        </div>
    </section>
@endsection
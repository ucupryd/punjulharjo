@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    @php
        $heroBg = \App\Models\SiteSetting::getValue('hero_background', asset('images/hero-bg.jpg'));
    @endphp

    <section class="relative text-center min-h-[60vh] flex flex-col justify-center items-center bg-transparent">
        <div class="absolute inset-0 bg-center bg-cover bg-no-repeat"
             style="background-image: url('{{ asset($heroBg) }}');">
        </div>
        <div class="absolute inset-0 bg-slate-950/40"></div>

        <div class="relative z-10 px-4 mt-16">
            <h1 class="text-5xl md:text-6xl font-heading text-white mb-4 drop-shadow-lg whitespace-nowrap">
                Temukan Kami
            </h1>
            <p class="text-lg md:text-xl text-gray-100 max-w-2xl mx-auto drop-shadow opacity-90">
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
    <section class="py-20 bg-transparent px-6">
        <div class="max-w-5xl mx-auto text-center">
            <h2 class="text-3xl md:text-4xl font-heading text-sky-600 mb-8">Lokasi Kami</h2>
            <p class="text-gray-700 leading-relaxed max-w-3xl mx-auto mb-10">
                Desa Punjulharjo terletak di Kecamatan Rembang, Kabupaten Rembang, Jawa Tengah.
                Desa ini dapat dijangkau dengan mudah menggunakan kendaraan pribadi maupun umum,
                sekitar <strong>5 km dari pusat kota Rembang</strong>.
            </p>

            <div class="rounded-xl overflow-hidden shadow-lg border border-sky-100 max-w-3xl mx-auto bg-white/80 backdrop-blur-sm p-2">
                <iframe src="https://www.google.com/maps?q=Punjulharjo,Rembang&output=embed" width="100%" height="400"
                    class="border-none rounded-lg">
                </iframe>
            </div>
        </div>
    </section>

    <!-- Kontak -->
    <section class="py-20 bg-sky-50/30 backdrop-blur-sm px-6">
        <div class="max-w-6xl mx-auto grid md:grid-cols-2 gap-12 items-center">
            <div>
                <h2 class="text-3xl md:text-4xl font-heading text-sky-600 mb-6">Hubungi Kami</h2>
                <p class="text-gray-700 mb-6">
                    Jika kamu ingin mengetahui lebih banyak tentang kegiatan wisata, event budaya, atau ingin berkolaborasi
                    dengan kami — jangan ragu untuk menghubungi tim Desa Wisata Punjulharjo.
                </p>

                <ul class="space-y-4 text-gray-700">
                    <li><strong>📍 Alamat:</strong> Punjulharjo, Kec. Rembang, Kabupaten Rembang, Jawa Tengah 59219</li>
                    <li><strong>📞 Telepon:</strong> +62 812 3456 7890</li>
                    <li><strong>✉️ Email:</strong> info@desapunjulharjo.id</li>
                    <li><strong>🕓 Jam Operasional:</strong> 08.00 - 17.00 WIB</li>
                </ul>

                <div class="flex space-x-4 mt-6">
                    <a href="#" class="text-sky-600 hover:text-sky-800 transition"><i
                            class="fa-brands fa-facebook text-2xl"></i></a>
                    <a href="#" class="text-sky-600 hover:text-sky-800 transition"><i
                            class="fa-brands fa-instagram text-2xl"></i></a>
                    <a href="#" class="text-sky-600 hover:text-sky-800 transition"><i
                            class="fa-brands fa-youtube text-2xl"></i></a>
                </div>
            </div>

            <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-lg p-8 border border-slate-100">
                <h3 class="text-2xl font-heading text-sky-600 mb-4 text-center">Kirim Pesan</h3>

                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4 text-center">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('contact.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-left text-gray-700 mb-2" for="name">Nama</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring focus:ring-sky-300 outline-none"
                            placeholder="Nama lengkap" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-left text-gray-700 mb-2" for="email">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring focus:ring-sky-300 outline-none"
                            placeholder="Email aktif" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-left text-gray-700 mb-2" for="message">Pesan</label>
                        <textarea id="message" name="message" rows="4"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring focus:ring-sky-300 outline-none"
                            placeholder="Tulis pesan kamu di sini..." required>{{ old('message') }}</textarea>
                    </div>

                    <button type="submit"
                        class="w-full bg-sky-500 hover:bg-sky-600 text-white font-medium py-2 rounded-lg transition">
                        Kirim Pesan
                    </button>
                </form>
            </div>

        </div>
    </section>

    <!-- Akses Transportasi -->
    <section class="py-20 bg-transparent px-6">
        <div class="max-w-5xl mx-auto text-center">
            <h2 class="text-3xl md:text-4xl font-heading text-sky-600 mb-8">Akses ke Desa Wisata Punjulharjo</h2>
            <p class="text-gray-700 mb-10">
                Kamu bisa mencapai desa wisata ini menggunakan berbagai moda transportasi. Berikut panduan rutenya:
            </p>
            <div class="grid md:grid-cols-3 gap-10 text-left">
                <div class="p-6 bg-sky-50/50 backdrop-blur-sm rounded-xl shadow hover:shadow-lg transition border border-sky-100">
                    <h3 class="text-xl font-heading mb-2 text-sky-600">🚗 Kendaraan Pribadi</h3>
                    <p class="text-gray-700 text-sm leading-relaxed">
                        Dari Kota Rembang, ambil arah timur menuju Pantai Karang Jahe. Setelah 5 km, kamu akan menemukan
                        penunjuk arah ke Desa Punjulharjo.
                    </p>
                </div>
                <div class="p-6 bg-sky-50/50 backdrop-blur-sm rounded-xl shadow hover:shadow-lg transition border border-sky-100">
                    <h3 class="text-xl font-heading mb-2 text-sky-600">🚌 Transportasi Umum</h3>
                    <p class="text-gray-700 text-sm leading-relaxed">
                        Naik bus jurusan Rembang - Lasem, turun di perempatan Punjulharjo, lalu lanjut dengan ojek lokal
                        sekitar 10 menit.
                    </p>
                </div>
                <div class="p-6 bg-sky-50/50 backdrop-blur-sm rounded-xl shadow hover:shadow-lg transition border border-sky-100">
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
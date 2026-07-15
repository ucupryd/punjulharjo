@extends('layouts.app')

@section('content')
<div class="pt-24 bg-slate-100 min-h-screen">
    <!-- SECTION C: Top Destinations (Destinasi Unggulan) -->
    <section class="bg-slate-100 border-t border-b border-slate-200 py-12 md:py-24 px-4 md:px-12 relative">
        <div class="max-w-6xl mx-auto">
            <div class="text-center space-y-4 mb-16">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-none bg-sky-50 text-sky-600 text-sm font-semibold uppercase tracking-wider border border-sky-100">
                    <i class="fa-solid fa-map-location-dot"></i> Eksplorasi Wisata
                </div>
                <h2 class="text-2xl md:text-5xl font-heading text-gray-900 tracking-wide">
                    Destinasi Unggulan
                </h2>
                <p class="text-gray-500 font-sans max-w-xl mx-auto text-sm md:text-base">
                    Kunjungi tempat wisata favorit di Punjulharjo yang memiliki daya tarik tersendiri bagi wisatawan.
                </p>
            </div>

            <!-- Destinasi Grid Layout with no harsh borders -->
            <div class="grid grid-cols-2 gap-3 md:gap-12">
                <!-- Card 1: Pantai Karang Jahe -->
                <a href="{{ route('destinasi.pantai-karang-jahe') }}" class="group relative bg-white rounded-none shadow hover:shadow-md transition-all duration-500 overflow-hidden flex flex-col justify-between h-full border border-gray-200">
                    <div class="overflow-hidden aspect-[16/10] relative">
                        <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=800&q=80" 
                             alt="Pantai Karang Jahe" 
                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                        
                        <!-- Floating Tag -->
                        <span class="absolute top-2 left-2 md:top-4 md:left-4 bg-white/90 px-2 py-1 md:px-4 md:py-1.5 rounded-none text-slate-800 text-[9px] md:text-xs font-bold uppercase tracking-wider flex items-center gap-1 md:gap-1.5 border border-slate-200/50 shadow-sm">
                            <svg class="w-3 h-3 md:w-3.5 md:h-3.5 text-sky-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M22 12h-20a10 10 0 0 1 20 0Z" />
                                <path d="M12 12v10" />
                                <path d="M12 21a2 2 0 0 0 2-2" />
                            </svg>
                            Wisata Pantai
                        </span>
                    </div>
                    
                    <div class="p-3 md:p-8 space-y-2 md:space-y-4 flex-grow flex flex-col justify-between">
                        <div>
                            <h3 class="text-sm md:text-2xl font-bold text-gray-900 font-sans group-hover:text-sky-600 transition duration-300 flex items-center justify-between">
                                Pantai Karang Jahe
                                <i class="fa-solid fa-arrow-right text-sky-500 text-sm md:text-lg opacity-0 group-hover:opacity-100 transition-all duration-300 group-hover:translate-x-1"></i>
                            </h3>
                            <p class="text-gray-600 font-sans text-[10px] md:text-base leading-relaxed text-justify mt-1.5 md:mt-3 line-clamp-2 md:line-clamp-none">
                                Pantai Karang Jahe merupakan salah satu destinasi wisata paling dikenal di Desa Punjulharjo. Menghadirkan suasana rekreasi yang nyaman dengan panorama pesisir yang menenangkan, hamparan pasir putih yang lembut, dan air laut yang relatif tenang. Nama Karang Jahe sendiri berasal dari bentuk karang-karang kecil di kawasan pantai yang dianggap menyerupai jahe.
                            </p>
                        </div>
                    </div>
                </a>

                <!-- Card 2: Situs Perahu Kuno -->
                <a href="{{ route('destinasi.situs-perahu-kuno') }}" class="group relative bg-white rounded-none shadow hover:shadow-md transition-all duration-500 overflow-hidden flex flex-col justify-between h-full border border-gray-200">
                    <div class="overflow-hidden aspect-[16/10] relative">
                        <img src="https://images.unsplash.com/photo-1559136555-9303baea8ebd?auto=format&fit=crop&w=800&q=80" 
                             alt="Situs Perahu Kuno" 
                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                        
                        <!-- Floating Tag -->
                        <span class="absolute top-2 left-2 md:top-4 md:left-4 bg-white/90 px-2 py-1 md:px-4 md:py-1.5 rounded-none text-slate-800 text-[9px] md:text-xs font-bold uppercase tracking-wider flex items-center gap-1 md:gap-1.5 border border-slate-200/50 shadow-sm">
                            <svg class="w-3 h-3 md:w-3.5 md:h-3.5 text-indigo-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="5" r="3" />
                                <path d="M12 22V8" />
                                <path d="M5 12H2a10 10 0 0 0 20 0h-3" />
                            </svg>
                            Wisata Sejarah
                        </span>
                    </div>
                    
                    <div class="p-3 md:p-8 space-y-2 md:space-y-4 flex-grow flex flex-col justify-between">
                        <div>
                            <h3 class="text-sm md:text-2xl font-bold text-gray-900 font-sans group-hover:text-sky-600 transition duration-300 flex items-center justify-between">
                                Situs Perahu Kuno
                                <i class="fa-solid fa-arrow-right text-indigo-500 text-sm md:text-lg opacity-0 group-hover:opacity-100 transition-all duration-300 group-hover:translate-x-1"></i>
                            </h3>
                            <p class="text-gray-600 font-sans text-[10px] md:text-base leading-relaxed text-justify mt-1.5 md:mt-3 line-clamp-2 md:line-clamp-none">
                                Selain pantai, Punjulharjo juga memiliki Situs Perahu Kuno yang diperkirakan berasal dari abad ke-7 Masehi. Situs ini menyimpan nilai sejarah tinggi sebagai peninggalan arkeologis yang sangat penting bagi pemahaman sejarah maritim Indonesia, menjadi bukti bahwa masyarakat Nusantara telah memiliki kemampuan pelayaran yang maju sejak berabad-abad lalu.
                            </p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </section>
</div>
@endsection

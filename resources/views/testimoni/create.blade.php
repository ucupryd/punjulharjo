@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-slate-900 relative flex items-center justify-center py-20 px-4 md:px-8 overflow-hidden font-sans">
    <!-- Blurred Background Image of Pantai Karang Jahe -->
    <div class="absolute inset-0 bg-cover bg-center z-0 opacity-40 scale-105 filter blur-lg" 
         style="background-image: url('https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=1200&q=80');"></div>
    <!-- Dark overlay to ensure text readability -->
    <div class="absolute inset-0 bg-slate-950/80 z-0"></div>

    <div class="w-full max-w-lg bg-white/10 backdrop-blur-xl border border-white/20 rounded-none shadow-2xl p-6 md:p-8 relative z-10 text-white animate-fade-in">
        
        <!-- Header -->
        <div class="text-center mb-6">
            <h2 class="text-2xl md:text-3xl font-heading text-brand-accent tracking-wide drop-shadow-md">
                Kesan Kunjungan Anda
            </h2>
            <p class="text-xs md:text-sm text-slate-300 mt-2">
                Bagikan senyum & ceritamu di Punjulharjo, dapatkan kesempatan tampil di Website Resmi Kami!
            </p>
        </div>

        @if(session('success'))
            <div class="bg-emerald-500/25 border border-emerald-500 text-emerald-200 p-4 mb-6 rounded-none text-sm text-center animate-pulse">
                <i class="fa-solid fa-circle-check mr-2 text-emerald-400"></i> {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('testimoni.store') }}" method="POST" enctype="multipart/form-data" id="testimonialForm">
            @csrf

            <!-- Progress Tracker -->
            <div class="flex items-center justify-between mb-8 px-4">
                <div class="flex flex-col items-center step-indicator" data-step="1">
                    <span class="w-8 h-8 rounded-full bg-brand-accent text-brand-dark flex items-center justify-center font-bold text-sm border-2 border-brand-accent transition duration-300">1</span>
                    <span class="text-[10px] text-slate-300 mt-1 font-semibold">Identitas</span>
                </div>
                <div class="flex-grow h-0.5 bg-white/20 mx-2 -mt-4 step-line" data-step="1"></div>
                <div class="flex flex-col items-center step-indicator" data-step="2">
                    <span class="w-8 h-8 rounded-full bg-slate-800 text-slate-400 flex items-center justify-center font-bold text-sm border-2 border-white/10 transition duration-300">2</span>
                    <span class="text-[10px] text-slate-400 mt-1">Preferensi</span>
                </div>
                <div class="flex-grow h-0.5 bg-white/20 mx-2 -mt-4 step-line" data-step="2"></div>
                <div class="flex flex-col items-center step-indicator" data-step="3">
                    <span class="w-8 h-8 rounded-full bg-slate-800 text-slate-400 flex items-center justify-center font-bold text-sm border-2 border-white/10 transition duration-300">3</span>
                    <span class="text-[10px] text-slate-400 mt-1">Kesan</span>
                </div>
            </div>

            <!-- STEP 1: IDENTITAS & RATING -->
            <div class="step-content space-y-5" id="step1">
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-300 mb-2">Nama Panggilan / Singkat</label>
                    <input type="text" name="name" maxlength="50" class="w-full bg-white/10 border border-white/20 rounded-none px-4 py-3 text-white text-sm focus:outline-none focus:border-brand-accent placeholder-slate-400 transition" placeholder="Contoh: Rian" required>
                    @error('name') <span class="text-xs text-rose-400 mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-300 mb-2">Asal Kota / Kabupaten</label>
                    <input type="text" name="origin_city" maxlength="50" class="w-full bg-white/10 border border-white/20 rounded-none px-4 py-3 text-white text-sm focus:outline-none focus:border-brand-accent placeholder-slate-400 transition" placeholder="Contoh: Rembang" required>
                    @error('origin_city') <span class="text-xs text-rose-400 mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div class="text-center py-2">
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-300 mb-3">Tingkat Kepuasan Anda</label>
                    <div class="flex justify-center gap-3 text-3xl text-slate-400" id="ratingStars">
                        <i class="fa-solid fa-star cursor-pointer hover:scale-110 transition star-btn" data-value="1"></i>
                        <i class="fa-solid fa-star cursor-pointer hover:scale-110 transition star-btn" data-value="2"></i>
                        <i class="fa-solid fa-star cursor-pointer hover:scale-110 transition star-btn" data-value="3"></i>
                        <i class="fa-solid fa-star cursor-pointer hover:scale-110 transition star-btn" data-value="4"></i>
                        <i class="fa-solid fa-star cursor-pointer hover:scale-110 transition star-btn" data-value="5"></i>
                    </div>
                    <input type="hidden" name="rating" id="ratingInput" value="5" required>
                    <p class="text-xs text-slate-300 mt-2" id="ratingLabel">Sangat Memuaskan (5 / 5)</p>
                    @error('rating') <span class="text-xs text-rose-400 mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div class="pt-4 flex justify-end">
                    <button type="button" onclick="nextStep(2)" class="w-full md:w-auto bg-brand-accent text-brand-dark font-semibold px-6 py-3 hover:bg-white hover:text-brand-dark transition shadow duration-300">
                        Lanjut <i class="fa-solid fa-arrow-right ml-2"></i>
                    </button>
                </div>
            </div>

            <!-- STEP 2: PREFERENSI & KUNJUNGAN -->
            <div class="step-content space-y-5 hidden" id="step2">
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-300 mb-3">Destinasi Terfavorit Hari Ini</label>
                    <div class="grid grid-cols-2 gap-3">
                        <label class="relative block bg-white/5 border border-white/10 hover:border-brand-accent/50 p-3 text-center cursor-pointer select-none transition">
                            <input type="radio" name="favorite_destination" value="Pantai Karang Jahe" class="absolute top-2 right-2 accent-brand-accent" checked>
                            <i class="fa-solid fa-umbrella-beach text-brand-accent text-xl mb-1.5 block"></i>
                            <span class="text-xs font-bold block text-white leading-tight">Pantai Karang Jahe</span>
                        </label>
                        <label class="relative block bg-white/5 border border-white/10 hover:border-brand-accent/50 p-3 text-center cursor-pointer select-none transition">
                            <input type="radio" name="favorite_destination" value="Situs Perahu Kuno" class="absolute top-2 right-2 accent-brand-accent">
                            <i class="fa-solid fa-ship text-brand-accent text-xl mb-1.5 block"></i>
                            <span class="text-xs font-bold block text-white leading-tight">Situs Perahu Kuno</span>
                        </label>
                        <label class="relative block bg-white/5 border border-white/10 hover:border-brand-accent/50 p-3 text-center cursor-pointer select-none transition">
                            <input type="radio" name="favorite_destination" value="Wisata Kuliner" class="absolute top-2 right-2 accent-brand-accent">
                            <i class="fa-solid fa-utensils text-brand-accent text-xl mb-1.5 block"></i>
                            <span class="text-xs font-bold block text-white leading-tight">Wisata Kuliner</span>
                        </label>
                        <label class="relative block bg-white/5 border border-white/10 hover:border-brand-accent/50 p-3 text-center cursor-pointer select-none transition">
                            <input type="radio" name="favorite_destination" value="Desa Edukasi" class="absolute top-2 right-2 accent-brand-accent">
                            <i class="fa-solid fa-graduation-cap text-brand-accent text-xl mb-1.5 block"></i>
                            <span class="text-xs font-bold block text-white leading-tight">Desa Edukasi</span>
                        </label>
                    </div>
                    @error('favorite_destination') <span class="text-xs text-rose-400 mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-300 mb-3">Berkunjung Bersama Siapa?</label>
                    <div class="grid grid-cols-2 gap-3">
                        <label class="relative block bg-white/5 border border-white/10 hover:border-brand-accent/50 p-3 text-center cursor-pointer select-none transition">
                            <input type="radio" name="companion" value="Keluarga" class="absolute top-2 right-2 accent-brand-accent" checked>
                            <i class="fa-solid fa-people-roof text-brand-accent text-xl mb-1.5 block"></i>
                            <span class="text-xs font-semibold block text-white">Keluarga</span>
                        </label>
                        <label class="relative block bg-white/5 border border-white/10 hover:border-brand-accent/50 p-3 text-center cursor-pointer select-none transition">
                            <input type="radio" name="companion" value="Pasangan" class="absolute top-2 right-2 accent-brand-accent">
                            <i class="fa-solid fa-heart text-brand-accent text-xl mb-1.5 block"></i>
                            <span class="text-xs font-semibold block text-white">Pasangan</span>
                        </label>
                        <label class="relative block bg-white/5 border border-white/10 hover:border-brand-accent/50 p-3 text-center cursor-pointer select-none transition">
                            <input type="radio" name="companion" value="Teman/Rombongan" class="absolute top-2 right-2 accent-brand-accent">
                            <i class="fa-solid fa-users text-brand-accent text-xl mb-1.5 block"></i>
                            <span class="text-xs font-semibold block text-white">Teman / Rombongan</span>
                        </label>
                        <label class="relative block bg-white/5 border border-white/10 hover:border-brand-accent/50 p-3 text-center cursor-pointer select-none transition">
                            <input type="radio" name="companion" value="Sendiri" class="absolute top-2 right-2 accent-brand-accent">
                            <i class="fa-solid fa-user text-brand-accent text-xl mb-1.5 block"></i>
                            <span class="text-xs font-semibold block text-white">Sendiri</span>
                        </label>
                    </div>
                    @error('companion') <span class="text-xs text-rose-400 mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div class="pt-4 flex justify-between gap-3">
                    <button type="button" onclick="prevStep(1)" class="w-1/2 bg-slate-800 text-white font-semibold px-4 py-3 hover:bg-slate-700 transition">
                        <i class="fa-solid fa-arrow-left mr-2"></i> Kembali
                    </button>
                    <button type="button" onclick="nextStep(3)" class="w-1/2 bg-brand-accent text-brand-dark font-semibold px-4 py-3 hover:bg-white hover:text-brand-dark transition">
                        Lanjut <i class="fa-solid fa-arrow-right ml-2"></i>
                    </button>
                </div>
            </div>

            <!-- STEP 3: KESAN, PESAN & SELFIE -->
            <div class="step-content space-y-5 hidden" id="step3">
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-300 mb-2">Satu Kata Untuk Punjulharjo</label>
                    <input type="text" name="one_word" maxlength="20" class="w-full bg-white/10 border border-white/20 rounded-none px-4 py-3 text-white text-sm focus:outline-none focus:border-brand-accent placeholder-slate-400 transition" placeholder="Misal: Indah, Keren, Bikin Kangen" required>
                    <p class="text-[10px] text-slate-400 mt-1">Maksimal 20 karakter.</p>
                    @error('one_word') <span class="text-xs text-rose-400 mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-300 mb-2">Tulis Kesan & Pesan Anda</label>
                    <textarea name="review" rows="3" maxlength="250" class="w-full bg-white/10 border border-white/20 rounded-none px-4 py-3 text-white text-sm focus:outline-none focus:border-brand-accent placeholder-slate-400 transition" placeholder="Bagikan cerita keseruan Anda selama berkunjung..." required></textarea>
                    <p class="text-[10px] text-slate-400 mt-1">Maksimal 250 karakter agar tidak merusak tampilan desain.</p>
                    @error('review') <span class="text-xs text-rose-400 mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-300 mb-3">Foto Selfie / Keseruan Anda</label>
                    
                    <div class="flex flex-col items-center justify-center border-2 border-dashed border-white/20 hover:border-brand-accent/50 bg-white/5 p-6 relative cursor-pointer group" onclick="document.getElementById('selfieInput').click()">
                        <!-- Camera selfie specialized input -->
                        <input type="file" name="photo" id="selfieInput" accept="image/*" capture="user" class="hidden" required onchange="previewImage(this)">
                        
                        <div class="text-center" id="uploadPlaceholder">
                            <i class="fa-solid fa-camera text-4xl text-slate-400 group-hover:text-brand-accent group-hover:scale-110 transition duration-300 mb-2"></i>
                            <span class="block text-xs font-bold text-slate-200">Buka Kamera & Ambil Selfie</span>
                            <span class="text-[10px] text-slate-400 mt-1 block">Klik untuk memilih file atau memotret langsung</span>
                        </div>
                        <!-- Preview Box -->
                        <div class="hidden w-full flex-col items-center" id="previewContainer">
                            <img id="imagePreview" src="#" alt="Selfie Preview" class="max-h-48 aspect-square object-cover border border-white/20 mb-2 shadow-md">
                            <span class="text-xs text-brand-accent font-semibold flex items-center gap-1.5"><i class="fa-solid fa-circle-check"></i> Foto berhasil terpasang</span>
                        </div>
                    </div>
                    @error('photo') <span class="text-xs text-rose-400 mt-2 block">{{ $message }}</span> @enderror
                </div>

                <div class="pt-4 flex justify-between gap-3">
                    <button type="button" onclick="prevStep(2)" class="w-1/3 bg-slate-800 text-white font-semibold px-4 py-3 hover:bg-slate-700 transition">
                        <i class="fa-solid fa-arrow-left mr-2"></i> Kembali
                    </button>
                    <button type="submit" class="w-2/3 bg-brand-accent text-brand-dark font-bold px-6 py-3 hover:bg-white hover:text-brand-dark transition shadow-lg">
                        Kirim Kesan <i class="fa-solid fa-paper-plane ml-2"></i>
                    </button>
                </div>
            </div>

        </form>
    </div>
</div>

<script>
    // Rating star logic
    const stars = document.querySelectorAll('.star-btn');
    const ratingInput = document.getElementById('ratingInput');
    const ratingLabel = document.getElementById('ratingLabel');
    const ratingTexts = {
        1: 'Buruk sekali (1 / 5)',
        2: 'Kurang memuaskan (2 / 5)',
        3: 'Cukup bagus (3 / 5)',
        4: 'Memuaskan (4 / 5)',
        5: 'Sangat Memuaskan (5 / 5)'
    };

    stars.forEach(star => {
        star.addEventListener('click', () => {
            const val = parseInt(star.getAttribute('data-value'));
            ratingInput.value = val;
            ratingLabel.textContent = ratingTexts[val];
            
            // Highlight selected stars
            stars.forEach((s, idx) => {
                if (idx < val) {
                    s.classList.remove('text-slate-400');
                    s.classList.add('text-brand-accent');
                } else {
                    s.classList.remove('text-brand-accent');
                    s.classList.add('text-slate-400');
                }
            });
        });
    });

    // Default load: fill rating to 5
    document.querySelector('.star-btn[data-value="5"]').click();

    // Multi-step logic
    let currentActiveStep = 1;
    function nextStep(step) {
        // Validate before moving
        if (step === 2) {
            const name = document.querySelector('input[name="name"]').value.trim();
            const origin = document.querySelector('input[name="origin_city"]').value.trim();
            if (!name || !origin) {
                alert('Silakan isi nama dan asal daerah Anda terlebih dahulu.');
                return;
            }
        }
        if (step === 3) {
            // Verify step 2 selection (always selected by default)
        }

        // Hide current step, show target step
        document.getElementById(`step${currentActiveStep}`).classList.add('hidden');
        document.getElementById(`step${step}`).classList.remove('hidden');
        
        currentActiveStep = step;
        updateStepperIndicators();
    }

    function prevStep(step) {
        document.getElementById(`step${currentActiveStep}`).classList.add('hidden');
        document.getElementById(`step${step}`).classList.remove('hidden');
        
        currentActiveStep = step;
        updateStepperIndicators();
    }

    function updateStepperIndicators() {
        const indicators = document.querySelectorAll('.step-indicator');
        const lines = document.querySelectorAll('.step-line');

        indicators.forEach((ind, index) => {
            const stepNum = index + 1;
            const circle = ind.querySelector('span');
            const text = ind.querySelector('span + span');

            if (stepNum < currentActiveStep) {
                // Completed steps
                circle.className = "w-8 h-8 rounded-full bg-emerald-500 text-white flex items-center justify-center font-bold text-sm border-2 border-emerald-500 transition duration-300";
                circle.innerHTML = '<i class="fa-solid fa-check"></i>';
                text.className = "text-[10px] text-emerald-400 mt-1 font-semibold";
            } else if (stepNum === currentActiveStep) {
                // Active step
                circle.className = "w-8 h-8 rounded-full bg-brand-accent text-brand-dark flex items-center justify-center font-bold text-sm border-2 border-brand-accent transition duration-300";
                circle.textContent = stepNum;
                text.className = "text-[10px] text-brand-accent mt-1 font-semibold";
            } else {
                // Pending steps
                circle.className = "w-8 h-8 rounded-full bg-slate-800 text-slate-400 flex items-center justify-center font-bold text-sm border-2 border-white/10 transition duration-300";
                circle.textContent = stepNum;
                text.className = "text-[10px] text-slate-400 mt-1";
            }
        });
    }

    // Image preview
    function previewImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                document.getElementById('uploadPlaceholder').classList.add('hidden');
                document.getElementById('previewContainer').classList.remove('hidden');
                document.getElementById('imagePreview').src = e.target.result;
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection

@props([
    'contextType' => 'blog',
    'model'
])

@php
    // Get counts of reactions for this model
    $reactionsCount = $model->reactions()
        ->select('type', \Illuminate\Support\Facades\DB::raw('count(*) as count'))
        ->groupBy('type')
        ->pluck('count', 'type')
        ->toArray();

    $counts = [
        'suka' => $reactionsCount['suka'] ?? 0,
        'senang' => $reactionsCount['senang'] ?? 0,
        'takjub' => $reactionsCount['takjub'] ?? 0,
        'sedih' => $reactionsCount['sedih'] ?? 0,
    ];

    $visitorToken = request()->cookie('visitor_token');
    $userReaction = null;
    if ($visitorToken) {
        $userReaction = $model->reactions()
            ->where('visitor_token', $visitorToken)
            ->value('type');
    }

    $totalComments = $model->comments->count() + $model->comments->sum(fn($c) => $c->replies->count());
    $viewsCount = $model->viewLogs()->count();

    if (!function_exists('getCommentAvatarColor')) {
        function getCommentAvatarColor($name) {
            $colors = ['bg-sky-600', 'bg-emerald-600', 'bg-amber-500', 'bg-indigo-600', 'bg-rose-500', 'bg-violet-600', 'bg-teal-600'];
            $index = ord(strtolower(substr($name, 0, 1))) % count($colors);
            return $colors[$index];
        }
    }
@endphp

<!-- Sleek Toast Notification -->
<div x-data="{ toastMessage: '', toastError: false }"
     x-on:show-toast.window="toastMessage = $event.detail.message; toastError = $event.detail.error; setTimeout(() => { toastMessage = '' }, 4000)"
     class="relative">
    <div x-show="toastMessage" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 translate-y-2"
         :class="toastError ? 'bg-red-500' : 'bg-emerald-600'"
         class="fixed bottom-5 right-5 z-[2000] text-white px-4 py-3 shadow-lg flex items-center gap-2 text-sm font-semibold rounded-lg"
         style="display: none;">
        <i :class="toastError ? 'fa-solid fa-circle-exclamation' : 'fa-solid fa-circle-check'"></i>
        <span x-text="toastMessage"></span>
    </div>
</div>

<!-- Area Reaksi (Reaction & Like Bar) -->
<div x-data="reactionComponent({
    counts: {{ json_encode($counts) }},
    userReaction: {{ json_encode($userReaction) }},
    contextType: '{{ $contextType }}',
    contextId: {{ $model->id }}
})" class="border-t border-b border-slate-200 py-6 my-10 font-sans">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h4 class="text-sm font-semibold text-slate-800 uppercase tracking-wider mb-2">Reaksi Pembaca</h4>
            <div class="flex flex-wrap items-center gap-3">
                <!-- Tombol Like (Suka) -->
                <button type="button" 
                        x-on:click="sendReaction('suka')"
                        :disabled="userReaction !== null || loading"
                        :class="userReaction === 'suka' ? 'bg-rose-50 border-rose-200 text-rose-600' : 'bg-slate-50 border-slate-200 text-slate-700 hover:bg-rose-50 hover:text-rose-600 hover:border-rose-200'"
                        class="flex items-center gap-2 border px-4 py-2 text-sm font-medium transition duration-150 rounded-none group disabled:opacity-85 disabled:cursor-not-allowed"
                        aria-label="Suka ini">
                    <i class="fa-solid fa-heart group-hover:scale-110 transition duration-150"></i>
                    <span>Suka</span>
                    <span :class="userReaction === 'suka' ? 'bg-rose-100 text-rose-700' : 'bg-slate-200 text-slate-700'"
                          class="px-2 py-0.5 text-xs font-bold rounded-none" x-text="counts.suka"></span>
                </button>

                <!-- Reaksi 1: Senang -->
                <button type="button" 
                        x-on:click="sendReaction('senang')"
                        :disabled="userReaction !== null || loading"
                        :class="userReaction === 'senang' ? 'bg-amber-50 border-amber-200 text-amber-600' : 'bg-slate-50 border-slate-200 text-slate-700 hover:bg-amber-50 hover:text-amber-600 hover:border-amber-200'"
                        class="flex items-center gap-1.5 border px-3 py-2 text-sm transition duration-150 rounded-none group disabled:opacity-85 disabled:cursor-not-allowed"
                        aria-label="Reaksi Senang">
                    <span class="text-base group-hover:scale-110 transition duration-150">😆</span>
                    <span>Senang</span>
                    <span :class="userReaction === 'senang' ? 'bg-amber-100 text-amber-700' : 'bg-slate-200 text-slate-650'"
                          class="px-1.5 py-0.2 text-xs font-bold rounded-none" x-text="counts.senang"></span>
                </button>

                <!-- Reaksi 2: Takjub -->
                <button type="button" 
                        x-on:click="sendReaction('takjub')"
                        :disabled="userReaction !== null || loading"
                        :class="userReaction === 'takjub' ? 'bg-sky-50 border-sky-200 text-sky-600' : 'bg-slate-50 border-slate-200 text-slate-700 hover:bg-sky-50 hover:text-sky-600 hover:border-sky-200'"
                        class="flex items-center gap-1.5 border px-3 py-2 text-sm transition duration-150 rounded-none group disabled:opacity-85 disabled:cursor-not-allowed"
                        aria-label="Reaksi Takjub">
                    <span class="text-base group-hover:scale-110 transition duration-150">😮</span>
                    <span>Takjub</span>
                    <span :class="userReaction === 'takjub' ? 'bg-sky-100 text-sky-700' : 'bg-slate-200 text-slate-650'"
                          class="px-1.5 py-0.2 text-xs font-bold rounded-none" x-text="counts.takjub"></span>
                </button>

                <!-- Reaksi 3: Sedih -->
                <button type="button" 
                        x-on:click="sendReaction('sedih')"
                        :disabled="userReaction !== null || loading"
                        :class="userReaction === 'sedih' ? 'bg-blue-50 border-blue-200 text-blue-600' : 'bg-slate-50 border-slate-200 text-slate-700 hover:bg-blue-50 hover:text-blue-600 hover:border-blue-200'"
                        class="flex items-center gap-1.5 border px-3 py-2 text-sm transition duration-150 rounded-none group disabled:opacity-85 disabled:cursor-not-allowed"
                        aria-label="Reaksi Sedih">
                    <span class="text-base group-hover:scale-110 transition duration-150">😢</span>
                    <span>Sedih</span>
                    <span :class="userReaction === 'sedih' ? 'bg-blue-100 text-blue-700' : 'bg-slate-200 text-slate-650'"
                          class="px-1.5 py-0.2 text-xs font-bold rounded-none" x-text="counts.sedih"></span>
                </button>
            </div>
        </div>

        <div class="flex items-center gap-4 text-xs text-slate-500">
            <span><i class="fa-solid fa-eye"></i> {{ $viewsCount }} Kali Dilihat</span>
            <button x-on:click="window.dispatchEvent(new CustomEvent('show-toast', { detail: { message: 'Link halaman telah disalin ke clipboard!', error: false } })); navigator.clipboard.writeText(window.location.href)" 
                    class="hover:text-slate-800 flex items-center gap-1 transition">
                <i class="fa-solid fa-share-nodes"></i> Bagikan
            </button>
        </div>
    </div>
</div>

<!-- Area Komentar (Comments Section) -->
<div x-data="commentComponent({
    contextType: '{{ $contextType }}',
    contextId: {{ $model->id }},
    visitorToken: '{{ $visitorToken }}'
})" class="space-y-8 font-sans">
    <div class="flex items-center justify-between border-b border-slate-200 pb-3">
        <h3 class="text-lg font-bold text-brand-dark font-heading">
            Komentar (<span x-text="{{ $totalComments }} + localComments.length + Object.values(localReplies).reduce((a, b) => a + b.length, 0) - deletedCount">{{ $totalComments }}</span>)
        </h3>
        <span class="text-xs text-slate-500">Kebijakan Komentar: Sopan & Konstruktif</span>
    </div>

    <!-- Form Komentar Utama -->
    <div class="bg-slate-50 p-5 border border-slate-200 rounded-none">
        <h4 class="text-sm font-semibold text-slate-800 mb-4">Kirim Komentar Anda</h4>
        <form x-on:submit.prevent="submitComment(false)" class="space-y-4">
            <!-- Honeypot -->
            <div style="display: none;">
                <input type="text" x-model="website" autocomplete="off" tabindex="-1">
            </div>

            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-slate-700 uppercase mb-1.5">Nama Lengkap</label>
                    <input type="text" x-model="nama" placeholder="Masukkan nama Anda" 
                           class="w-full border border-slate-300 rounded-none px-3 py-2 text-sm focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500 bg-white" required>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-700 uppercase mb-1.5">Email (Opsional)</label>
                    <input type="email" x-model="email" placeholder="nama@email.com" 
                           class="w-full border border-slate-300 rounded-none px-3 py-2 text-sm focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500 bg-white">
                </div>
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-700 uppercase mb-1.5">Komentar</label>
                <textarea x-model="komentar" rows="4" placeholder="Tulis komentar Anda di sini..." 
                           class="w-full border border-slate-300 rounded-none px-3 py-2 text-sm focus:outline-none focus:border-sky-500 focus:ring-1 focus:ring-sky-500 bg-white" required></textarea>
            </div>
            <div class="flex justify-end">
                <button type="submit" :disabled="loading"
                        class="bg-brand-dark hover:bg-sky-900 text-white text-xs font-bold py-2.5 px-6 rounded-none transition duration-150 uppercase tracking-wider shadow-sm disabled:opacity-75 disabled:cursor-not-allowed">
                    <span x-show="!loading">Kirim Komentar</span>
                    <span x-show="loading"><i class="fa-solid fa-spinner animate-spin"></i> Mengirim...</span>
                </button>
            </div>
        </form>
    </div>

    <!-- Daftar Komentar -->
    <div class="space-y-6">
        <!-- Local comments template (AJAX dynamically posted main comments) -->
        <template x-for="c in localComments" :key="c.id">
            <div class="flex items-start gap-4 pb-6 border-b border-slate-100" :id="'comment-container-' + c.id">
                <div class="flex-shrink-0 w-10 h-10 bg-emerald-600 text-white flex items-center justify-center font-bold text-sm rounded-none"
                     x-text="c.nama.charAt(0).toUpperCase()">
                </div>
                <div class="space-y-1 w-full">
                    <div class="flex items-center gap-2">
                        <h5 class="text-sm font-semibold text-slate-800" x-text="c.nama"></h5>
                        <span class="text-[11px] text-slate-400" x-text="c.time_ago"></span>
                    </div>
                    <p class="text-sm text-slate-655 leading-relaxed" x-text="c.komentar"></p>
                    
                    @if(Auth::check() && Auth::user()->isAdmin())
                        <div class="pt-1.5">
                            <button x-on:click="deleteComment(c.id, c.delete_url)" 
                                    class="text-xs text-rose-600 font-bold hover:text-rose-700 transition flex items-center gap-1">
                                <i class="fa-solid fa-trash"></i> Hapus
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </template>

        <!-- Database comments loop -->
        @forelse($model->comments as $comment)
            <div class="flex items-start gap-4 pb-6 border-b border-slate-100" id="comment-container-{{ $comment->id }}">
                <!-- Avatar -->
                <div class="flex-shrink-0 w-10 h-10 {{ getCommentAvatarColor($comment->nama) }} text-white flex items-center justify-center font-bold text-sm rounded-none">
                    {{ strtoupper(substr($comment->nama, 0, 1)) }}
                </div>
                <div class="space-y-1 w-full">
                    <div class="flex items-center gap-2">
                        <h5 class="text-sm font-semibold text-slate-800">{{ $comment->nama }}</h5>
                        <span class="text-[11px] text-slate-455">{{ $comment->created_at->diffForHumans() }}</span>
                    </div>
                    <p class="text-sm text-slate-655 leading-relaxed">
                        {{ $comment->komentar }}
                    </p>

                    <!-- Reply Action & Delete Action for Admins -->
                    <div class="pt-1.5 flex items-center gap-3">
                        <button x-on:click="replyTo = (replyTo === {{ $comment->id }} ? null : {{ $comment->id }})" 
                                class="text-xs text-emerald-600 font-bold hover:text-emerald-700 transition flex items-center gap-1">
                            <i class="fa-solid fa-reply"></i> Balas
                        </button>

                        @if(Auth::check() && Auth::user()->isAdmin())
                            <button x-on:click="deleteComment({{ $comment->id }}, '{{ route('admin.comment.destroy', $comment->id) }}')" 
                                    class="text-xs text-rose-600 font-bold hover:text-rose-700 transition flex items-center gap-1">
                                <i class="fa-solid fa-trash"></i> Hapus
                            </button>
                        @endif
                    </div>

                    <!-- Nested Reply Form (Only visible when replyTo === comment->id) -->
                    <div x-show="replyTo === {{ $comment->id }}" x-cloak class="mt-4 bg-slate-50 p-4 border border-slate-200 rounded-xl max-w-xl">
                        <h5 class="text-xs font-bold text-slate-800 mb-3">Balas Komentar {{ $comment->nama }}</h5>
                        <form x-on:submit.prevent="submitComment(true)" class="space-y-3">
                            <!-- Honeypot -->
                            <div style="display: none;">
                                <input type="text" x-model="replyWebsite" autocomplete="off" tabindex="-1">
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                <div>
                                    <label class="block text-[10px] font-bold text-slate-700 uppercase mb-1">Nama Lengkap</label>
                                    <input type="text" x-model="replyNama" placeholder="Nama Anda" 
                                           class="w-full border border-slate-300 rounded-lg px-3 py-1.5 text-xs bg-white" required>
                                </div>
                                <div>
                                    <label class="block text-[10px] font-bold text-slate-700 uppercase mb-1">Email (Opsional)</label>
                                    <input type="email" x-model="replyEmail" placeholder="nama@email.com" 
                                           class="w-full border border-slate-300 rounded-lg px-3 py-1.5 text-xs bg-white">
                                </div>
                            </div>
                            <div>
                                <label class="block text-[10px] font-bold text-slate-700 uppercase mb-1">Balasan Anda</label>
                                <textarea x-model="replyKomentar" rows="3" placeholder="Tulis balasan Anda..." 
                                          class="w-full border border-slate-300 rounded-lg px-3 py-1.5 text-xs bg-white" required></textarea>
                                <p class="text-[9px] text-slate-400 mt-1">Balasan Anda akan ditayangkan langsung secara berjenjang di bawah.</p>
                            </div>
                            <div class="flex justify-end gap-2">
                                <button type="button" x-on:click="replyTo = null" 
                                        class="bg-slate-200 hover:bg-slate-300 text-slate-700 text-[10px] font-bold py-1.5 px-3 rounded-lg uppercase tracking-wider">
                                    Batal
                                </button>
                                <button type="submit" :disabled="loading"
                                        class="bg-emerald-600 hover:bg-emerald-700 text-white text-[10px] font-bold py-1.5 px-3 rounded-lg uppercase tracking-wider shadow-sm flex items-center gap-1 disabled:opacity-75">
                                    <span x-show="!loading">Kirim Balasan</span>
                                    <span x-show="loading"><i class="fa-solid fa-spinner animate-spin"></i></span>
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Nested Replies Container -->
                    <div class="space-y-4 mt-4 pl-4 sm:pl-8 border-l-2 border-slate-100">
                        <!-- Local replies template (AJAX posted replies) -->
                        <template x-for="r in (localReplies[{{ $comment->id }}] || [])" :key="r.id">
                            <div class="flex items-start gap-3" :id="'comment-container-' + r.id">
                                <div class="flex-shrink-0 w-8 h-8 bg-sky-600 text-white flex items-center justify-center font-bold text-xs rounded-none"
                                     x-text="r.nama.charAt(0).toUpperCase()">
                                </div>
                                <div class="space-y-0.5 w-full">
                                    <div class="flex items-center gap-2">
                                        <h5 class="text-xs font-semibold text-slate-800" x-text="r.nama"></h5>
                                        <span class="text-[10px] text-slate-400" x-text="r.time_ago"></span>
                                    </div>
                                    <p class="text-xs text-slate-655 leading-relaxed" x-text="r.komentar"></p>
                                    
                                    @if(Auth::check() && Auth::user()->isAdmin())
                                        <div class="pt-1">
                                            <button x-on:click="deleteComment(r.id, r.delete_url)" 
                                                    class="text-[10px] text-rose-600 font-bold hover:text-rose-700 transition flex items-center gap-0.5">
                                                <i class="fa-solid fa-trash"></i> Hapus
                                            </button>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </template>

                        <!-- Database replies loop -->
                        @foreach($comment->replies as $reply)
                            <div class="flex items-start gap-3" id="comment-container-{{ $reply->id }}">
                                <div class="flex-shrink-0 w-8 h-8 {{ getCommentAvatarColor($reply->nama) }} text-white flex items-center justify-center font-bold text-xs rounded-none">
                                    {{ strtoupper(substr($reply->nama, 0, 1)) }}
                                </div>
                                <div class="space-y-0.5 w-full">
                                    <div class="flex items-center gap-2">
                                        <h5 class="text-xs font-semibold text-slate-800">{{ $reply->nama }}</h5>
                                        <span class="text-[10px] text-slate-455">{{ $reply->created_at->diffForHumans() }}</span>
                                    </div>
                                    <p class="text-xs text-slate-655 leading-relaxed">
                                        {{ $reply->komentar }}
                                    </p>
                                    
                                    @if(Auth::check() && Auth::user()->isAdmin())
                                        <div class="pt-1">
                                            <button x-on:click="deleteComment({{ $reply->id }}, '{{ route('admin.comment.destroy', $reply->id) }}')" 
                                                    class="text-[10px] text-rose-600 font-bold hover:text-rose-700 transition flex items-center gap-0.5">
                                                <i class="fa-solid fa-trash"></i> Hapus
                                            </button>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @empty
            <p x-show="localComments.length === 0" class="text-center text-slate-400 italic py-6 text-sm">Jadilah yang pertama berkomentar.</p>
        @endforelse
    </div>
</div>

<script>
    // Alpine initialization logic for reactions
    window.reactionComponent = function(config) {
        return {
                counts: config.counts,
                userReaction: config.userReaction,
                contextType: config.contextType,
                contextId: config.contextId,
                loading: false,

                async sendReaction(type) {
                    if (this.userReaction) return;
                    this.loading = true;

                    try {
                        const response = await fetch('/reaksi', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({
                                type: type,
                                context_type: this.contextType,
                                context_id: this.contextId
                            })
                        });

                        const data = await response.json();
                        if (response.ok) {
                            this.userReaction = type;
                            this.counts[type]++;
                            window.dispatchEvent(new CustomEvent('show-toast', { detail: { message: 'Reaksi Anda telah berhasil disimpan!', error: false } }));
                        } else {
                            window.dispatchEvent(new CustomEvent('show-toast', { detail: { message: data.error || 'Terjadi kesalahan.', error: true } }));
                        }
                    } catch (e) {
                        window.dispatchEvent(new CustomEvent('show-toast', { detail: { message: 'Gagal mengirim reaksi.', error: true } }));
                    } finally {
                        this.loading = false;
                    }
                }
            };
        };

        // Alpine initialization logic for comments
        window.commentComponent = function(config) {
            return {
                contextType: config.contextType,
                contextId: config.contextId,
                visitorToken: config.visitorToken,
                nama: '',
                email: '',
                komentar: '',
                website: '', // honeypot
                replyTo: null,
                replyNama: '',
                replyEmail: '',
                replyKomentar: '',
                replyWebsite: '',
                loading: false,
                localComments: [],
                localReplies: {},
                deletedCount: 0,

                async deleteComment(id, url) {
                    if (!confirm('Hapus komentar ini? Menghapus komentar utama juga akan menghapus semua balasannya.')) {
                        return;
                    }

                    const deleteUrl = url || `/admin/komentar/${id}`;

                    try {
                        const response = await fetch(deleteUrl, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                'Accept': 'application/json'
                            }
                        });

                        const data = await response.json();
                        if (response.ok) {
                            window.dispatchEvent(new CustomEvent('show-toast', { detail: { message: 'Komentar berhasil dihapus!', error: false } }));
                            const container = document.getElementById(`comment-container-${id}`);
                            if (container) {
                                container.remove();
                            }
                            this.deletedCount++;
                        } else {
                            window.dispatchEvent(new CustomEvent('show-toast', { detail: { message: data.message || 'Gagal menghapus komentar.', error: true } }));
                        }
                    } catch (e) {
                        window.dispatchEvent(new CustomEvent('show-toast', { detail: { message: 'Terjadi kegagalan jaringan.', error: true } }));
                    }
                },

                async submitComment(isReply) {
                    const nameVal = isReply ? this.replyNama : this.nama;
                    const emailVal = isReply ? this.replyEmail : this.email;
                    const commentVal = isReply ? this.replyKomentar : this.komentar;
                    const parentIdVal = isReply ? this.replyTo : null;
                    const honeypotVal = isReply ? this.replyWebsite : this.website;

                    if (honeypotVal) {
                        window.dispatchEvent(new CustomEvent('show-toast', { detail: { message: 'Komentar berhasil dikirim!', error: false } }));
                        this.resetForm(isReply);
                        return;
                    }

                    this.loading = true;

                    try {
                        const response = await fetch('/komentar', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({
                                nama: nameVal,
                                email: emailVal,
                                komentar: commentVal,
                                context_type: this.contextType,
                                context_id: this.contextId,
                                parent_id: parentIdVal,
                                website: honeypotVal
                            })
                        });

                        const data = await response.json();
                        if (response.ok) {
                            window.dispatchEvent(new CustomEvent('show-toast', { detail: { message: 'Komentar Anda berhasil diterbitkan!', error: false } }));
                            
                            const newObj = {
                                id: data.comment.id,
                                nama: data.comment.nama,
                                komentar: data.comment.komentar,
                                time_ago: data.comment.time_ago,
                                delete_url: data.comment.delete_url
                            };

                            if (isReply) {
                                if (!this.localReplies[parentIdVal]) {
                                    this.localReplies[parentIdVal] = [];
                                }
                                this.localReplies[parentIdVal].push(newObj);
                            } else {
                                this.localComments.unshift(newObj);
                            }

                            this.resetForm(isReply);
                        } else {
                            window.dispatchEvent(new CustomEvent('show-toast', { detail: { message: data.message || 'Gagal mengirim komentar.', error: true } }));
                        }
                    } catch (e) {
                        window.dispatchEvent(new CustomEvent('show-toast', { detail: { message: 'Terjadi kegagalan jaringan.', error: true } }));
                    } finally {
                        this.loading = false;
                    }
                },

                resetForm(isReply) {
                    if (isReply) {
                        this.replyNama = '';
                        this.replyEmail = '';
                        this.replyKomentar = '';
                        this.replyWebsite = '';
                        this.replyTo = null;
                    } else {
                        this.nama = '';
                        this.email = '';
                        this.komentar = '';
                        this.website = '';
                    }
                }
            };
        };
</script>

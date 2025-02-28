<x-app-layout>
    <div class="container mx-auto p-4">
        <!-- Rating and Comment Section -->
        <div class="bg-white shadow-md rounded p-4 mb-4">
            @php
                $userKomentar = $buku->comments->where('user_id', Auth::id())->first();
                $userRating = $buku->ratings->where('user_id', Auth::id())->first();
            @endphp

            @if (!$userKomentar)
                <!-- Combined Form for Rating and Comment -->
                <form action="{{ route('buku.rate', ['buku' => $buku->id]) }}" method="POST" id="comment-form"
                    class="space-y-2">
                    @csrf
                    <div class="flex items-center justify-center gap-1 mb-4">
                        @for ($i = 1; $i <= 5; $i++)
                            <span class="star cursor-pointer text-2xl transition-colors hover:text-yellow-400"
                                data-value="{{ $i }}">
                                &#9733;
                            </span>
                        @endfor
                    </div>
                    <!-- Hidden input untuk rating -->
                    <input type="hidden" id="rating-input" name="rating"
                        value="{{ $userRating ? $userRating->rating : 0 }}">
                    <!-- Textarea untuk komentar -->
                    <textarea name="komentar"
                        class="w-full p-2 border rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        rows="2" placeholder="Tulis komentar...">{{ old('komentar') }}</textarea>
                    <button type="submit"
                        class="w-full px-4 py-2.5 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700 transition-colors">
                        <i class="fas fa-paper-plane mr-1"></i> Kirim Komentar
                    </button>
                </form>
            @else
                <!-- Display user's existing rating and comment with edit button -->
                <div class="text-center mb-4">
                    <p class="text-gray-600 mb-2">Anda sudah memberikan rating dan komentar.</p>
                    <button id="show-edit-form"
                        class="px-4 py-2 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700 transition-colors">
                        <i class="fas fa-edit mr-1"></i> Edit Komentar & Rating
                    </button>
                </div>

                <!-- Hidden edit form (will be shown when edit button is clicked) -->
                <form action="{{ route('buku.update-rate', ['buku' => $buku->id]) }}" method="POST" id="edit-form"
                    class="space-y-2 hidden">
                    @csrf
                    @method('PUT')
                    <div class="flex items-center justify-center gap-1 mb-4">
                        @for ($i = 1; $i <= 5; $i++)
                            <span class="star cursor-pointer text-2xl transition-colors hover:text-yellow-400"
                                data-value="{{ $i }}">
                                &#9733;
                            </span>
                        @endfor
                    </div>
                    <!-- Hidden input untuk rating -->
                    <input type="hidden" id="rating-input" name="rating"
                        value="{{ $userRating ? $userRating->rating : 0 }}">
                    <!-- Hidden input untuk komentar ID -->
                    <input type="hidden" name="komentar_id" value="{{ $userKomentar->id }}">
                    <!-- Textarea untuk komentar -->
                    <textarea name="komentar"
                        class="w-full p-2 border rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        rows="2" placeholder="Tulis komentar...">{{ $userKomentar->komentar }}</textarea>
                    <div class="flex gap-2">
                        <button type="submit"
                            class="flex-1 px-4 py-2.5 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700 transition-colors">
                            <i class="fas fa-save mr-1"></i> Simpan Perubahan
                        </button>
                        <button type="button" id="cancel-edit"
                            class="px-4 py-2.5 bg-gray-400 text-white text-sm rounded-lg hover:bg-gray-500 transition-colors">
                            Batal
                        </button>
                    </div>
                </form>
            @endif
        </div>

        <!-- Reviews Section -->
        <div class="bg-white shadow-md rounded p-4">
            <h1 class="text-2xl font-bold mb-4">Review untuk: {{ $buku->nama_buku }}</h1>
            @if ($buku->comments->count() > 0)
                <!-- Loop komentar -->
                @foreach ($buku->comments as $comment)
                    @if (!$comment->reply_id)
                        <!-- Hanya tampilkan komentar utama -->
                        <div class="border-b pb-4 mb-4" id="comment-{{ $comment->id }}">
                            <div class="flex items-start">
                                <img src="{{ $comment->user->profile_photo_url }}" alt="Avatar"
                                    class="w-10 h-10 rounded-full object-cover">
                                <div class="flex-1 ml-3">
                                    <div class="flex justify-between items-start">
                                        <p class="font-semibold">{{ $comment->user->name }}</p>

                                        @if ($comment->user_id == Auth::id())
                                            <!-- Dropdown untuk edit/delete -->
                                            <div class="relative inline-block text-left" x-data="{ open: false }">
                                                <button @click="open = !open" type="button" class="text-gray-400 hover:text-gray-600">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </button>
                                                <div x-show="open" @click.away="open = false" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                                                    <div class="py-1">
                                                        <button type="button" id="edit-comment-{{ $comment->id }}" 
                                                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                                            <i class="fas fa-edit mr-2"></i> Edit Komentar
                                                        </button>
                                                        
                                                        <form action="{{ route('buku.delete-comment', ['komentar' => $comment->id]) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="delete-comment block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                                                                <i class="fas fa-trash-alt mr-2"></i> Hapus Komentar
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                    <!-- Tampilkan rating -->
                                    @php
                                        $commentRating = $buku->ratings->where('user_id', $comment->user_id)->first();
                                    @endphp
                                    @if ($commentRating)
                                        <div class="flex items-center mb-1">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <span
                                                    class="{{ $i <= $commentRating->rating ? 'text-yellow-400' : 'text-gray-300' }}">&#9733;</span>
                                            @endfor
                                        </div>
                                    @endif

                                    <!-- Komentar konten dan form edit -->
                                    <div id="comment-content-{{ $comment->id }}">
                                        <p>{{ $comment->komentar }}</p>
                                        <div class="flex items-center mt-1">
                                            <small class="text-gray-500">{{ $comment->created_at->diffForHumans() }}</small>
                                            <button class="ml-4 text-sm text-blue-600 reply-button"
                                                data-comment-id="{{ $comment->id }}"
                                                data-username="{{ $comment->user->name }}">
                                                <i class="fas fa-reply mr-1"></i> Balas
                                            </button>
                                        </div>
                                    </div>

                                    <!-- Form edit komentar (hidden by default) -->
                                    <div id="edit-comment-form-{{ $comment->id }}" class="mt-3 hidden">
                                        <form action="{{ route('buku.update-comment', ['komentar' => $comment->id]) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <textarea name="komentar"
                                                class="w-full p-2 border rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                                rows="2">{{ $comment->komentar }}</textarea>
                                            <div class="flex gap-2 mt-2">
                                                <button type="submit"
                                                    class="px-3 py-1.5 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700 transition-colors">
                                                    <i class="fas fa-save mr-1"></i> Simpan
                                                </button>
                                                <button type="button"
                                                    class="px-3 py-1.5 bg-gray-400 text-white text-sm rounded-lg hover:bg-gray-500 transition-colors cancel-edit-comment"
                                                    data-comment-id="{{ $comment->id }}">
                                                    Batal
                                                </button>
                                            </div>
                                        </form>
                                    </div>

                                    <!-- Form balas komentar (hidden by default) -->
                                    <div id="reply-form-{{ $comment->id }}" class="mt-3 hidden">
                                        <form action="{{ route('buku.reply-comment', ['komentar' => $comment->id]) }}"
                                            method="POST" class="reply-form">
                                            @csrf
                                            <input type="hidden" name="replied_username"
                                                value="{{ $comment->user->name }}">
                                            <textarea name="komentar"
                                                class="w-full p-2 border rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                                rows="2" placeholder="Tulis balasan..."></textarea>
                                            <div class="flex gap-2 mt-2">
                                                <button type="submit"
                                                    class="px-3 py-1.5 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700 transition-colors">
                                                    <i class="fas fa-paper-plane mr-1"></i> Kirim
                                                </button>
                                                <button type="button"
                                                    class="px-3 py-1.5 bg-gray-400 text-white text-sm rounded-lg hover:bg-gray-500 transition-colors cancel-reply"
                                                    data-comment-id="{{ $comment->id }}">
                                                    Batal
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Tampilkan semua balasan (baik untuk komentar utama maupun balasan) -->
                            @if ($comment->replies->count() > 0)
                                <div class="ml-12 mt-3 space-y-3 pl-2 border-l-2 border-gray-200">
                                    @foreach ($comment->replies as $reply)
                                        <div class="pl-3" id="reply-{{ $reply->id }}">
                                            <div class="flex items-start">
                                                <img src="{{ $reply->user->profile_photo_url }}" alt="Avatar"
                                                    class="w-8 h-8 rounded-full object-cover">
                                                <div class="flex-1 ml-2">
                                                    <div class="flex justify-between items-start">
                                                        <div>
                                                            <p class="font-semibold text-sm">{{ $reply->user->name }}
                                                                <span class="font-normal text-gray-500">membalas
                                                                    {{ $reply->replied_to_username ?? $comment->user->name }}</span>
                                                            </p>
                                                        </div>

                                                        @if ($reply->user_id == Auth::id())
                                                            <!-- Dropdown untuk edit/delete balasan -->
                                                            <div class="relative inline-block text-left" x-data="{ open: false }">
                                                                <button @click="open = !open" type="button" class="text-gray-400 hover:text-gray-600">
                                                                    <i class="fas fa-ellipsis-v"></i>
                                                                </button>
                                                                <div x-show="open" @click.away="open = false" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
                                                                    <div class="py-1">
                                                                        <button type="button" class="edit-reply block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                                                                            data-reply-id="{{ $reply->id }}">
                                                                            <i class="fas fa-edit mr-2"></i> Edit
                                                                        </button>
                                                                        
                                                                        <form action="{{ route('buku.delete-comment', ['komentar' => $reply->id]) }}" method="POST">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="submit" class="delete-comment block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                                                                                <i class="fas fa-trash-alt mr-2"></i> Hapus
                                                                            </button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>

                                                    <!-- Konten balasan -->
                                                    <div id="reply-content-{{ $reply->id }}">
                                                        <p class="text-sm">{{ $reply->komentar }}</p>
                                                        <div class="flex items-center mt-1">
                                                            <small class="text-gray-500 text-xs">{{ $reply->created_at->diffForHumans() }}</small>
                                                            <button class="ml-4 text-xs text-blue-600 reply-button-nested"
                                                                data-parent-id="{{ $comment->id }}"
                                                                data-reply-id="{{ $reply->id }}"
                                                                data-username="{{ $reply->user->name }}">
                                                                <i class="fas fa-reply mr-1"></i> Balas
                                                            </button>
                                                        </div>
                                                    </div>

                                                    <!-- Form edit balasan (hidden by default) -->
                                                    <div id="edit-reply-form-{{ $reply->id }}" class="mt-2 hidden">
                                                        <form action="{{ route('buku.update-comment', ['komentar' => $reply->id]) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <textarea name="komentar"
                                                                class="w-full p-2 border rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                                                rows="2">{{ $reply->komentar }}</textarea>
                                                            <div class="flex gap-2 mt-2">
                                                                <button type="submit"
                                                                    class="px-2 py-1 bg-blue-600 text-white text-xs rounded-lg hover:bg-blue-700 transition-colors">
                                                                    <i class="fas fa-save mr-1"></i> Simpan
                                                                </button>
                                                                <button type="button"
                                                                    class="px-2 py-1 bg-gray-400 text-white text-xs rounded-lg hover:bg-gray-500 transition-colors cancel-edit-reply"
                                                                    data-reply-id="{{ $reply->id }}">
                                                                    Batal
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>

                                                    <!-- Form balas ke balasan (hidden by default) -->
                                                    <div id="nested-reply-form-{{ $reply->id }}" class="mt-2 hidden">
                                                        <form action="{{ route('buku.reply-comment', ['komentar' => $comment->id]) }}"
                                                            method="POST" class="nested-reply-form">
                                                            @csrf
                                                            <input type="hidden" name="replied_username"
                                                                value="{{ $reply->user->name }}">
                                                            <textarea name="komentar"
                                                                class="w-full p-2 border rounded-lg text-xs focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                                                rows="2" placeholder="Balas ke {{ $reply->user->name }}..."></textarea>
                                                            <div class="flex gap-2 mt-2">
                                                                <button type="submit"
                                                                    class="px-2 py-1 bg-blue-600 text-white text-xs rounded-lg hover:bg-blue-700 transition-colors">
                                                                    <i class="fas fa-paper-plane mr-1"></i> Kirim
                                                                </button>
                                                                <button type="button"
                                                                    class="px-2 py-1 bg-gray-400 text-white text-xs rounded-lg hover:bg-gray-500 transition-colors cancel-nested-reply"
                                                                    data-reply-id="{{ $reply->id }}">
                                                                    Batal
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endif
                @endforeach
            @else
                <p class="text-gray-500">Belum ada review untuk buku ini.</p>
            @endif
            <br>
            <a href="{{ route('buku.show', ['id' => $buku->id]) }}" class="px-4 py-2 text-blue-600 rounded">
                Kembali ke Buku
            </a>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Rating stars functionality
            const stars = document.querySelectorAll('.star');
            const ratingInput = document.getElementById('rating-input');
            let selectedRating = {{ $userRating ? $userRating->rating : 0 }};

            // Inisialisasi tampilan bintang
            setStars(selectedRating);

            stars.forEach(star => {
                star.addEventListener('mouseover', () => {
                    setStars(star.getAttribute('data-value'));
                });
                star.addEventListener('mouseout', () => {
                    setStars(selectedRating);
                });
                star.addEventListener('click', () => {
                    selectedRating = star.getAttribute('data-value');
                    ratingInput.value = selectedRating;
                    console.log("Rating updated:", selectedRating);
                    setStars(selectedRating);
                });
            });

            function setStars(rating) {
                stars.forEach(star => {
                    star.style.color = (star.getAttribute('data-value') <= rating) ? '#FBBF24' : '#D1D5DB';
                });
            }

            // Edit comment functionality
            const showEditFormBtn = document.getElementById('show-edit-form');
            const editForm = document.getElementById('edit-form');
            const cancelEditBtn = document.getElementById('cancel-edit');

            if (showEditFormBtn) {
                showEditFormBtn.addEventListener('click', function() {
                    showEditFormBtn.parentElement.classList.add('hidden');
                    editForm.classList.remove('hidden');
                });
            }

            if (cancelEditBtn) {
                cancelEditBtn.addEventListener('click', function() {
                    editForm.classList.add('hidden');
                    showEditFormBtn.parentElement.classList.remove('hidden');
                });
            }

            // Edit comment button functionality
            document.querySelectorAll('[id^="edit-comment-"]').forEach(button => {
                button.addEventListener('click', function() {
                    const commentId = this.id.replace('edit-comment-', '');
                    document.getElementById(`comment-content-${commentId}`).classList.add('hidden');
                    document.getElementById(`edit-comment-form-${commentId}`).classList.remove('hidden');
                });
            });

            // Cancel edit comment
            document.querySelectorAll('.cancel-edit-comment').forEach(button => {
                button.addEventListener('click', function() {
                    const commentId = this.getAttribute('data-comment-id');
                    document.getElementById(`comment-content-${commentId}`).classList.remove('hidden');
                    document.getElementById(`edit-comment-form-${commentId}`).classList.add('hidden');
                });
            });

            // Reply button functionality
            document.querySelectorAll('.reply-button').forEach(button => {
                button.addEventListener('click', function() {
                    const commentId = this.getAttribute('data-comment-id');
                    const username = this.getAttribute('data-username');
                    
                    // Tampilkan form reply
                    document.getElementById(`reply-form-${commentId}`).classList.remove('hidden');
                    // Sembunyikan tombol reply
                    this.classList.add('hidden');
                });
            });

            // Cancel reply
            document.querySelectorAll('.cancel-reply').forEach(button => {
                button.addEventListener('click', function() {
                    const commentId = this.getAttribute('data-comment-id');
                    
                    // Sembunyikan form reply
                    document.getElementById(`reply-form-${commentId}`).classList.add('hidden');
                    
                    // Tampilkan kembali tombol reply
                    const replyButton = document.querySelector(`.reply-button[data-comment-id="${commentId}"]`);
                    if (replyButton) {
                        replyButton.classList.remove('hidden');
                    }
                });
            });

            // Reply to reply (nested reply) button functionality
            document.querySelectorAll('.reply-button-nested').forEach(button => {
                button.addEventListener('click', function() {
                    const replyId = this.getAttribute('data-reply-id');
                    const username = this.getAttribute('data-username');
                    
                    // Tampilkan form nested reply
                    document.getElementById(`nested-reply-form-${replyId}`).classList.remove('hidden');
                    // Sembunyikan tombol reply
                    this.classList.add('hidden');
                });
            });

            // Cancel nested reply
            document.querySelectorAll('.cancel-nested-reply').forEach(button => {
                button.addEventListener('click', function() {
                    const replyId = this.getAttribute('data-reply-id');
                    
                    // Sembunyikan form nested reply
                    document.getElementById(`nested-reply-form-${replyId}`).classList.add('hidden');
                    
                    // Tampilkan kembali tombol reply
                    const replyButton = document.querySelector(`.reply-button-nested[data-reply-id="${replyId}"]`);
                    if (replyButton) {
                        replyButton.classList.remove('hidden');
                    }
                });
            });

            // Edit reply button functionality
            document.querySelectorAll('.edit-reply').forEach(button => {
                button.addEventListener('click', function() {
                    const replyId = this.getAttribute('data-reply-id');
                    
                    // Sembunyikan konten reply
                    document.getElementById(`reply-content-${replyId}`).classList.add('hidden');
                    
                    // Tampilkan form edit reply
                    document.getElementById(`edit-reply-form-${replyId}`).classList.remove('hidden');
                });
            });

            // Cancel edit reply
            document.querySelectorAll('.cancel-edit-reply').forEach(button => {
                button.addEventListener('click', function() {
                    const replyId = this.getAttribute('data-reply-id');
                    
                    // Tampilkan kembali konten reply
                    document.getElementById(`reply-content-${replyId}`).classList.remove('hidden');
                    
                    // Sembunyikan form edit reply
                    document.getElementById(`edit-reply-form-${replyId}`).classList.add('hidden');
                });
            });

            // Delete confirmation
            document.querySelectorAll('.delete-comment').forEach(button => {
                button.addEventListener('click', function(e) {
                    if (!confirm('Apakah Anda yakin ingin menghapus komentar ini?')) {
                        e.preventDefault();
                    }
                });
            });
        });
    </script>
</x-app-layout>
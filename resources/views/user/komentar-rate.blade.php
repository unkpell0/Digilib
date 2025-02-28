<x-app-layout>
    <div class="container mx-auto p-4">
        <!-- Rating and Comment Section -->
        <div class="bg-white shadow-md rounded p-4 mb-4">
            <!-- Rating Stars -->
           
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
                <input type="hidden" id="rating-input" name="rating" value="{{ $userRating ?? 0 }}">                <!-- Textarea untuk komentar -->
                <textarea name="komentar"
                    class="w-full p-2 border rounded-lg text-sm focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    rows="2" placeholder="Tulis komentar..."></textarea>
                <button type="submit"
                    class="w-full px-4 py-2.5 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700 transition-colors">
                    <i class="fas fa-paper-plane mr-1"></i> Kirim Komentar
                </button>
            </form>

        </div>

        <!-- Reviews Section -->
        <div class="bg-white shadow-md rounded p-4">
            <h1 class="text-2xl font-bold mb-4">Review untuk: {{ $buku->nama_buku }}</h1>
            @if ($buku->comments->count() > 0)
                @foreach ($buku->comments as $comment)
                    <div class="border-b pb-2 mb-2 flex items-start gap-3">
                        <img src="{{ $comment->user->profile_photo_url }}" alt="Avatar"
                            class="w-10 h-10 rounded-full object-cover">
                        <div>
                            <p class="font-semibold">{{ $comment->user->name }}</p>
                            <!-- Tampilkan rating untuk komentar jika ada -->
                            @if ($comment->rating !== null)
                                <div class="flex items-center mb-1">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <span
                                            class="{{ $i <= $comment->rating ? 'text-yellow-400' : 'text-gray-300' }}">
                                            &#9733;
                                        </span>
                                    @endfor
                                </div>
                            @endif
                            <p>{{ $comment->komentar }}</p>
                            <small class="text-gray-500">{{ $comment->created_at->diffForHumans() }}</small>
                        </div>
                    </div>
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
            const stars = document.querySelectorAll('.star');
            const ratingInput = document.getElementById('rating-input');
            let selectedRating = {{ $userRating ?? 0 }};

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
            document.getElementById('comment-form').addEventListener('submit', function(e) {
                console.log('Form submitted with rating:', ratingInput.value);
            });

        });
    </script>
</x-app-layout>

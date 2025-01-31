<x-app-layout>
    <div class="container">
        <h1 class="text-2xl font-bold mb-4">Review untuk: {{ $buku->nama_buku }}</h1>

        <div class="bg-white shadow-md rounded p-4">
            @if($buku->comments->count() > 0)
                @foreach($buku->comments as $comment)
                    <div class="border-b pb-2 mb-2 flex items-start gap-3">
                        <img src="{{ $comment->user->profile_photo_url }}" 
                             alt="Avatar" 
                             class="w-10 h-10 rounded-full object-cover">
                        <div>
                            <p><strong>{{ $comment->user->name }}</strong></p>
                            <p>{{ $comment->komentar }}</p>
                            <small class="text-gray-500">{{ $comment->created_at->diffForHumans() }}</small>
                        </div>
                    </div>
                @endforeach
            @else
                <p class="text-gray-500">Belum ada review untuk buku ini.</p>
            @endif
        </div>
    </div>
</x-app-layout>

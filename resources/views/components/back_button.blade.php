@php
    $previousUrl = url()->previous();
    $currentUrl  = request()->url();
    $previousHost = parse_url($previousUrl, PHP_URL_HOST);
    $currentHost  = request()->getHost();

    // Jika URL sebelumnya ada, berbeda dengan URL saat ini, dan host sama, gunakan URL sebelumnya.
    // Jika tidak, fallback ke route('dashboard') atau route dashboard yang diinginkan.
    if ($previousUrl && ($previousUrl !== $currentUrl) && ($previousHost === $currentHost)) {
        $finalUrl = $previousUrl;
    } else {
        $finalUrl = route('dashboard'); // Ganti dengan route dashboard jika perlu, misalnya route('dashboard')
    }
@endphp

<a href="{{ $finalUrl }}"
   class="inline-flex items-center text-blue-600 hover:text-blue-800 mb-4 text-sm transition-colors">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20" fill="currentColor">
        <path fill-rule="evenodd"
              d="M10.707 3.293a1 1 0 0 1 0 1.414L6.414 9H17a1 1 0 1 1 0 2H6.414l4.293 4.293a1 1 0 0 1-1.414 1.414l-6-6a1 1 0 0 1 0-1.414l6-6a1 1 0 0 1 1.414 0z"
              clip-rule="evenodd" />
    </svg>
    Kembali
</a>

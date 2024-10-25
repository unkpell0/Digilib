<x-guest-layout class="flex flex-row-reverse ">
    <div class="flex h-screen w-full">
        <!-- Bagian Login -->
        <x-authentication-card>
            <x-slot name="logo">
                <x-authentication-card-logo />
            </x-slot>

            <x-validation-errors class="mb-4" />

            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div>
                    <x-label for="email" value="{{ __('Email') }}" />
                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                        required autofocus autocomplete="username" placeholder="Masukkan email anda"/>
                </div>

                <!-- Input Password dengan Ikon Mata -->
                <div class="mt-3">
                    <x-label for="password" value="{{ __('Password') }}" />
                    <div class="relative mt-1">
                        <x-input id="password" class="block w-full" type="password" name="password" required placeholder="Masukkan password anda"/>
                        <div onclick="togglePassword()"
                            class="absolute inset-y-0 right-3 flex items-center cursor-pointer">
                            <i id="eyeIcon" class="fas fa-eye-slash text-gray-500"></i>
                        </div>
                    </div>
                </div>

                <div class="block mt-4">
                    <label for="remember_me" class="flex items-center">
                        <x-checkbox id="remember_me" name="remember" />
                        <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-center my-2">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                            href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif

                    <x-button class="ms-4" style="background-color: #377CC5; color:white;">
                        {{ __('Log in') }}
                    </x-button>
                </div>
                <div
                    class="flex items-center justify-center my-3 space-x-1.5 text-sm text-gray-500 antialiased font-sans">
                    <h3>Belum punya akun?</h3>
                    <a href="{{ Route('register') }}">{{ __('Registrasi Disini') }}</a>
                </div>
                <div class="flex flex-col space-y-2 my-2 justify-center items-center">
                    <a href="#"
                        class="inline-flex justify-center px-2 py-2 text-lg text-gray-700 hover:text-gray-900 ring-2 w-full rounded-2xl border-slate-950 text-center shadow-sm transition duration-200"><i
                            class="fa-brands fa-google mt-1 mx-2.5 fa-lg"></i> Masuk dengan Google</a>
                    <a href="#"
                        class="inline-flex justify-center px-2 py-2 text-lg text-gray-700 hover:text-gray-900 ring-2 w-full rounded-2xl border-slate-950 text-center shadow-sm transition duration-200"><i
                            class="fa-brands fa-facebook mt-1 mx-2.5 fa-lg"></i> Masuk dengan Facebook</a>
                </div>
            </form>
        </x-authentication-card>

        <!-- Bagian Background yang Menempati Sisa Ruang -->
        <div class="flex-grow bg-slate-400 bg-cover"
            style="background-image: url('{{ asset('img/readbook.jpg') }}'); background-position: 55% -40%;">
        </div>
    </div>
</x-guest-layout>

<!-- Script untuk toggle password visibility -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
<script>
    function togglePassword() {
        const passwordInput = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.classList.remove('fa-eye-slash');
            eyeIcon.classList.add('fa-eye');
        } else {
            passwordInput.type = 'password';
            eyeIcon.classList.remove('fa-eye');
            eyeIcon.classList.add('fa-eye-slash');
        }
    }
</script>

<!-- Include FontAwesome -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

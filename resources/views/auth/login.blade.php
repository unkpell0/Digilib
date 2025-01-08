@section('title', 'LOGIN')
<x-guest-layout class="flex flex-row-reverse overflow-hidden">
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

                <div class="group">
                    <x-label for="email" value="{{ __('Email') }}"
                        class="after:content-['*'] after:ml-0.5 after:text-pink-500 after:text-base" />
                    <x-input id="email" class="peer block mt-1 w-full" type="email" name="email"
                        :value="old('email')" required autofocus autocomplete="email"
                        placeholder="Masukkan email anda" oninput="validateEmail()" />
                    <p id="emailError" class="text-sm font-sans text-pink-400 mt-1 hidden">Email anda tidak valid</p>
                </div>

                <!-- Input Password dengan Ikon Mata -->
                <div class="mt-1.5 group">
                    <x-label for="password" value="{{ __('Password') }}"
                        class="after:content-['*'] after:ml-0.5 after:text-pink-500 after:text-base" />
                    <div class="relative mt-1">
                        <x-input id="password" class="block w-full" type="password" name="password" required
                            minlength="4" autocomplete="current-password" placeholder="Masukkan password anda"
                            oninput="validatePassword()" />
                        <div onclick="togglePassword()"
                            class="absolute inset-y-0 right-3 flex items-center cursor-pointer">
                            <i id="eyeIcon" class="fas fa-eye-slash text-gray-500"></i>
                        </div>
                    </div>
                    <p id="passwordError" class="text-sm font-sans text-pink-400 mt-1 hidden">
                        Masukkan password minimal 4 karakter
                    </p>
                </div>

                <div class="block mt-4">
                    <label for="remember_me" class="flex items-center">
                        <x-checkbox class="hover:bg-slate-200" id="remember_me" name="remember" />
                        <span for="remember_me"
                            class="ms-2 text-sm text-gray-600 cursor-pointer">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-center my-2">
                    @if (Route::has('password.request'))
                        <a class="hover:underline hover:underline-offset-4 text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                            href="{{ route('password.request') }}">
                            {{ __('Lupa Password?') }}
                        </a>
                    @endif
            
                    <x-button class="ms-4 bg-sky-600 text-white hover:bg-sky-500">
                        {{ __('Masuk') }}
                    </x-button>
                </div>
                <div
                    class="flex items-center justify-center my-3 space-x-1.5 text-sm text-gray-500 antialiased font-sans">
                    <h3 class="text-md cursor-default">Belum punya akun?</h3>
                    <a class="hover:underline hover:underline-offset-4 hover:text-gray-900"
                        href="{{ Route('register') }}">{{ __('Registrasi Disini') }}</a>
                </div>
                <div class="flex flex-col space-y-2 my-2 justify-center items-center">
                    <a href="auth/redirect"
                        class="inline-flex justify-center px-2 py-2 text-lg text-gray-700 hover:text-gray-900 hover:bg-slate-200 ring-2 w-full rounded-2xl border-slate-950 text-center shadow-sm transition duration-200"><i
                            class="fa-brands fa-google mt-1 mx-2.5 fa-lg"></i> Masuk dengan Google</a>
                    <a href="auth/facebook"
                        class="inline-flex justify-center px-2 py-2 text-lg text-gray-700 hover:text-gray-900 hover:bg-slate-200 ring-2 w-full rounded-2xl border-slate-950 text-center shadow-sm transition duration-200"><i
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
    };

    // Validate Password Length
    function validatePassword() {
        const passwordInput = document.getElementById('password');
        const passwordError = document.getElementById('passwordError');
        if (passwordInput.value === "") {
            passwordInput.classList.remove('invalid');
            passwordError.classList.add('hidden');
            return;
        }

        if (passwordInput.value.length <= 4) {
            passwordError.classList.remove('hidden');
            passwordInput.classList.add('invalid');
        } else {
            passwordError.classList.add('hidden');
            passwordInput.classList.remove('invalid');
        }
    }

    // Validate Email
    function validateEmail() {
        const email = document.getElementById('email');
        const emailError = document.getElementById('emailError');
        const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;

        if (email.value === "") {
            email.classList.remove('invalid');
            emailError.classList.add('hidden');
            return;
        }

        if (!emailPattern.test(email.value)) {
            emailError.classList.remove('hidden');
            email.classList.add('invalid');
        } else {
            emailError.classList.add('hidden');
            email.classList.remove('invalid');
        }
    }
</script>

<!-- Include FontAwesome -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

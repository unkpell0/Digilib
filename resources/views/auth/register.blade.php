<x-guest-layout class="overflow-y-scroll">
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Nama -->
            <div class="group">
                <x-label for="name" value="{{ __('Nama') }}" />
                <x-input id="name" class="peer block mt-1 w-full placeholder:italic placeholder:text-slate-400"
                    type="text" name="name" :value="old('name')" required autofocus autocomplete="name"
                    placeholder="Masukkan nama anda" minlength="4" oninput="validateName()"/>
                <p id="nameError" class="text-sm font-sans text-pink-400 mt-1 hidden">Masukkan
                    minimal 4 huruf</p>
            </div>

            <!-- Email -->
            <div class="mt-2 group">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="peer block mt-1 w-full placeholder:italic placeholder:text-slate-400"
                    type="email" name="email" :value="old('email')" required autocomplete="email"
                    placeholder="Masukkan email anda" oninput="validateEmail()"/>
                <p id="emailError" class="text-sm font-sans text-pink-400 mt-1 hidden">Email anda tidak
                    valid</p>
            </div>

            <!-- Input Password dengan Ikon Mata -->
            <div class="mt-2 group">
                <x-label for="password" value="{{ __('Password') }}" />
                <div class="relative mt-1">
                    <x-input id="password" class="block w-full placeholder:italic placeholder:text-slate-400"
                        type="password" name="password" required autocomplete="new-password" minlength="5"
                        placeholder="Masukkan password anda" oninput="validatePassword()" />
                    <div onclick="togglePassword('password', 'eyeIcon')"
                        class="absolute inset-y-0 right-3 flex items-center cursor-pointer">
                        <i id="eyeIcon" class="fas fa-eye-slash text-gray-500"></i>
                    </div>
                </div>
                <p id="passwordError" class="text-sm font-sans text-pink-400 mt-1 hidden">
                    Masukkan password minimal 4 karakter
                </p>
            </div>

            <!-- Confirm Password dengan Ikon Mata -->
            <div class="mt-2 group">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <div class="relative mt-1">
                    <x-input id="password_confirmation"
                        class="block w-full placeholder:italic placeholder:text-slate-400" type="password"
                        name="password_confirmation" required autocomplete="new-password"
                        placeholder="Masukkan sekali lagi" oninput="validatePasswordMatch()" />
                    <div onclick="togglePassword('password_confirmation', 'eyeIconConfirm')"
                        class="absolute inset-y-0 right-3 flex items-center cursor-pointer">
                        <i id="eyeIconConfirm" class="fas fa-eye-slash text-gray-500"></i>
                    </div>
                </div>
                <p id="confirmPasswordError" class="text-sm font-sans text-pink-400 mt-1 hidden">
                    Password tidak cocok
                </p>
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <!-- Terms and Privacy Policy -->
                <div class="mt-2">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />
                            <div class="ms-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                    'terms_of_service' =>
                                        '<a target="_blank" href="' .
                                        route('terms.show') .
                                        '" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">' .
                                        __('Terms of Service') .
                                        '</a>',
                                    'privacy_policy' =>
                                        '<a target="_blank" href="' .
                                        route('policy.show') .
                                        '" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">' .
                                        __('Privacy Policy') .
                                        '</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <!-- Register and Login Links -->
            <div class="flex items-center justify-center my-3">
                <a class="hover:underline hover:underline-offset-4 text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('login') }}">
                    {{ __('Sudah punya akun?') }}
                </a>
                <x-button class="ms-4 bg-sky-600 text-white hover:bg-sky-500 ">
                    {{ __('Daftar') }}
                </x-button>
            </div>

            <!-- Social Login Buttons -->
            <div class="flex flex-col space-y-2 my-2 justify-center items-center">
                <a href="auth/redirect"
                    class="inline-flex justify-center px-2 py-2 text-lg text-gray-700 hover:text-gray-900 ring-2 w-full rounded-2xl border-slate-950 text-center shadow-sm transition duration-200">
                    <i class="fa-brands fa-google mt-1 mx-2.5 fa-lg"></i> Daftar dengan Google
                </a>
                <a href="#"
                    class="inline-flex justify-center px-2 py-2 text-lg text-gray-700 hover:text-gray-900 ring-2 w-full rounded-2xl border-slate-950 text-center shadow-sm transition duration-200">
                    <i class="fa-brands fa-facebook mt-1 mx-2.5 fa-lg"></i> Daftar dengan Facebook
                </a>
            </div>
        </form>
    </x-authentication-card>

    <!-- Background Image -->
    <div class="flex-grow bg-slate-400 bg-cover bg-center hidden lg:flex"
        style="background-image: url('{{ asset('img/girlreadbook.jpg') }}')"></div>

    <script>
         <!-- Toggle Password Visibility Script -->
        function togglePassword(fieldId, eyeIconId) {
            var field = document.getElementById(fieldId);
            var eyeIcon = document.getElementById(eyeIconId);
            if (field.type === "password") {
                field.type = "text";
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            } else {
                field.type = "password";
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            }
        };

        // Validate Name
        function validateName(){
            const nameInput = document.getElementById('name');
            const nameError = document.getElementById('nameError');
            // Hapus error jika input kosong
            if (nameInput.value === "") {
                nameInput.classList.remove('invalid');
                nameError.classList.add('hidden');
                return;
            }

            // Tampilkan pesan error jika panjang kurang dari 5
            if (nameInput.value.length < 4) {
                nameError.classList.remove('hidden'); 
                nameInput.classList.add('invalid');
            } else {
                nameError.classList.add('hidden'); 
                nameInput.classList.remove('invalid');
            }
        }

        // Validate Email
        function validateEmail(){
            const emailInput = document.getElementById('email');
            const emailError = document.getElementById('emailError');
            const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
            if (emailInput.value === "") {
                emailInput.classList.remove('invalid');
                emailError.classList.add('hidden');
                return;
            }

            if (!emailPattern.test(emailInput.value)) {
                emailError.classList.remove('hidden');
                emailInput.classList.add('invalid');
            } else {
                emailError.classList.add('hidden');
                emailInput.classList.remove('invalid');
            }
        }

        // Validate Password Length
        function validatePassword() {
            const passwordInput = document.getElementById('password');
            const passwordError = document.getElementById('passwordError');
            if (passwordInput.value === "") {
                passwordInput.classList.remove('invalid');
                passwordError.classList.add('hidden');
                return;
            }

            if (passwordInput.value.length < 4) {
                passwordError.classList.remove('hidden');
                passwordInput.classList.add('invalid');
            } else {
                passwordError.classList.add('hidden');
                passwordInput.classList.remove('invalid');
            }
        }

    // Validate Password Match
        function validatePasswordMatch() {
            const password = document.getElementById('password');
            const confirmPassword = document.getElementById('password_confirmation');
            const confirmPasswordError = document.getElementById('confirmPasswordError');
            if (confirmPassword.value === "") {
                confirmPassword.classList.remove('invalid');
                confirmPasswordError.classList.add('hidden');
                return;
            }

            if (password.value !== confirmPassword.value) {
                confirmPasswordError.classList.remove('hidden');
                confirmPassword.classList.add('invalid');
            } else {
                confirmPasswordError.classList.add('hidden');
                confirmPassword.classList.remove('invalid');
            }
        };
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
</x-guest-layout>

<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf
        
            <div>
                <x-label for="name" value="{{ __('Name') }}" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>
        
            <div class="mt-3">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            </div>
        
            <!-- Input Password dengan Ikon Mata -->
            <div class="mt-3">
                <x-label for="password" value="{{ __('Password') }}" />
                <div class="relative mt-1">
                    <x-input id="password" class="block w-full" type="password" name="password" required autocomplete="new-password" />
                    <div onclick="togglePassword('password', 'eyeIcon')" class="absolute inset-y-0 right-3 flex items-center cursor-pointer">
                        <i id="eyeIcon" class="fas fa-eye-slash text-gray-500"></i>
                    </div>
                </div>
            </div>
        
            <!-- Confirm Password dengan Ikon Mata -->
            <div class="mt-3">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <div class="relative mt-1">
                    <x-input id="password_confirmation" class="block w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                    <div onclick="togglePassword('password_confirmation', 'eyeIconConfirm')" class="absolute inset-y-0 right-3 flex items-center cursor-pointer">
                        <i id="eyeIconConfirm" class="fas fa-eye-slash text-gray-500"></i>
                    </div>
                </div>
            </div>
        
            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-3">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />
                            <div class="ms-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif
        
            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('Sudah punya akun?') }}
                </a>
        
                <x-button class="ms-4" style="background-color: #377CC5; color:white;">
                    {{ __('Daftar') }}
                </x-button>
            </div>
        </form>
        
        <script>
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
            }
        </script>
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
        
    </x-authentication-card>
</x-guest-layout>

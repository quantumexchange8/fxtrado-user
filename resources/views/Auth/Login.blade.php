@extends('layouts.guest')
@section('contents')
    <div class="col-md-12">
        <div class="exchange__widget_center">
            <div class="exchange__widget exchange-email-verify">
                <h2>{{ __('welcome') }}</h2>
                {{-- <a href="#" class="google-button"><img src="assets/img/svg-icon/google.svg" class="svgInject" alt="svg">
                login
                with
                google</a>
                <h6>Or login with</h6> --}}
                <form action="{{ route('store') }}" method="POST" id="loginForm">
                    @csrf
                    <div style="display: flex;justify-content:flex-end">
                        <i class="fa-solid fa-language" style="width: 50px;height:40px;cursor: pointer;" onclick="toggleLanguage()"></i>
                    </div>
                    <div class="text-left">
                        <label for="email">{{ __('email') }}</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="{{ __('enter_your_email') }}">
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <label for="password">{{ __('password') }}</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="{{ __('enter_your_password') }}">
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" id="submitBtn">{{ __('login') }}</button>
                </form>
            <span>{{ __('not_register_yet') }}? <a href="{{ route('register')}}">{{ __('sign_up') }}</a></span>
            </div>
        </div>
    </div>

    <script>
        const translations = {
            logging: "{{ __('logging') }}"
        };
    </script>

    <script>

        document.getElementById('loginForm').addEventListener('submit', function() {
            // Disable the submit button to prevent multiple submissions
            document.getElementById('submitBtn').disabled = true;
            document.getElementById('submitBtn').innerText = translations.logging; // Optional: change button text to show it's processing
        });
    </script>

    <script>
        function toggleLanguage() {
            // Get current language from session or default to 'en'
            const currentLang = "{{ session('locale', 'en') }}";
            
            // Determine next language based on current language
            const nextLang = currentLang === 'en' ? 'tw' : 'en';

            // Redirect to the switch language route
            window.location.href = `/switch-language/${nextLang}`;
        }
    </script>
@endsection
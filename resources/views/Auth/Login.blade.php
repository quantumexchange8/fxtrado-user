@extends('layouts.guest')
@section('contents')

<style>
    .language-selector {
        background-color: black;
        border: none;
        color: white;
        font-size: 16px;
        cursor: pointer;
        padding: 5px;
    }
    .language-selector:focus {
        outline: none;
    }
    .logoSize {
        width: 50%;
        margin-bottom: 20px
    }
</style>

    <div class="col-md-12">
        <div class="exchange__widget_center">
            <div class="exchange__widget exchange-email-verify">
                <div>
                    <img src="assets/img/fxtrado_logo.svg" class="logoSize" alt="fxtrado logo">
                </div>
                <h2>{{ __('welcome') }}</h2>
                {{-- <a href="#" class="google-button"><img src="assets/img/svg-icon/google.svg" class="svgInject" alt="svg">
                login
                with
                google</a>
                <h6>Or login with</h6> --}}
                <form action="{{ route('store') }}" method="POST" id="loginForm">
                    @csrf
                    <div style="display: flex;justify-content:flex-end">
                        <select class="language-selector" onchange="changeLanguage(event)">
                            <option value="en" {{ session('locale') === 'en' ? 'selected' : '' }}>English</option>
                            <option value="tw" {{ session('locale') === 'tw' ? 'selected' : '' }}>繁體中文</option>
                            <option value="cn" {{ session('locale') === 'cn' ? 'selected' : '' }}>简体中文</option>
                            <option value="jpy" {{ session('locale') === 'jpy' ? 'selected' : '' }}>日本語</option>
                            <option value="korea" {{ session('locale') === 'korea' ? 'selected' : '' }}>한국인</option>
                            <option value="thai" {{ session('locale') === 'thai' ? 'selected' : '' }}>แบบไทย</option>
                            <option value="vn" {{ session('locale') === 'vn' ? 'selected' : '' }}>Tiếng Việt</option>
                            <!-- Add more languages if necessary -->
                        </select>
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
        function changeLanguage(event) {
            const selectedLang = event.target.value;
            // Redirect to the appropriate route to switch language
            window.location.href = `/switch-language/${selectedLang}`;
        }
    </script>
@endsection
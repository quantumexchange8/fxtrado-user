@extends('layouts.guest')
@section('contents')
    <div class="col-md-12">
        <div class="exchange__widget_center">
            <div class="exchange__widget exchange-email-verify">
                <h2>Hi, Welcome Back!</h2>
                {{-- <a href="#" class="google-button"><img src="assets/img/svg-icon/google.svg" class="svgInject" alt="svg">
                login
                with
                google</a>
                <h6>Or login with</h6> --}}
                <form action="{{ route('store') }}" method="POST" id="loginForm">
                    @csrf
                    <div class="text-left">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Enter Your Email">
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Enter Your password">
                        @error('password')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" id="submitBtn">Login</button>
                </form>
            <span>Not registered yet? <a href="{{ route('register')}}">Sign Up</a></span>
            </div>
        </div>
    </div>

    <script>

        document.getElementById('loginForm').addEventListener('submit', function() {
            // Disable the submit button to prevent multiple submissions
            document.getElementById('submitBtn').disabled = true;
            document.getElementById('submitBtn').innerText = 'Logging...'; // Optional: change button text to show it's processing
        });
    </script>
@endsection
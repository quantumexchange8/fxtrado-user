@extends('layouts.guest')
@section('contents')
<div class="exchange__wrapper">
    <div class="container-fluid">
      <div class="row sm-gutters">
        <div class="col-md-12">
          <div class="exchange__widget_center">
            <div class="exchange__widget exchange-email-verify">
              <h2>Get Started Now</h2>
              <form action="{{ route('storeRegister') }}" method="POST" id="registerForm">
                @csrf
                <div class="text-left">
                  <label for="fullName">Full name</label>
                  <input type="text" class="form-control" name="fullName" id="fullName" placeholder="Enter Your full name">
                    @error('fullName')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

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
                  <label for="confirmPassword">Confirm password</label>
                  <input type="password" class="form-control" name="password_confirmation" id="confirmPassword" placeholder="Confirm Your password">
                    @error('password_confirmation')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" id="submitBtn">Sign Up</button>
              </form>
              <span>Already have an account? <a href="{{ route('login')}}">Login</a></span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>

    console.log
    document.getElementById('registerForm').addEventListener('submit', function() {
        // Disable the submit button to prevent multiple submissions
        document.getElementById('submitBtn').disabled = true;
        document.getElementById('submitBtn').innerText = 'Processing...'; // Optional: change button text to show it's processing
    });
</script>
@endsection
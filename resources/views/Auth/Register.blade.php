@extends('layouts.guest')
@section('contents')
<div class="exchange__wrapper">
    <div class="container-fluid">
      <div class="row sm-gutters">
        <div class="col-md-12">
          <div class="exchange__widget_center">
            <div class="exchange__widget exchange-email-verify">
              <h2>{{ __('get_started_now') }}</h2>
              <form action="{{ route('storeRegister') }}" method="POST" id="registerForm">
                @csrf
                <div class="text-left">
                  <label for="fullName">{{ __('full_name') }}</label>
                  <input type="text" class="form-control" name="fullName" id="fullName" placeholder="{{ __('enter_your_fullname') }}">
                    @error('fullName')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror

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
                  <label for="confirmPassword">{{ __('confirm_password') }}</label>
                  <input type="password" class="form-control" name="password_confirmation" id="confirmPassword" placeholder="{{ __('confirm_password') }}">
                    @error('password_confirmation')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" id="submitBtn">{{ __('sign_up') }}</button>
              </form>
              <span>{{ __('already_have_acc') }}? <a href="{{ route('login')}}">{{ __('back_login') }}</a></span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  
  <script>
    const translations = {
      processing: "{{ __('processing') }}"
    };
</script>

  <script>

    document.getElementById('registerForm').addEventListener('submit', function() {
        // Disable the submit button to prevent multiple submissions
        document.getElementById('submitBtn').disabled = true;
        document.getElementById('submitBtn').innerText = translations.processing; // Optional: change button text to show it's processing
    });
</script>
@endsection
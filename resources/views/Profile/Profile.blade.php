@extends('layouts.master')
@section('contents')
    
  <style>
    .form-control:disabled {
      background-color: #353535;
    }
  </style>
  
    <div class="exchange__wrapper">
        <div class="container-fluid">
            <div class="row sm-gutters">
                @include('layouts.topbar')

                <div class="exchange__wrapper">
                    <div class="container-fluid">
                      <div class="row sm-gutters" style="justify-content: center">
                        
                        <div class="col-md-6">
                          <div class="exchange__widget">
                            <h2 class="exchange__widget-title">{{ __('general_info') }}</h2>
                            <div class="exchange__widget__profile">
                              <form action="{{ route('updateProfile') }}" method="POST" onsubmit="disableButton()">
                                @csrf
                                <div class="row">
                                  <div class="col-md-12">
                                    <div class="exchange__widget__profile-avatar">
                                      <img src="assets/img/svg-icon/avatar.svg" class="svgInject" alt="svg">
                                      {{-- <span><img src="assets/img/svg-icon/edit.svg" class="svgInject" alt="svg"></span> --}}
                                    </div>
                                  </div>
                                  
                                  <div class="col-md-12">
                                    <label for="firstName">{{ __('first_name') }}</label>
                                    <input type="text" name="firstName" value="{{ $user->name}}" class="form-control" id="firstName" placeholder="First Name">
                                  </div>
                                  <div class="col-md-12">
                                    <label for="email">{{ __('email') }}</label>
                                    <input type="email" name="email" value="{{ $user->email }}" class="form-control" id="email" placeholder="{{ __('enter_your_email') }}">
                                  </div>
                                  <div class="col-md-12">
                                    <label for="number">{{ __('phone') }}</label>
                                    <input type="number" name="number" value="{{ $user->phone_number }}" class="form-control" id="number" placeholder="{{ __('enter_your_phone') }}">
                                  </div>
                                  {{-- <div class="col-md-12">
                                    <label for="address">{{ __('address') }} </label>
                                    <input type="text" name="address" value="{{ $user->address }}" class="form-control" id="address" placeholder="{{ __('enter_your_address') }}">
                                  </div>
                                  <div class="col-md-6">
                                    <label for="city">{{ __('city') }} </label>
                                    <input type="text" name="city" value="{{ $user->city }}" class="form-control" id="city" placeholder="{{ __('enter_your_city') }}">
                                  </div>
                                  <div class="col-md-6">
                                    <label for="state">{{ __('state') }} </label>
                                    <input type="text" name="state" value="{{ $user->state }}" class="form-control" id="state" placeholder="{{ __('enter_your_state') }}">
                                  </div>
                                  <div class="col-md-6">
                                    <label for="zipCode">{{ __('zip') }} </label>
                                    <input type="number" name="zipCode" value="{{ $user->zip }}" class="form-control" id="zipCode" placeholder="{{ __('enter_your_zip') }}">
                                  </div>
                                  <div class="col-md-6">
                                    <label for="country">{{ __('country') }} </label>
                                    <input type="text" name="country" value="{{ $user->country }}" class="form-control" id="country" placeholder="{{ __('enter_your_country') }}">
                                  </div> --}}
                                  <div class="col-md-12">
                                    <button type="submit" id="saveVerifyButton">{{ __('save') }}</button>
                                  </div>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                        {{-- <div class="col-md-6">
                          <div class="exchange__widget">
                            <h2 class="exchange__widget-title">{{ __('security_info') }}</h2>
                            <div id="errors"></div>
                            <div id="successMessage"></div>
                            <div class="exchange__widget__profile">
                              <form id="securityForm" action="{{ route('updateSecurity') }}" method="POST">
                                @csrf
                                <div class="row">
                                  <div class="col-md-12">
                                    <button type="submit" >
                                      {{ __('reset_password') }}
                                    </button>
                                  </div>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div> --}}
                      </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function disableButton() {
          const button = document.getElementById('saveVerifyButton') || document.querySelector('button[type="submit"]');
          button.disabled = true;
          button.style.setProperty('background', '#1f2937', 'important');
        }

        $('#securityForm').on('submit', function(e) {
            e.preventDefault(); // Prevent the form from submitting traditionally

            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    // Clear any previous errors
                    $('#errors').html('');
                    
                    // Display success message
                    $('#successMessage').html('<div class="alert alert-success">' + response.status + '</div>');
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        // Handle validation errors
                        var errors = xhr.responseJSON.errors;
                        var errorMessages = '<div class="alert alert-danger"><ul>';

                        $.each(errors, function(key, value) {
                            errorMessages += '<li>' + value[0] + '</li>';
                        });

                        errorMessages += '</ul></div>';
                        $('#errors').html(errorMessages);
                    }
                }
            });
        });
    </script>
@endsection
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
                      <div class="row sm-gutters">
                        
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
                                  @if ($user->email_verified_at == null)
                                    <div class="col-md-12" style="display: flex; gap:4px; flex-direction:column;">
                                      {{-- <div style="display: flex; gap:24px; align-items:center">
                                        <label for="email">Verify Account</label>
                                        <button class="type" style="margin-top: 0px">Verify</button>
                                      </div> --}}
                                      <div style="display: flex; gap:8px;">
                                        <i class="fa fa-exclamation-circle" style="color: white" aria-hidden="true"></i> <span class="text-white text-xs" style="font-size:14px">{{ __('send_email') }}.</span>
                                      </div>
                                    </div>
                                  @endif
                                  <div class="col-md-6">
                                    <label for="firstName">{{ __('first_name') }}</label>
                                    <input type="text" name="firstName" value="{{ $user->name}}" class="form-control" id="firstName" placeholder="First Name">
                                  </div>
                                  <div class="col-md-6">
                                    <label for="lastName">{{ __('last_name') }}</label>
                                    <input type="text" name="lastName" value="{{ $user->last_name }}"  class="form-control" id="lastName" placeholder="{{ __('last_name') }}">
                                  </div>
                                  @if ($user->email_verified_at !== null)
                                    <div class="col-md-12">
                                      <label for="email">{{ __('email') }}</label>
                                      <input type="email" name="email" value="{{ $user->email }}" class="form-control" id="email" placeholder="{{ __('enter_your_email') }}" disabled>
                                    </div>
                                  @else 
                                    <div class="col-md-12">
                                      <label for="email">{{ __('email') }}</label>
                                      <input type="email" name="email" value="{{ $user->email }}" class="form-control" id="email" placeholder="{{ __('enter_your_email') }}">
                                    </div>
                                  @endif
                                  <div class="col-md-12">
                                    <label for="number">{{ __('phone') }}</label>
                                    <input type="number" name="number" value="{{ $user->phone_number }}" class="form-control" id="number" placeholder="{{ __('enter_your_phone') }}">
                                  </div>
                                  <div class="col-md-12">
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
                                  </div>
                                  @if ($user->email_verified_at == null)
                                    <input type="text" hidden name="verifyAcc" value="{{ 'verifyUser' }}" class="form-control" id="verifyAcc">
                                    <div class="col-md-12">
                                      <button type="submit" id="saveVerifyButton">{{ __('save_verify') }}</button>
                                    </div>
                                  @else
                                    <div class="col-md-12">
                                      <button type="submit" id="saveVerifyButton">{{ __('save') }}</button>
                                    </div>
                                  @endif
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="exchange__widget">
                            <h2 class="exchange__widget-title">{{ __('security_info') }}</h2>
                            <div id="errors"></div>
                            <div id="successMessage"></div>
                            <div class="exchange__widget__profile">
                              <form id="securityForm" action="{{ route('updateSecurity') }}" method="POST">
                                @csrf
                                <div class="row">
                                  <div class="col-md-6">
                                    <label for="securityOne">{{ __('security_question') }}</label>
                                    <select id="securityOne" name="securityOne" class="custom-select">
                                      <option selected="">{{ __('choose') }}</option>
                                      <option>{{ __('petname') }}?</option>
                                      <option>{{ __('mothername') }}?</option>
                                      <option>{{ __('schoolname') }}?</option>
                                      <option>{{ __('travelname') }}?</option>
                                    </select>
                                  </div>
                                  <div class="col-md-6">
                                    <label for="securityAnsOne">{{ __('answer') }}</label>
                                    <input id="securityAnsOne" name="securityAnsOne" type="text" class="form-control" placeholder="{{ __('enter_your_answer') }}">
                                  </div>
                                  <div class="col-md-12">
                                    <label for="username">{{ __('username') }}</label>
                                    <input type="text" class="form-control" name="username" id="username" placeholder="{{ __('enter_your_username') }}">
                                  </div>
                                  <div class="col-md-12">
                                    <label for="currentPassword">{{ __('current_password') }}</label>
                                    <input type="password" class="form-control" name="currentPassword" id="currentPassword"
                                      placeholder="{{ __('enter_current_password') }} ">
                                    @error('currentPassword')
                                      <div class="text-danger">{{ $message->errors->currentPassword }}</div>
                                    @enderror
                                  </div>
                                  <div class="col-md-12">
                                    <label for="password">{{ __('new_password') }}</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="{{ __('enter_your_password') }}">
                                  </div>
                                  <div class="col-md-12">
                                    <label for="password_confirmation">{{ __('confirm_new_password') }}</label>
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                                      placeholder="{{ __('confirm_new_password') }}">
                                  </div>
                                  <div class="col-md-12">
                                    <button type="submit">{{ __('save') }}</button>
                                  </div>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
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
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
                            <h2 class="exchange__widget-title">General Information</h2>
                            <div class="exchange__widget__profile">
                              <form action="{{ route('updateProfile') }}" method="POST">
                                @csrf
                                <div class="row">
                                  <div class="col-md-12">
                                    <div class="exchange__widget__profile-avatar">
                                      <img src="assets/img/svg-icon/avatar.svg" class="svgInject" alt="svg">
                                      <span><img src="assets/img/svg-icon/edit.svg" class="svgInject" alt="svg"></span>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <label for="firstName">First Name</label>
                                    <input type="text" name="firstName" value="{{ $user->name}}" class="form-control" id="firstName" placeholder="First Name">
                                  </div>
                                  <div class="col-md-6">
                                    <label for="lastName">Last Name</label>
                                    <input type="text" name="lastName" value="{{ $user->last_name }}"  class="form-control" id="lastName" placeholder="Last Name">
                                  </div>
                                  <div class="col-md-12">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" value="{{ $user->email }}" class="form-control" id="email" placeholder="Enter Your Email" disabled>
                                  </div>
                                  <div class="col-md-12">
                                    <label for="number">Phone Number</label>
                                    <input type="number" name="number" value="{{ $user->phone_number }}" class="form-control" id="number" placeholder="Enter Your Number">
                                  </div>
                                  <div class="col-md-12">
                                    <label for="address">Address</label>
                                    <input type="text" name="address" value="{{ $user->address }}" class="form-control" id="address" placeholder="Enter Your Address">
                                  </div>
                                  <div class="col-md-6">
                                    <label for="city">City</label>
                                    <input type="text" name="city" value="{{ $user->city }}" class="form-control" id="city" placeholder="Enter Your City">
                                  </div>
                                  <div class="col-md-6">
                                    <label for="state">State</label>
                                    <input type="text" name="state" value="{{ $user->state }}" class="form-control" id="state" placeholder="Enter Your State">
                                  </div>
                                  <div class="col-md-6">
                                    <label for="zipCode">Zip code</label>
                                    <input type="number" name="zipCode" value="{{ $user->zip }}" class="form-control" id="zipCode" placeholder="Enter Your Zip Code">
                                  </div>
                                  <div class="col-md-6">
                                    <label for="country">Country</label>
                                    <input type="text" name="country" value="{{ $user->country }}" class="form-control" id="country" placeholder="Enter Your Country">
                                  </div>
                                  <div class="col-md-12">
                                    <button type="submit">Save</button>
                                  </div>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="exchange__widget">
                            <h2 class="exchange__widget-title">Security Information</h2>
                            <div id="errors"></div>
                            <div id="successMessage"></div>
                            <div class="exchange__widget__profile">
                              <form id="securityForm" action="{{ route('updateSecurity') }}" method="POST">
                                @csrf
                                <div class="row">
                                  <div class="col-md-6">
                                    <label for="securityOne">Security questions</label>
                                    <select id="securityOne" name="securityOne" class="custom-select">
                                      <option selected="">Choose...</option>
                                      <option>What was the name of your first pet?</option>
                                      <option>What's your Mother's middle name?</option>
                                      <option>What was the name of your first school?</option>
                                      <option>Where did you travel for the first time?</option>
                                    </select>
                                  </div>
                                  <div class="col-md-6">
                                    <label for="securityAnsOne">Answer</label>
                                    <input id="securityAnsOne" name="securityAnsOne" type="text" class="form-control" placeholder="Enter your answer">
                                  </div>
                                  <div class="col-md-12">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" name="username" id="username" placeholder="Enter Your Username">
                                  </div>
                                  <div class="col-md-12">
                                    <label for="currentPassword">Current Password</label>
                                    <input type="password" class="form-control" name="currentPassword" id="currentPassword"
                                      placeholder="Enter Current Password">
                                    @error('currentPassword')
                                      <div class="text-danger">{{ $message->errors->currentPassword }}</div>
                                    @enderror
                                  </div>
                                  <div class="col-md-12">
                                    <label for="password">New Password</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter New Password">
                                  </div>
                                  <div class="col-md-12">
                                    <label for="password_confirmation">Confirm New Password</label>
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                                      placeholder="Confirm New Password">
                                  </div>
                                  <div class="col-md-12">
                                    <button type="submit">Save</button>
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
@extends('layouts.master')
@section('contents')
    
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
                                    <input type="text" name="firstName" class="form-control" id="firstName" placeholder="First Name">
                                  </div>
                                  <div class="col-md-6">
                                    <label for="lastName">Last Name</label>
                                    <input type="text" name="lastName" class="form-control" id="lastName" placeholder="Last Name">
                                  </div>
                                  <div class="col-md-12">
                                    <label for="email">Email</label>
                                    <input type="email" name="email" class="form-control" id="email" placeholder="Enter Your Email">
                                  </div>
                                  <div class="col-md-12">
                                    <label for="number">Phone Number</label>
                                    <input type="number" name="number" class="form-control" id="number" placeholder="Enter Your Number">
                                  </div>
                                  <div class="col-md-12">
                                    <label for="address">Address</label>
                                    <input type="text" name="address" class="form-control" id="address" placeholder="Enter Your Address">
                                  </div>
                                  <div class="col-md-6">
                                    <label for="city">City</label>
                                    <input type="text" name="city" class="form-control" id="city" placeholder="Enter Your City">
                                  </div>
                                  <div class="col-md-6">
                                    <label for="state">State</label>
                                    <input type="text" name="state" class="form-control" id="state" placeholder="Enter Your State">
                                  </div>
                                  <div class="col-md-6">
                                    <label for="zipCode">Zip code</label>
                                    <input type="number" name="zipCode" class="form-control" id="zipCode" placeholder="Enter Your Zip Code">
                                  </div>
                                  <div class="col-md-6">
                                    <label for="country">Country</label>
                                    <input type="text" name="country" class="form-control" id="country" placeholder="Enter Your Country">
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
                            <div class="exchange__widget__profile">
                                <form action="{{ route('updateSecurity') }}" method="POST">
                                @csrf
                                <div class="row">
                                  <div class="col-md-6">
                                    <label for="securityOne">Security questions #1</label>
                                    <select id="securityOne" name="securityOne" class="custom-select">
                                      <option selected="">Choose...</option>
                                      <option>What was the name of your first pet?</option>
                                      <option>What's your Mother's middle name?</option>
                                      <option>What was the name of your first school?</option>
                                      <option>Where did you travel for the first time?</option>
                                    </select>
                                  </div>
                                  <div class="col-md-6">
                                    <label for="securityAnsOne">Answer #1</label>
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
                                  </div>
                                  <div class="col-md-12">
                                    <label for="password">New Password</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter New Password">
                                  </div>
                                  <div class="col-md-12">
                                    <label for="confirmPassword">Confirm New Password</label>
                                    <input type="password" class="form-control" id="confirmPassword" name="confirmPassword"
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

@endsection
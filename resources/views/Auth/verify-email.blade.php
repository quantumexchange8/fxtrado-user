<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
  <title>FxTrado</title>
  <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">
  <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
</head>

<body class="version5">
  <main>
    <div class="col-md-12">
        <div class="exchange__widget_center">
            <div class="exchange__widget exchange-email-verify">
                <h4>Email Verification</h4>
                <span>
                    A verification email has been sent to your inbox. Please check your email and follow the instructions to verify your account.
                </span>
                <span>Already verified? <a href="{{ route('login')}}">Login</a></span>
            </div>          
        </div>
    </div>
  </main>
  
  {{-- <script src="assets/js/jquery-3.4.1.min.js"></script>
  <script src="assets/js/jquery-migrate-1.2.1.min.js"></script>
  <script src="assets/js/popper.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <script src="assets/js/svg-inject.min.js"></script>
  <script src="assets/js/tradingview-lightweight-min.js"></script>
  <script src="assets/js/perfect-scrollbar.min.js"></script>
  <script src="assets/js/slick.min.js"></script>
  <script src="assets/js/apexcharts.min.js"></script>
  <script src="assets/js/amcharts-core.min.js"></script>
  <script src="assets/js/amcharts.min.js"></script>
  <script src="assets/js/custom.js"></script> --}}
</body>

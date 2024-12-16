<!DOCTYPE html>
<html lang="{{ session('locale', 'en') }}">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FxTrado</title>
  <link rel="shortcut icon" href="assets/img/fx_logo_small.svg" type="image/x-icon">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  
  @vite('resources/css/app.css')
</head>


<body class="version5">
  <main class="exchange">

    @include('layouts.navbar')

    @yield('contents')

  </main>

  <script src="assets/js/jquery-3.4.1.min.js"></script>
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
  <script src="assets/js/animated-gradient.js"></script>
  <script src="assets/js/custom.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/js/all.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
  
  <script>
    function changeLanguage(event) {
      const selectedLang = event.target.value;

      // Redirect to the appropriate route to switch language
      window.location.href = `/switch-language/${selectedLang}`;
    }
  </script>

<script>
  function changeLanguage(event) {
      const selectedLang = event.target.value;
      // Redirect to the appropriate route to switch language
      window.location.href = `/switch-language/${selectedLang}`;
  }
</script>

</body>

</html>
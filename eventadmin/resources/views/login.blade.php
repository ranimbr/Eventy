<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Eventy</title>

  <!-- Remixicon & Custom Styles -->
  <link href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.css" rel="stylesheet">
  <link rel="stylesheet" href="styles2.css">

  <!-- Favicon -->
  <link rel="shortcut icon" href="{{ asset('assets3/images/favicon.ico') }}">

  <!-- Backend CSS -->
  <link rel="stylesheet" href="{{ asset('assets3/css/backend-plugin.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets3/css/backendf700.css?v=1.0.1') }}">
  <link rel="stylesheet" href="{{ asset('assets3/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets3/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets3/vendor/remixicon/fonts/remixicon.css') }}">

  <!-- Custom style to resize login card -->
  <style>
    .custom-login-card {
      max-width: 550px;
      padding: 2rem;
      border-radius: 1rem;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
      margin: auto;
    }

    @media (max-width: 576px) {
      .custom-login-card {
        padding: 1.5rem;
      }
    }
  </style>
</head>

<body>

  <!-- Loader -->
  

  <!-- Navigation -->
  <nav>
    <div class="nav__header">
      <div class="nav__logo">
        <a href="#">Eventy</a>
      </div>
      <div class="nav__menu__btn" id="menu-btn">
        <i class="ri-menu-line"></i>
      </div>
    </div>
    <ul class="nav__links" id="nav-links">
      <li><a href="/landingpage">Accueil</a></li>
      <li><a href="/login">Se connecter</a></li>
      <li><a href="/register">S'inscrire</a></li>
    </ul>
  </nav>

  <!-- Content Wrapper -->
  <div class="wrapper">
    <section class="login-content">
      <div class="container min-vh-100 d-flex">
        <div class="row justify-content-center align-items-center w-100">
          <div class="col-12 col-md-10 col-lg-8">
            <div class="custom-login-card">
              @yield('content')
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- Scripts -->
  <script src="https://unpkg.com/scrollreveal"></script>
  <script src="main.js"></script>
  <script src="{{ asset('assets3/js/backend-bundle.min.js') }}"></script>
  <script src="{{ asset('assets3/js/customizer.js') }}"></script>
  <script src="{{ asset('assets3/js/app.js') }}"></script>

</body>
</html>

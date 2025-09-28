<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ร้านอาหารแสนสุข</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" 
          rel="stylesheet" crossorigin="anonymous">

    <style>
      body {
        background-color: #fffdf8;
        font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
      }

      /* Navbar */
      .navbar {
        background: linear-gradient(90deg, #8b2e1a, #c94f35);
      }

      .navbar-brand {
        font-weight: bold;
        font-size: 1.4rem;
        color: #ffd700 !important;
      }

      .nav-link {
        color: #fff5e1 !important;
        transition: 0.3s;
        font-weight: 500;
      }

      .nav-link:hover {
        color: #ffdd99 !important;
      }

      /* Search bar */
      .form-control {
        border-radius: 30px;
        padding: 8px 15px;
      }

      .btn-success {
        border-radius: 30px;
        background: #ffb347;
        border: none;
        color: #3b1f1f;
        font-weight: bold;
        transition: 0.3s;
      }

      .btn-success:hover {
        background: #ff944d;
        color: #fff;
      }

      /* Alert menu title */
      .alert-primary {
        background: #fff3e6;
        color: #8b2e1a;
        border-left: 6px solid #c94f35;
        font-weight: bold;
      }

      /* Footer */
      footer {
        background: #fdf4ee;
        padding: 15px 0;
        border-top: 2px solid #c94f35;
      }

      footer p {
        margin: 0;
        color: #5c2a1d;
        font-size: 0.95rem;
      }
    </style>

    @yield('css_before')
  </head>
  <body>

    <!-- start navbar -->
    <nav class="navbar navbar-expand-lg shadow-sm">
      <div class="container">
        <a class="navbar-brand" href="/">ครัวแสนสุข</a>
        <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" 
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" 
                aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item"><a class="nav-link active" href="/">🏠 Home</a></li>
            <li class="nav-item"><a class="nav-link" href="/home/menu">🍜 Menu</a></li>
            <li class="nav-item"><a class="nav-link" href="https://devbanban.com/?p=4425">🔗 Link</a></li>
            <li class="nav-item"><a class="nav-link" href="/login">🔑 Login</a></li>
            <li class="nav-item"><a class="nav-link" href="/dashboard">📊 BackOffice</a></li>
          </ul>

          <form action="/search" method="get" class="d-flex" role="search">
            <input class="form-control me-2" type="text" name="keyword" 
                   placeholder="ค้นหาเมนูอาหาร..." required value="{{ $keyword ?? ''}}">
            <button class="btn btn-success" type="submit">ค้นหา</button>
          </form>
        </div>
      </div>
    </nav>
    <!-- end navbar -->

    <!-- Banner / Content -->
    <div class="container mt-3 mb-2">
      <div class="row">
        <div class="col-12">
          @yield('showBanner')
          <div class="alert alert-primary shadow-sm mt-3" role="alert">
            🍽️ :: เมนูอาหารแนะนำ ::
          </div>
        </div>
      </div>
    </div>
    @yield('navbar')

    <!-- Footer -->
    <footer class="mt-5">
      <p class="text-center">© 2025 by Chanidapha & Weerawat | ร้านอาหารแสนสุข</p>
    </footer>
    
    @yield('footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    @yield('js_before')
  </body>
</html>

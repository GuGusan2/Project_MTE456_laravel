<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ร้านอาหารแสนสุข</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous">

    <style>
        body {
            background-color: #fffdf8;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Navbar */
        .navbar {
            background: linear-gradient(90deg, #8b2e1a, #c94f35);
            height: 75px;
            font-size: 17px;
            position: relative;
            z-index: 10;
        }

        .nav-item {
            border-right: 1px solid #e9cfca;
            padding: 3px 0px;
            background: #9b3720;
        }

        .nav-link {
            color: #fff5e1 !important;
            transition: 0.3s;
            font-weight: 500;
            padding: 0 15px;
        }

        .nav-link:hover {
            color: #ffd280 !important;
            transform: translateY(-2px);
        }

        /* โลโก้ตรงกลาง */
        .navbar-brand {
            font-weight: bold;
            font-size: 1.4rem;
            color: #ffd700 !important;
        }

        .navbar-brand img {
            border: 4px solid #fff5e1;
            border-radius: 50%;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.25);
            position: relative;
            top: 18px;
            /* ให้ล้นออกมาด้านล่างเล็กน้อย */
            background: #fffdf8;
            padding: 3px;
        }

        /* Search bar */
        .form-control {
            border-radius: 30px;
            padding: 8px 15px;
            border: 1px solid #ffc48c;
        }

        .form-control:focus {
            border-color: #ff944d;
            box-shadow: 0 0 6px rgba(255, 148, 77, 0.5);
        }

        .btn-success {
            border-radius: 30px;
            background: #ffb347;
            border: none;
            color: #3b1f1f;
            font-weight: bold;
            transition: 0.3s;
            padding: 6px 18px;
        }

        .btn-success:hover {
            background: #ff944d;
            color: #fff;
            transform: scale(1.05);
        }

        /* Alert menu title */
        .alert-primary {
            background: #fff3e6;
            color: #8b2e1a;
            border-left: 6px solid #c94f35;
            font-weight: bold;
            border-radius: 8px;
        }

        .hold {
            box-shadow: 0px 10px 25px rgba(0, 0, 0, 0.15);
            font-weight: bold;
        }

        .holdlog:hover {
            box-shadow: 0px 10px 25px rgba(0, 0, 0, 0.15);
            background: #ee8a8a;
        }

        .holdlog:hover a {
            background: transparent;
        }

        .holdlog a {
            background: transparent;
        }

        .hold:hover {
            box-shadow: 0px 10px 25px rgba(0, 0, 0, 0.15);
            background: #9e351d;
            border: 2px double transparent;
        }

        /* Footer */
        footer {
            background: linear-gradient(90deg, #fdf4ee, #ffe9dc);
            padding: 18px 0;
            border-top: 3px solid #c94f35;
            box-shadow: inset 0 2px 6px rgba(0, 0, 0, 0.05);
        }

        footer p {
            margin: 0;
            color: #5c2a1d;
            font-size: 0.95rem;
            font-weight: 500;
            letter-spacing: 0.3px;
        }
    </style>

    @yield('css_before')
</head>

<body>

    <!-- start navbar -->
    <nav class="navbar navbar-expand-lg shadow-sm position-relative">
        <div class="container">
            <a class="navbar-brand position-absolute top-50 start-50 translate-middle" href="/">
                <img src="{{ asset('images/restaurant.png') }}" width="95" height="95" class="shadow">
            </a>

            <button class="navbar-toggler bg-light ms-auto" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item" style="background: #91321c;"><a class="nav-link active" href="/">🏠
                            Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="/home/menu">🍜 Menu</a></li>
                    <li class="nav-item"><a class="nav-link" href="https://devbanban.com/?p=4425">🔗 Link</a></li>
                    <li class="nav-item"><a class="nav-link" href="/login">🔑 Login</a></li>

                    @if (session('role') === 'admin')
                        <li class="nav-item"><a class="nav-link" href="/dashboard">📊 BackOffice</a></li>
                    @endif
                    @if (session('role') === 'staff')
                        <li class="nav-item"><a class="nav-link" href="/dashboard">📊 BackOffice</a></li>
                    @endif
                </ul>

                <form action="/search" method="get" class="d-flex" role="search">
                    <input class="form-control me-2" type="text" name="keyword" placeholder="ค้นหาเมนูอาหาร..."
                        required value="{{ $keyword ?? '' }}">
                    <button class="btn btn-success" type="submit">ค้นหา</button>
                </form>
                @if (session('role') === 'admin')
                    <div class="dropdown ms-3">
                        <a class="text-white hold d-flex align-items-center rounded px-3 py-2 shadow-sm text-decoration-none dropdown-toggle"
                            href="#" role="button" id="profileDropdown" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <img src="{{ asset('storage/' . session('emp_pic')) }}" alt="Profile"
                                class="rounded-circle me-2"
                                style="width:40px; height:40px; object-fit:cover; border: 3px solid #fdf4ee">
                            <span>{{ session('emp_name') }}</span>
                        </a>

                        <ul class="holdlog dropdown-menu dropdown-menu-start w-100" aria-labelledby="profileDropdown">
                            <li>
                                <a class="dropdown-item" href="#"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Hidden Logout Form -->
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                        @csrf
                    </form>
                @endif
                @if (session('role') === 'staff')
                    <div class="dropdown ms-3">
                        <a class="text-white hold d-flex align-items-center rounded px-3 py-2 shadow-sm text-decoration-none dropdown-toggle"
                            href="#" role="button" id="profileDropdown" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <img src="{{ asset('storage/' . session('emp_pic')) }}" alt="Profile"
                                class="rounded-circle me-2"
                                style="width:40px; height:40px; object-fit:cover; border: 3px solid #fdf4ee">
                            <span>{{ session('emp_name') }}</span>
                        </a>

                        <ul class="holdlog dropdown-menu dropdown-menu-start w-100" aria-labelledby="profileDropdown">
                            <li>
                                <a class="dropdown-item" href="#"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Hidden Logout Form -->
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                        @csrf
                    </form>
                @endif
            </div>
        </div>
    </nav>
    @yield('navbar')
    <!-- end navbar -->

    <!-- Banner / Content -->
    <div class="container mt-5 mb-2">
        <div class="row">
            <div class="col-12">
                @yield('showBanner')
                <div class="alert alert-primary shadow-sm mt-3" role="alert">
                    🍽️ :: เมนูอาหารแนะนำ ::
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="mt-5">
        <p class="text-center">© 2025 by Chanidapha & Weerawat | ร้านอาหารแสนสุข</p>
    </footer>

    @yield('footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    @yield('js_before')
</body>

</html>

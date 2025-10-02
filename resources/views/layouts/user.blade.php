<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ร้านอาหารแสนสุข</title>

    {{-- Font Awesome  --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">


    <!-- โหลดฟอนต์จาก Google Fonts -->

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">


    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #fffaf5;
            color: #333;
            line-height: 1.6;
        }

        /* ทำให้หัวข้อดูเด่น */
        h1,
        h2,
        h3,
        h4,
        h5,
        .navbar-brand {
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
        }

        /* Navbar */
        .navbar {
            background: linear-gradient(90deg, #8b2e1a, #c94f35);
        }

        .navbar-brand {
            font-weight: 700;
            /* Bold */
            font-size: 1.4rem;
            color: #ffd700 !important;
            font-family: "Poppins", sans-serif;
        }

        .navbar {
            font-size: 17px;
        }

        .nav-item {
            margin-inline-start: 10px;
        }

        /* ปุ่ม login */
        .btn-dark {
            background: #ffb347;
            border: none;
            color: #3b1f1f;
            font-weight: 600;
            /* Semi-bold */
            border-radius: 20px;
            transition: 0.3s;
            font-family: "Poppins", sans-serif;
        }

        .btn-dark:hover {
            background: #ff944d;
            color: #fff;
        }

        /* Footer */
        footer {
            background: #fdf4ee;
            padding: 15px 0;
            color: #e7dad6;
            font-size: 0.95rem;
            border-top: 2px solid #c94f35;
        }

        footer p {
            margin: 0;
            font-size: 0.95rem;
            font-weight: 400;
            font-family: "Poppins", sans-serif;
        }

       

        /* การ์ดโปรโมชั่น */
        .promotion-card {
            flex: 1 1 300px;
            /* ขยายการ์ดขั้นต่ำ 300px */
            max-width: 400px;
            /* ไม่ให้เกิน 400px */
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-radius: 20px;
            overflow: hidden;
            height: auto;
        }

        .promotion-card:hover {
            transform: translateY(-8px) scale(1.05);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        /* รูปในโปรโมชัน */
        .promo-img {
            width: 100%;
            height: 480px;
            object-fit: cover;
            /* ครอบรูปสวย ไม่บิดเบี้ยว */
            border-radius: 20px;
        }


        .dropdown-menu {
            background: #fffaf5;
            border-radius: 12px;
            padding: 10px;
        }

        .dropdown-item {
            transition: all 0.2s ease;
            font-weight: 500;
        }

        .dropdown-item:hover {
            background: #ffe0e0;
            border-radius: 8px;
            transform: translateX(4px);
        }

        /* พื้นฐานของ nav */
        .nav-link {
            font-weight: 600;
            color: #fff !important;
            /* สีขาวบนพื้นแดง */
            transition: all 0.3s ease-in-out;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        /* ไอคอนเริ่มต้น */
        .icon-nav {
            font-size: 1.2rem;
            transition: transform 0.3s ease, color 0.3s ease;
        }

        /* hover effect */
        .nav-link:hover {
            color: #ffd54f !important;
            /* ข้อความเป็นสีทอง */
        }

        .nav-link:hover .icon-nav {
            transform: translateY(-3px) scale(1.2);
            /* เด้งขึ้น + ขยายเบาๆ */
            color: #fff176;
            /* เหลืองสด */
        }

        /* active state */
        .nav-link.active,
        .nav-link.active .icon-nav {
            color: #ffeb3b !important;
            /* เหลืองทอง เวลา active */
        }
    </style>

    {{-- CSS เพิ่มเติมของ User --}}
    <link href="{{ asset('css/user.css') }}" rel="stylesheet">
    <link href="{{ asset('css/member-login.css') }}" rel="stylesheet">
    <link href="{{ asset('css/member-register.css') }}" rel="stylesheet">
</head>

<body>

    {{-- 🔹 Navbar --}}
    <nav class="navbar navbar-expand-lg shadow-sm sticky-top">
        <div class="container">
            {{-- 🔸 Logo --}}
            <a class="navbar-brand fw-bold" href="{{ route('user.home') }}">
                <img src="{{ asset('images/logo.png') }}" alt="logo" height="40" class="me-2">
                ร้านอาหารแสนสุข
            </a>

            {{-- Hamburger --}}
            <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            {{-- Menu --}}
            <div class="collapse navbar-collapse" id="navbarNav">

                {{-- 🟢 เมนูฝั่งซ้าย --}}
                <ul class="navbar-nav me-auto">

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('user.home') ? 'active' : '' }}"
                            href="{{ route('user.home') }}">
                            <i class="fa-solid fa-house icon-nav"></i> หน้าแรก
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/#recommended') }}">
                            <i class="fa-solid fa-utensils icon-nav"></i> เมนู
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/#contact') }}">
                            <i class="fa-solid fa-phone icon-nav"></i> ติดต่อ
                        </a>
                    </li>


                    {{-- 🆕 BackOffice --}}
                    @if (session('role') === 'admin' || session('role') === 'staff')
                        <li class="nav-item">
                            <a class="nav-link" href="/dashboard"><i class="icon-nav fa-solid fas fa-tv"></i> BackOffice</a>
                        </li>
                    @endif
                </ul>

                {{-- 🟣 โปรไฟล์ / Login --}}
                <ul class="navbar-nav">
                    @if (session('role') === 'admin')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#"
                                id="profileDropdown" role="button" data-bs-toggle="dropdown">
                                <img src="{{ asset('storage/' . session('emp_pic')) }}" class="rounded-circle"
                                    style="width:35px; height:35px; object-fit:cover;" width="40" height="40">
                                <span class="ms-2">{{ session('emp_name') }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <form action="/logout" method="POST">@csrf
                                        <button type="submit" class="dropdown-item text-danger">🚪
                                            ออกจากระบบ</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif

                    @if (session('role') === 'staff')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#"
                                id="profileDropdown" role="button" data-bs-toggle="dropdown">
                                <img src="{{ asset('storage/' . session('emp_pic')) }}" class="rounded-circle"
                                    width="40" height="40">
                                <span class="ms-2">{{ session('emp_name') }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">@csrf
                                        <button type="submit" class="dropdown-item text-danger">🚪
                                            ออกจากระบบ</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif

                    @if (session('role') === 'member')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#"
                                id="profileDropdown" role="button" data-bs-toggle="dropdown">
                                <img src="{{ asset('storage/' . session('mem_pic')) }}" class="rounded-circle"
                                    width="40" height="40">
                                <span class="ms-2">{{ session('mem_name') }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('member.memberinfo') }}">👤
                                        ข้อมูลพื้นฐาน</a></li>
                                <li><a class="dropdown-item" href="{{ route('member.password') }}">🔑
                                        เปลี่ยนรหัสผ่าน</a></li>
                                <li><a class="dropdown-item" href="{{ route('member.favorites') }}">⭐ เมนูโปรด</a>
                                </li>
                                <li><a class="dropdown-item" href="{{ route('member.profile') }}">🖼
                                        จัดการโปรไฟล์</a>
                                </li>
                                <li>
                                    <form action="/logout" method="POST">@csrf
                                        <button type="submit" class="dropdown-item text-danger">🚪
                                            ออกจากระบบ</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif

                    @if (session('role') === null)
                        <li class="nav-item ms-2">
                            <a class="btn btn-dark" href="{{ route('login') }}">เข้าสู่ระบบ</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>


    {{-- Main Content --}}
    <main class="py-4">
        @yield('content')
    </main>

    @include('sweetalert::alert')
    {{-- Footer --}}
    <footer class="fixed-bottom mt-5">
        <p class="text-center">© 2025 by Chanidapha & Weerawat | ร้านอาหารแสนสุข</p>
    </footer>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>

    {{-- ✅ SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'สำเร็จ!',
                text: "{{ session('success') }}",
                confirmButtonColor: '#ff6a95'
            });
        </script>
    @endif

    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'เกิดข้อผิดพลาด',
                html: `{!! implode('<br>', $errors->all()) !!}`,
                confirmButtonColor: '#ff6a95'
            });
        </script>
    @endif
</body>

</html>

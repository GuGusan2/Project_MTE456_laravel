<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ร้านอาหารแสนสุข</title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- CSS หลัก --}}
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

        .nav-link:hover,
        .nav-link.active {
            color: #ffdd99 !important;
        }

        /* ปุ่ม login */
        .btn-dark {
            background: #ffb347;
            border: none;
            color: #3b1f1f;
            font-weight: bold;
            border-radius: 20px;
            transition: 0.3s;
        }

        .btn-dark:hover {
            background: #ff944d;
            color: #fff;
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
                            href="{{ route('user.home') }}">🏠 หน้าแรก</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/#recommended') }}">🍽 เมนู</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/#contact') }}">📞 ติดต่อ</a>
                    </li>

                    {{-- 🆕 BackOffice --}}
                    @if (session('role') === 'admin' || session('role') === 'staff')
                        <li class="nav-item">
                            <a class="nav-link" href="/dashboard">💻 BackOffice</a>
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
                                    width="40" height="40">
                                <span class="ms-2">{{ session('emp_name') }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <form action="/logout" method="POST">@csrf
                                        <button type="submit" class="dropdown-item text-danger">🚪 ออกจากระบบ</button>
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
                                        <button type="submit" class="dropdown-item text-danger">🚪 ออกจากระบบ</button>
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
                                <li><a class="dropdown-item" href="{{ route('member.favorites') }}">⭐ เมนูโปรด</a></li>
                                <li><a class="dropdown-item" href="{{ route('member.profile') }}">🖼 จัดการโปรไฟล์</a>
                                </li>
                                <li>
                                    <form action="/logout" method="POST">@csrf
                                        <button type="submit" class="dropdown-item text-danger">🚪 ออกจากระบบ</button>
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

    {{-- Footer --}}
    <footer class="mt-5">
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

<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สมาชิก | ร้านอาหารแสนสุข</title>

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

        .navbar{
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
            color: #5c2a1d;
            font-size: 0.95rem;
            border-top: 2px solid #c94f35;
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
            {{-- Logo --}}
            <a class="navbar-brand fw-bold" href="{{ route('member.home') }}">
                <img src="{{ asset('images/logo.png') }}" alt="logo" height="40" class="me-2">
                ร้านอาหารแสนสุข
            </a>

            {{-- Hamburger --}}
            <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            {{-- Menu --}}
            <div class="collapse navbar-collapse" id="navbarNav">
                {{-- เมนูฝั่งซ้าย --}}
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('member.home') ? 'active' : '' }}"
                           href="{{ route('member.home') }}"> หน้าแรก</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/member/home#recommended') }}"> เมนู</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/member/home#promotion') }}"> โปรโมชั่น</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/member/home#contact') }}"> ติดต่อ</a></li>
                </ul>

                {{-- โปรไฟล์ / Logout --}}
                <ul class="navbar-nav">
                    @if (session('role') === 'member')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="profileDropdown"
                               role="button" data-bs-toggle="dropdown">
                                <img src="{{ asset('storage/' . session('mem_pic')) }}" class="rounded-circle"
                                    style="width:35px; height:35px; object-fit:cover;" width="40" height="40">
                                <span class="ms-2">{{ session('mem_name') }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('member.memberinfo') }}">👤 ข้อมูลพื้นฐาน</a></li>
                                <li><a class="dropdown-item" href="{{ route('member.password') }}">🔑 เปลี่ยนรหัสผ่าน</a></li>
                                <li><a class="dropdown-item" href="{{ route('member.favorites') }}">⭐ เมนูโปรด</a></li>
                                <li><a class="dropdown-item" href="{{ route('member.profile') }}">🖼 จัดการโปรไฟล์</a></li>
                                <li>
                                    <form action="/logout" method="POST">@csrf
                                        <button type="submit" class="dropdown-item text-danger">🚪 ออกจากระบบ</button>
                                    </form>
                                </li>
                                <li>
                                    <form id="deleteAccountForm" action="{{ route('member.account.delete') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">❌ ลบบัญชี</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    {{-- Main Content --}}
    <main class="py-4">@yield('content')</main>
    @include('sweetalert::alert')

    {{-- Footer --}}
    <footer class="mt-5">
        <p class="text-center">© 2025 ร้านอาหารแสนสุข | Member Zone</p>
    </footer>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>

    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('account_deleted'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'ลบบัญชีสำเร็จ!',
                text: "{{ session('account_deleted') }}",
                confirmButtonColor: '#d33'
            });
        </script>
    @endif

    <script>
        // ยืนยันลบบัญชี
        document.getElementById('deleteAccountForm')?.addEventListener('submit', function(e) {
            e.preventDefault();
            Swal.fire({
                title: '⚠️ แน่ใจหรือไม่?',
                text: "คุณกำลังจะลบบัญชีถาวร!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#aaa',
                confirmButtonText: 'ใช่, ลบเลย',
                cancelButtonText: 'ยกเลิก'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                }
            });
        });
    </script>
</body>
</html>

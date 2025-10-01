<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สมาชิก | ร้านอาหารแสนสุข</title>

    {{-- Font Awesome  --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">


    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">


    <!-- โหลดฟอนต์จาก Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <style>
        /* ใช้ Poppins เป็นฟอนต์หลัก */
        body {
            background-color: #fffdf8;
            font-family: "Poppins", sans-serif;
            font-weight: 400;
            color: #3b1f1f;
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

        .nav-link {
            color: #fff5e1 !important;
            transition: 0.3s;
            font-weight: 500;
            font-family: "Poppins", sans-serif;
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
            color: #5c2a1d;
            font-size: 0.95rem;
            border-top: 2px solid #c94f35;
        }

<<<<<<< HEAD
        footer p {
            margin: 0;
            color: #5c2a1d;
            font-size: 0.95rem;
            font-weight: 400;
            font-family: "Poppins", sans-serif;
        }

        /* เพิ่มเติม: Heading */
        h1,
        h2,
        h3 {
            font-family: "Poppins", sans-serif;
            font-weight: 700;
            color: #3b1f1f;
        }

        p {
            font-family: "Poppins", sans-serif;
            font-weight: 400;
        }

        /* การ์ดโปรโมชั่น */
        .promotion-card {
            overflow: hidden;
            border-radius: 12px;
            transition: transform 0.3s, box-shadow 0.3s;
            width: 100%;
            /* ✅ ให้เต็มคอลัมน์ */
            max-width: 400px;
            /* ✅ เพิ่มขนาดสูงสุดเป็น 400px */
        }


        .promotion-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.25);
        }

        .promo-img {
            width: 100%;
            height: auto;
            /* ✅ ใช้ขนาดจริง */
            object-fit: contain;
            /* แสดงเต็มรูป ไม่ครอบ */
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
            color: #ffd54f;
            /* ทอง */
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
=======
>>>>>>> 2e8b8e7860d6bcd5656cb9e86ff6738f0682f736
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
            <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            {{-- Menu --}}
            <div class="collapse navbar-collapse" id="navbarNav">
                {{-- เมนูฝั่งซ้าย --}}
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('member.home') ? 'active' : '' }}"
<<<<<<< HEAD
                            href="{{ route('member.home') }}">
                            <i class="fa-solid fa-house icon-nav"></i> หน้าแรก
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/member/home#recommended') }}">
                            <i class="fa-solid fa-utensils icon-nav"></i> เมนู
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/member/home#promotion') }}">
                            <i class="fa-solid fa-gift icon-nav"></i> โปรโมชั่น
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/member/home#contact') }}">
                            <i class="fa-solid fa-phone icon-nav"></i> ติดต่อ
                        </a>
                    </li>
=======
                           href="{{ route('member.home') }}"> หน้าแรก</a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/member/home#recommended') }}"> เมนู</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/member/home#promotion') }}"> โปรโมชั่น</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ url('/member/home#contact') }}"> ติดต่อ</a></li>
>>>>>>> 2e8b8e7860d6bcd5656cb9e86ff6738f0682f736
                </ul>


                {{-- โปรไฟล์ / Logout --}}
                <ul class="navbar-nav">
                    @if (session('role') === 'member')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#"
                                id="profileDropdown" role="button" data-bs-toggle="dropdown">
                                <img src="{{ asset('storage/' . session('mem_pic')) }}" class="rounded-circle"
<<<<<<< HEAD
                                    width="40" height="40">
=======
                                    style="width:35px; height:35px; object-fit:cover;" width="40" height="40">
>>>>>>> 2e8b8e7860d6bcd5656cb9e86ff6738f0682f736
                                <span class="ms-2">{{ session('mem_name') }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 rounded-3">
                                <li>
                                    <a class="dropdown-item d-flex align-items-center"
                                        href="{{ route('member.memberinfo') }}">
                                        <i class="fa-solid fa-id-card me-2 text-primary"></i> ข้อมูลพื้นฐาน
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item d-flex align-items-center"
                                        href="{{ route('member.password') }}">
                                        <i class="fa-solid fa-key me-2 text-warning"></i> เปลี่ยนรหัสผ่าน
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item d-flex align-items-center"
                                        href="{{ route('member.favorites') }}">
                                        <i class="fa-solid fa-heart me-2 text-danger"></i> เมนูโปรด
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item d-flex align-items-center"
                                        href="{{ route('member.profile') }}">
                                        <i class="fa-solid fa-user-gear me-2 text-success"></i> จัดการโปรไฟล์
                                    </a>
                                </li>
                                <li>
                                    <form action="/logout" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="dropdown-item d-flex align-items-center text-danger fw-bold">
                                            <i class="fa-solid fa-right-from-bracket me-2"></i> ออกจากระบบ
                                        </button>
                                    </form>
                                </li>
                                <li>
                                    <form id="deleteAccountForm" action="{{ route('member.account.delete') }}"
                                        method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="dropdown-item d-flex align-items-center text-danger fw-bold">
                                            <i class="fa-solid fa-user-slash me-2"></i> ลบบัญชี
                                        </button>
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

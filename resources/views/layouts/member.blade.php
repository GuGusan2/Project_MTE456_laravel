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

        /* ปุ่ม + เมนูให้หนานิดนึง */
        .btn,
        .nav-link {
            font-family: 'Poppins', sans-serif;
            font-weight: 500;
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

        /* Sticky Footer */
        html,
        body {
            height: 100%;
            /* ✅ ทำให้ body กินพื้นที่เต็มหน้าจอ */
            margin: 0;
            display: flex;
            flex-direction: column;
            /* ✅ ใช้ Flexbox */
        }

        main {
            flex: 1;
            /* ✅ ดัน content ให้เต็มก่อน แล้ว footer ไปล่างสุด */
        }

        footer {
            background: #fdf4ee;
            padding: 15px 0;
            color: #5c2a1d;
            font-size: 0.95rem;
            border-top: 2px solid #c94f35;
            text-align: center;
            width: 100%;
        }

        footer p {
            margin: 0;
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
            height: 280px;
            /* กำหนดความสูงให้เท่ากันทุกการ์ด */
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
                </ul>


                {{-- โปรไฟล์ / Logout --}}
                <ul class="navbar-nav">
                    @if (Auth::guard('member')->check())
                        {{-- ✅ ถ้า login เป็น member --}}
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#"
                                id="profileDropdown" role="button" data-bs-toggle="dropdown">
                                <img src="{{ Auth::guard('member')->user()->mem_pic &&
                                file_exists(storage_path('app/public/' . Auth::guard('member')->user()->mem_pic))
                                    ? asset('storage/' . Auth::guard('member')->user()->mem_pic)
                                    : asset('images/user.png') }}"
                                    class="rounded-circle shadow object-cover border-3 border-info" width="40"
                                    height="40" alt="avatar">


                                <span class="ms-2">{{ Auth::guard('member')->user()->mem_name }}</span>
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
                                    <form action="{{ route('logout') }}" method="POST">
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
                    @else
                        {{-- ❌ ถ้ายังไม่ได้ login --}}
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="btn btn-light fw-bold">
                                <i class="fa-solid fa-right-to-bracket me-1"></i> เข้าสู่ระบบ
                            </a>
                        </li>
                        <li class="nav-item ms-2">
                            <a href="{{ route('member.register') }}" class="btn btn-warning fw-bold">
                                <i class="fa-solid fa-user-plus me-1"></i> สมัครสมาชิก
                            </a>
                        </li>
                    @endif
                </ul>

            </div>
        </div>
    </nav>

    {{-- Main Content --}}
    <main class="py-4">@yield('content')</main>
    @include('sweetalert::alert')


    {{-- Footer Sticky --}}
    <footer>
        <p class="text-center">© 2025 by Chanidapha & Weerawat | ร้านอาหารแสนสุข</p>
    </footer>


    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"></script>

    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('login_success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'สำเร็จ',
                text: "{{ session('login_success') }}",
                confirmButtonColor: '#3085d6',
                timer: 2000,
                showConfirmButton: false
            });
        </script>
    @endif

    @if (session('register_success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'สำเร็จ',
                text: "{{ session('register_success') }}",
                confirmButtonColor: '#3085d6',
                timer: 2000,
                showConfirmButton: false
            });
        </script>
    @endif

    <script>
        document.getElementById('deleteAccountForm')?.addEventListener('submit', function(e) {
            e.preventDefault();
            Swal.fire({
                title: '⚠️ แน่ใจหรือไม่?',
                text: "คุณต้องกรอกรหัสผ่านเพื่อยืนยันการลบ!",
                input: 'password',
                inputPlaceholder: 'กรอกรหัสผ่าน...',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#aaa',
                confirmButtonText: 'ใช่, ลบเลย',
                cancelButtonText: 'ยกเลิก',
                preConfirm: (password) => {
                    if (!password) {
                        Swal.showValidationMessage('กรุณากรอกรหัสผ่านก่อน ❌');
                    }
                    return password;
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    let form = document.getElementById('deleteAccountForm');
                    let input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'password';
                    input.value = result.value;
                    form.appendChild(input);
                    form.submit();
                }
            });
        });
    </script>

</body>

</html>

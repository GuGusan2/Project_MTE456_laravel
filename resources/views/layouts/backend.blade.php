<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Back Office ครัวแสนสุข</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        * {
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        }

        .btn-cancle:hover {
            background: rgb(209, 41, 41);
            border-color: transparent;
        }

        body {
            background-color: #e9e6de;
            margin: 0;
            overflow-x: hidden;
            display: flex;
            flex-direction: column;
            height: 100%;
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


        /* ===== Sidebar ===== */
        .sidebar {
            width: 240px;
            background: linear-gradient(180deg, #6b2d1a, #a9442e);
            color: white;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            overflow: hidden;
            z-index: 999;
            transition: transform 0.4s ease, opacity 0.4s ease;
        }

        /* 🔸 เมื่อปิด Sidebar (ทั้ง Desktop และ Mobile) */
        .sidebar.closed {
            transform: translateX(-100%);
            opacity: 0;
        }

        .sidebar h4 {
            padding: 20px;
            margin: 0;
            text-align: center;
            font-weight: bold;
            background: #5a2413;
            border-bottom: 2px solid #a9442e;
        }

        .sidebar .list-group-item {
            background: transparent;
            color: #fff3e6;
            border: none;
            padding: 12px 20px;
            transition: 0.3s;
            font-size: 15px;
            white-space: nowrap;
        }

        .sidebar .list-group-item i {
            min-width: 25px;
            text-align: center;
        }

        .sidebar .list-group-item:hover {
            background: rgba(255, 255, 255, 0.15);
            border-radius: 10px;
        }

        .sidebar .active-link {
            background: #ffb347 !important;
            color: #3b1f1f !important;
            font-weight: bold;
            border-radius: 10px;
        }

        /* ===== Content ===== */
        .content {
            margin-left: 240px;
            padding: 20px;
            transition: margin-left 0.4s ease;
            flex: 1;
        }

        /* ปิด sidebar แล้ว content ชิดซ้าย */
        .content.full {
            margin-left: 0 !important;
        }

        /* ===== Footer ===== */
        footer {
            margin-left: 240px;
            background: #f5f0eb;
            color: #3b1f1f;
            padding: 10px;
            text-align: center;
            transition: margin-left 0.4s ease;
        }

        footer.full {
            margin-left: 0 !important;
        }

        /* ===== Overlay (Mobile) ===== */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            z-index: 998;
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        .overlay.show {
            display: block;
            opacity: 1;
        }

        /* ===== Hamburger ===== */
        .menu-toggle {
            position: fixed;
            z-index: 1000;
            cursor: pointer;
            color: #6b2d1a;
            background: #fff;
            padding: 8px 12px;
            border-radius: 5px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            transition: background 0.3s;
        }

        .menu-toggle:hover {
            background: #f0f0f0;
        }

        /* Sticky Footer */
        html,
        body {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
        }

        main {
            flex: 1;
        }

        /* ===== Responsive (Mobile) ===== */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                opacity: 0;
            }

            .sidebar.open {
                transform: translateX(0);
                opacity: 1;
            }

            .content,
            footer {
                margin-left: 0 !important;
            }
        }
    </style>

    @yield('css_before')
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar shadow-sm" id="sidebar">
        <div class="list-group list-group-flush">
            <div class="logo list-group-item"
                style="background: #a1472b; box-shadow: 1px 2px 20px #5a2413; margin-bottom: 20px; padding-top: 55px;">
                <img src="/images/logo.png" alt="logo" width="180" height="200">
            </div>
            <a href="/" class="list-group-item"><i class="fa-solid fa-house me-2"></i> <span>HOME</span></a>
            <a href="/dashboard" class="list-group-item"><i class="fa-solid fa-chart-line me-2"></i>
                <span>Dashboard</span></a>
            @if (session('role') === 'admin')
                <a href="/employee" class="list-group-item"><i class="fa-solid fa-user-tie me-2"></i>
                    <span>Employee</span></a>
            @endif
            <a href="/member" class="list-group-item"><i class="fa-solid fa-users me-2"></i> <span>Member</span></a>
            <a href="/menu" class="list-group-item"><i class="fa-solid fa-utensils me-2"></i> <span>Menu</span></a>
            <a href="/promotion" class="list-group-item"><i class="fa-solid fa-tags me-2"></i>
                <span>Promotion</span></a>
        </div>
    </div>

    <!-- Overlay for Mobile -->
    <div class="overlay" id="overlay" onclick="toggleSidebar()"></div>

    <!-- Main Content -->
    <div class="content" id="content">
        <div class="d-flex row justify-content-end mb-3">
            <div class="col-auto row me-auto">
                <div class="col-auto">
                    <!-- Hamburger -->
                    <span class="menu-toggle" onclick="toggleSidebar()">
                        <i class="fa-solid fa-bars fa-lg"></i>
                    </span>
                </div>
                <div class="col-auto ms-4">
                    <h4 class="text-secondary mt-1">
                        Back Office
                    </h4>
                </div>
            </div>

            <!-- Profile Dropdown -->
            <div style="box-shadow: 1px 2px 5px #746565; background: #eeebeb;" class="col-auto dropdown">
                <a class="d-flex align-items-center rounded px-3 py-2 shadow-sm text-decoration-none dropdown-toggle"
                    href="#" role="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{ asset('storage/' . session('emp_pic')) }}" alt="Profile" class="rounded-circle me-2"
                        style="width:35px; height:35px; object-fit:cover;">
                    <span>{{ session('emp_name') }}</span>
                </a>

                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                    <li>
                        <a class="dropdown-item text-danger" href="#"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            🚪 ออกจากระบบ
                        </a>
                    </li>
                </ul>
            </div>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                @csrf
            </form>
        </div>

        <main class="py-4 container">
            @yield('content')
        </main>
    </div>

    <!-- Footer -->
    <footer id="footer" class="pt-3 pb-2 shadow-lg text-center">
        <p>© 2025 by Chanidapha & Weerawat</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>

    <!-- Sidebar Toggle -->
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById("sidebar");
            const overlay = document.getElementById("overlay");
            const content = document.getElementById("content");
            const footer = document.getElementById("footer");

            if (window.innerWidth <= 768) {
                // 📱 Mobile
                sidebar.classList.toggle("open");
                overlay.classList.toggle("show");
            } else {
                // 💻 Desktop
                sidebar.classList.toggle("closed");
                content.classList.toggle("full");
                footer.classList.toggle("full");
            }
        }

        // Highlight active link
        document.addEventListener("DOMContentLoaded", function() {
            let links = document.querySelectorAll(".list-group-item");
            links.forEach(link => {
                if (link.href === window.location.href) {
                    link.classList.add("active-link");
                }
            });
        });
    </script>

    @yield('footer')
    @yield('js_before')
    @include('sweetalert::alert')
</body>

</html>

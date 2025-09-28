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

        body {
            background-color: #e9e6de;
        }

        /* Sidebar */
        .sidebar {
            height: 100vh;
            background: linear-gradient(180deg, #6b2d1a, #a9442e);
            color: #fff;
            position: fixed;
            top: 0;
            left: 0;
            width: 240px;
            box-shadow: 5px 0 15px rgba(0, 0, 0, 0.2);
        }

        .sidebar h3 {
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

        /* Main Content */
        .content {
            margin-left: 240px;
            padding: 20px;
        }

        .hold {
            box-shadow: 0px 10px 25px rgba(0, 0, 0, 0.15);
            background: #faf8f4;
            font-weight: bold;
            border: 2px double rgb(157, 149, 149);
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
            background: #cecccc;
            border: 2px double transparent;
        }

        footer {
            margin-left: 240px;
            background: #f5f0eb;
            color: #3b1f1f;
        }
    </style>
    @yield('css_before')

</head>

<body>

    <!-- Sidebar -->
    <div class="sidebar">
        <h3>Back Office</h3>
        <div class="list-group list-group-flush">
            <a href="/" class="list-group-item"><i class="fa-solid fa-house me-2"></i> HOME</a>
            <a href="/dashboard" class="list-group-item"><i class="fa-solid fa-chart-line me-2"></i> Dashboard</a>
            @if (session('role') === 'admin')
                <a href="/employee" class="list-group-item">
                    <i class="fa-solid fa-user-tie me-2"></i> Employee
                </a>
            @endif
            <a href="/member" class="list-group-item"><i class="fa-solid fa-users me-2"></i> Member</a>
            <a href="/menu" class="list-group-item"><i class="fa-solid fa-utensils me-2"></i> Menu</a>
            <a href="/promotion" class="list-group-item"><i class="fa-solid fa-tags me-2"></i> Promotion</a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="content">
        <!-- Top-right User Dropdown -->
        <div class="d-flex justify-content-end mb-3">
            <div class="dropdown">
                <a class="hold d-flex align-items-center rounded px-3 py-2 shadow-sm text-decoration-none dropdown-toggle"
                    href="#" role="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{ asset('storage/' . session('emp_pic')) }}" alt="Profile" class="rounded-circle me-2"
                        style="width:35px; height:35px; object-fit:cover;">
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
        </div>


        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>


    <!-- Footer -->
    <footer class="pt-3 pb-2 shadow-lg text-center">
        <p>© 2025 by Chanidapha & Weerawat</p>
    </footer>
    @yield('footer')

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let links = document.querySelectorAll(".list-group-item");
            links.forEach(link => {
                if (link.href === window.location.href) {
                    link.classList.add("active-link");
                }
            });
        });
    </script>
    @yield('js_before')

    @include('sweetalert::alert')
</body>

</html>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Back Office ครัวแสนสุข</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    @yield('css_before')

    <style>
      * {
        font-family: Arial, Helvetica, sans-serif;
      }
      body {
        background-color: #f8f9fa;
      }
      .header-banner {
        height: auto;
          /* url("{{ asset('images/bg2.jpg') }}") center/cover no-repeat; */
        color: #fff;
        background: #484646;
      }
      .trans:hover{
        background: linear-gradient(#4d4c4b, #72716e);
      }
    </style>
  </head>
  <body>

    <!-- Header -->
    <div class="container-fluid p-0 mb-3">
      <div class="header-banner">
        <div class="d-flex justify-between">
          <h4 class="pt-2 ms-3 me-auto col-md-7 justify-content-center align-content-center">
              BackOffice
          </h4>
          <div class="trans pt-2 justify-between px-3">
            <span class="justify-items-center align-items-center">
              <i class="border rounded-5 me-1 p-2 mb-2 fa-solid fa-user"></i>  <!-- user -->
              ph.chanidapha_st@tni.ac.th
            </span>  
          </div>
        </div>
        
      </div>
    </div>

    @yield('header')

    <!-- Layout -->
    <div class="mx-4">
      <div class="row">
        
        <!-- Sidebar -->
        <div class="col-md-3 mb-4">
          <div class="card shadow-sm rounded">
            <div class="list-group list-group-flush">
              <a href="/" class="fw-bold list-group-item list-group-item-action active" aria-current="true">
                 HOME
              </a>
              <a href="/dashboard" class="list-group-item list-group-item-action">📊 Dashboard</a>
              <a href="/employee" class="list-group-item list-group-item-action">🕵️‍♂️ Employee</a>
              <a href="/member" class="list-group-item list-group-item-action">👨‍💻 Member</a>
              <a href="/menu" class="list-group-item list-group-item-action">🍽️ Menu</a>
              <a href="/promotion" class="list-group-item list-group-item-action">🏷️ Promotion</a>
            </div>
          </div>
          @yield('sidebarMenu')
        </div>

        <!-- Main Content -->
        <div class="col-md-9">
          <div class="card shadow-sm rounded p-3">
            @yield('content')
          </div>
        </div>
      </div>
    </div>

    <!-- Footer -->
    <footer class="mt-5 bg-light py-3 shadow-sm">
      <p class="text-center mb-0">© 2025 by Chanidapha & Weerawat</p>
    </footer>
    
    @yield('footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
    @yield('js_before')

    {{-- SweetAlert --}}
    @include('sweetalert::alert')

  </body>
</html>

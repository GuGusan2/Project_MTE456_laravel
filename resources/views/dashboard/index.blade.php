@extends('home')

@section('css_before')
<style>
    /* Card Style */
    .card-custom {
        border-radius: 18px;
        transition: all 0.3s ease;
        border: none;
    }

    .card-custom:hover {
        transform: translateY(-8px);
        box-shadow: 0px 10px 25px rgba(0, 0, 0, 0.15);
    }

    /* Icon Box */
    .icon-box {
        font-size: 2rem;
        padding: 18px;
        border-radius: 15px;
        display: flex;
        justify-content: center;
        align-items: center;
        color: #fff;
        width: 70px;
        height: 70px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    /* Gradient Backgrounds */
    .bg-primary {
        background: linear-gradient(135deg, #4facfe, #00f2fe) !important;
    }

    .bg-success {
        background: linear-gradient(135deg, #43e97b, #38f9d7) !important;
    }

    .bg-warning {
        background: linear-gradient(135deg, #f9d423, #ff4e50) !important;
    }

    .bg-danger {
        background: linear-gradient(135deg, #ff6a00, #ee0979) !important;
    }

    .bg-info {
        background: linear-gradient(135deg, #30cfd0, #330867) !important;
    }

    .bg-secondary {
        background: linear-gradient(135deg, #6a11cb, #2575fc) !important;
    }

    /* Dashboard Title */
    .dashboard-title {
        font-weight: 800;
        color: #333;
    }

    /* Chart Card */
    .chart-card {
        border-radius: 18px;
        border: none;
    }

    .chart-card .card-header {
        font-size: 1rem;
        font-weight: 700;
        background: #f8f9fa;
        border-bottom: 2px solid #eee;
    }
</style>
@endsection

@section('header')
@endsection

@section('sidebarMenu')
@endsection

@section('content')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="container-fluid mt-4">

    {{-- Dashboard Title --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="dashboard-title">
            <i class="fa-solid fa-chart-line me-2 text-primary"></i> Dashboard Overview
        </h3>
    </div>

    {{-- Summary Cards --}}
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card card-custom shadow-sm h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="icon-box bg-primary me-3">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1">Members</h6>
                        <h3 class="fw-bold mb-0">{{ $countMember }}</h3>
                    </div>
                </div>
                <a href="/member" class="stretched-link"></a>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card card-custom shadow-sm h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="icon-box bg-success me-3">
                        <i class="fa-solid fa-briefcase"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1">Employees</h6>
                        <h3 class="fw-bold mb-0">{{ $countEmployee }}</h3>
                    </div>
                </div>
                <a href="/employee" class="stretched-link"></a>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card card-custom shadow-sm h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="icon-box bg-warning me-3">
                        <i class="fa-solid fa-utensils"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1">Menu</h6>
                        <h3 class="fw-bold mb-0">{{ $countMenu }}</h3>
                    </div>
                </div>
                <a href="/menu" class="stretched-link"></a>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card card-custom shadow-sm h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="icon-box bg-danger me-3">
                        <i class="fa-solid fa-tags"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1">Promotions</h6>
                        <h3 class="fw-bold mb-0">{{ $countPromotion }}</h3>
                    </div>
                </div>
                <a href="/promotion" class="stretched-link"></a>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card card-custom shadow-sm h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="icon-box bg-info me-3">
                        <i class="fa-solid fa-archive"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1">Total Price</h6>
                        <h3 class="fw-bold mb-0">{{ $sumPrice }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card card-custom shadow-sm h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="icon-box bg-secondary me-3">
                        <i class="fa-solid fa-eye"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-1">View</h6>
                        <h3 class="fw-bold mb-0">{{ $countView }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Charts --}}
    <div class="row">
        <div class="col-md-6">
            <div class="card chart-card shadow-sm">
                <div class="card-header">
                    <i class="fa-solid fa-chart-column me-2 text-primary"></i> Website Visits ล่าสุด 7 วัน
                </div>
                <div class="card-body">
                    <canvas id="visitsChart" height="120"></canvas>
                    <script>
                        const ctx = document.getElementById('visitsChart').getContext('2d');
                        new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: {!! json_encode($label) !!},
                                datasets: [{
                                    label: 'จำนวนเข้าชมเว็บไซต์ล่าสุด 7 วัน',
                                    data: {!! json_encode($data) !!},
                                    backgroundColor: 'rgba(247, 156, 183, 0.9)',
                                    borderRadius: 10,
                                }]
                            },
                            options: {
                                responsive: true,
                                plugins: {
                                    legend: { display: false },
                                    tooltip: { mode: 'index', intersect: false }
                                },
                                scales: {
                                    y: { beginAtZero: true }
                                }
                            }
                        });
                    </script>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card chart-card shadow-sm">
                <div class="card-header">
                    <i class="fa-solid fa-chart-line me-2 text-success"></i> Website Visits ล่าสุด 7 วัน
                </div>
                <div class="card-body">
                    <canvas id="visitsChart2" height="120"></canvas>
                    <script>
                        const ctx2 = document.getElementById('visitsChart2').getContext('2d');
                        new Chart(ctx2, {
                            type: 'line',
                            data: {
                                labels: {!! json_encode($label) !!},
                                datasets: [{
                                    label: 'จำนวนเข้าชมเว็บไซต์ล่าสุด 7 วัน',
                                    data: {!! json_encode($data) !!},
                                    fill: true,
                                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                    borderColor: 'rgba(54, 162, 235, 1)',
                                    borderWidth: 2,
                                    tension: 0.4,
                                    pointBackgroundColor: '#fff',
                                    pointBorderColor: 'rgba(54, 162, 235, 1)',
                                    pointRadius: 5,
                                    pointHoverRadius: 7
                                }]
                            },
                            options: {
                                responsive: true,
                                plugins: {
                                    legend: { display: false },
                                    tooltip: { mode: 'index', intersect: false }
                                },
                                scales: {
                                    y: { beginAtZero: true },
                                    x: { ticks: { color: '#444' } }
                                }
                            }
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('footer')
@endsection

@section('js_before')
@endsection

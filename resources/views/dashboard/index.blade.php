@extends('home')

@section('css_before')
@endsection

@section('header')
@endsection

@section('sidebarMenu')
@endsection

@section('content')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <h2> 📊 Dashboard </h2>
        </div>
    </div>
</div>


<div class="container mt-4">
    <div class="row">

        <div class="col-md-3">
            <div class="alert alert-info" role="alert">
                <h5> Sales <br> {{ number_format($sumPrice,2) }} บาท </h5>
            </div>
        </div>

        <div class="col-md-3">
            <a href="/member" class="list-group-item">
                <div class="alert alert-primary" role="alert">
                    <h5> Menus <br> {{ $countMenu }} เมนู </h5>
                </div>
            </a>
            </div>
        <div class="col-md-3">
            <a href="/employee" class="list-group-item">
                <div class="alert alert-success" role="alert">
                    <h5> Employees <br> {{ $countEmployee }} คน </h5>
                </div>
            </a>
        </div>

        <div class="col-md-3">
            <a href="/member" class="list-group-item">
                <div class="alert alert-secondary" role="alert">
                    <h5> Members <br> {{ $countMember }} คน </h5>
                </div>
            </a>
        </div>

        <div class="col-md-3">
            <a href="/promotion" class="list-group-item">
                <div class="alert alert-danger" role="alert">
                    <h5> Promotions <br> {{ $countPromotion }} list </h5>
                </div>
            </a>
        </div>

        <div class="col-md-3">
            <div class="alert alert-warning" role="alert">
                <h5> Views <br> {{ $countView }} view </h5>
            </div>
        </div>

    </div>
</div>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <h4> จำนวนการเข้าชมเว็บไซต์แยกตามเดือน </h4>
            <!-- แสดงกราฟ  -->
<canvas id="visitsChart" width="600" height="300"></canvas>
    <script>
        const ctx = document.getElementById('visitsChart').getContext('2d');

        const visitsChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($label) !!}, // ['มกราคม-2025', 'กุมภาพันธ์-2025', ...]
                datasets: [{
                    label: 'จำนวนเข้าชมเว็บไซต์ล่าสุด 12 เดือน',
                    data: {!! json_encode($data) !!}, // [123, 456, ...]
                   // borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(247, 156, 183)',
                    tension: 0.3,
                    fill: true,
                    pointRadius: 5,
                    pointHoverRadius: 7
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>






        </div>
    </div>
</div>

{{-- devbanban.com --}}

@endsection

@section('footer')
@endsection

@section('js_before')
@endsection

@section('js_before')
@endsection                                                            
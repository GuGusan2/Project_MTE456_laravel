@extends('layouts.member')

@section('content')
    <div class="container">

        {{-- 🎉 Banner --}}
        <div id="bannerCarousel" class="carousel slide mb-5 shadow rounded" data-bs-ride="carousel" data-bs-interval="3000">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#bannerCarousel" data-bs-slide-to="2"></button>
            </div>
            <div class="carousel-inner rounded">
                <div class="carousel-item active">
                    <img src="{{ asset('images/banner1.png') }}" class="d-block w-100 rounded" alt="Banner 1">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('images/banner2.png') }}" class="d-block w-100 rounded" alt="Banner 2">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('images/banner3.png') }}" class="d-block w-100 rounded" alt="Banner 3">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon bg-dark rounded-circle p-2"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon bg-dark rounded-circle p-2"></span>
            </button>
        </div>

        {{-- 🍴 เมนูแนะนำ --}}
        <section id="recommended" class="mb-5">
            <h3 class="mb-4 text-center fw-bold text-danger">🍴 เมนูแนะนำ</h3>
            <div class="row g-4">
                @foreach ($menus as $menu)
                    <div class="col-md-4">
                        <div class="card h-100 shadow border-0 rounded-3 menu-card">
                            <img src="{{ asset('storage/' . $menu->menu_pic) }}" class="card-img-top menu-img rounded-top"
                                alt="{{ $menu->menu_name }}">
                            <div class="card-body text-center">
                                <h5 class="card-title fw-bold">{{ $menu->menu_name }}</h5>
                                <p class="fw-bold text-danger fs-5">{{ number_format($menu->price, 2) }} บาท</p>
                                <p class="text-muted small">{{ Str::limit($menu->menu_detail, 80) }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-center mt-4">
                <a href="{{ route('member.menu') }}" class="btn btn-warning px-4 py-2 rounded-pill shadow-sm fw-bold">
                    ดูเมนูทั้งหมด ➝
                </a>
            </div>
        </section>

        {{-- 🎁 โปรโมชั่น --}}
        <section id="promotion" class="mb-5">
            <h3 class="mb-4 text-center fw-bold text-success">🎁 โปรโมชั่น</h3>

            <div class="d-flex flex-wrap justify-content-center gap-4">
                @foreach ($promotions as $promo)
                    {{-- 🔹 การ์ดโปรโมชั่น --}}
                    <div class="card promotion-card shadow border-0 rounded-3 "
                        style="cursor:pointer; width:auto; height:auto; max-width:350px ;" data-bs-toggle="modal"
                        data-bs-target="#promoModal{{ $promo->pro_id }}">

                        @if ($promo->pro_pic)
                            <img src="{{ asset('storage/' . $promo->pro_pic) }}" class="card-img-top promo-img"
                                alt="promotion image">
                        @else
                            <img src="{{ asset('images/no-image.jpg') }}" class="card-img-top promo-img" alt="no image">
                        @endif
                    </div>

                    {{-- 🔹 Modal --}}
                    <div class="modal fade" id="promoModal{{ $promo->pro_id }}" tabindex="-1"
                        aria-labelledby="promoModalLabel{{ $promo->pro_id }}" aria-hidden="true">
                        <div class="modal-dialog modal-xl modal-dialog-centered">
                            <div class="modal-content shadow-lg border-0 rounded-4">
                                <div class="modal-header bg-danger text-white rounded-top">
                                    <h5 class="modal-title fw-bold" id="promoModalLabel{{ $promo->pro_id }}">
                                        🎉 โปรโมชั่น 
                                    </h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-center">
                                    {{-- ✅ รูปใหญ่เต็มกรอบ --}}
                                    @if ($promo->pro_pic)
                                        <img src="{{ asset('storage/' . $promo->pro_pic) }}"
                                            class="img-fluid rounded mb-3 shadow"
                                            style="width: 100%; max-height: 500px; object-fit: cover;"
                                            alt="promotion image">
                                    @endif

                                    <div class="text-start px-3 mt-3">
                                        <p><strong>📝 รายละเอียด:</strong> {{ $promo->detail }}</p>
                                        <p><strong>📌 เงื่อนไข:</strong> {{ $promo->conditions }}</p>
                                        <p class="text-muted"><strong>📅 ระยะเวลา:</strong> {{ $promo->start_date }} -
                                            {{ $promo->end_date }}</p>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger px-4" data-bs-dismiss="modal">ปิด</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>



        {{-- 📞 Contact --}}
        <section id="contact" class="p-5 rounded shadow bg-light">
            <h3 class="text-center mb-4 fw-bold text-primary">📞 ติดต่อเรา</h3>
            <div class="row text-center">
                <div class="col-md-4 mb-3">
                    <div class="card h-100 border-0 shadow-sm rounded-3">
                        <div class="card-body">
                            <i class="bi bi-telephone-fill fs-1 text-primary"></i>
                            <h5 class="mt-3 fw-bold">โทรศัพท์</h5>
                            <p class="mb-0">099-999-9999</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card h-100 border-0 shadow-sm rounded-3">
                        <div class="card-body">
                            <i class="bi bi-envelope-fill fs-1 text-danger"></i>
                            <h5 class="mt-3 fw-bold">อีเมล</h5>
                            <p class="mb-0">example@gmail.com</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card h-100 border-0 shadow-sm rounded-3">
                        <div class="card-body">
                            <i class="bi bi-geo-alt-fill fs-1 text-success"></i>
                            <h5 class="mt-3 fw-bold">ที่อยู่</h5>
                            <p class="mb-0">กรุงเทพฯ ประเทศไทย</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

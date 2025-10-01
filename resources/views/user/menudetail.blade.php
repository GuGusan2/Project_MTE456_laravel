@extends('layouts.user')

@section('content')
<div class="container py-5">
    {{-- ปุ่มกลับ --}}
    <div class="mb-4">
        <a href="{{ route('user.menu') }}" class="btn btn-outline-secondary">
            ⬅ กลับไปเมนูทั้งหมด
        </a>
    </div>

    {{-- รายละเอียดเมนู --}}
    <div class="row">
        <div class="col-md-6">
            <img src="{{ asset('storage/' . $menu->menu_pic) }}" 
                 class="img-fluid rounded shadow-sm" 
                 alt="{{ $menu->menu_name }}">
        </div>
        <div class="col-md-6">
            <h2 class="fw-bold">{{ $menu->menu_name }}</h2>
            <p class="text-danger fs-4 fw-bold">
                💰 {{ number_format($menu->price, 2) }} บาท
            </p>
            <p class="text-muted">
                ประเภท: <span class="badge bg-warning text-dark">{{ $menu->menu_type }}</span>
            </p>
            <hr>
            <h5>รายละเอียดเมนู</h5>
            <p>{{ $menu->menu_detail }}</p>
        </div>
    </div>
</div>
@endsection

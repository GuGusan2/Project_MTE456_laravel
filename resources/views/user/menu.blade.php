@extends('layouts.user')

@section('content')
    <div class="container">
        <h2 class="mb-4 text-center">🍜 เมนูทั้งหมด</h2>

        {{-- 🔍 ค้นหา + เลือกประเภท --}}
        <form method="GET" action="{{ route('user.menu') }}" class="row g-3 mb-4">
            <div class="col-md-4">
                <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                    placeholder="ค้นหาเมนู...">
            </div>
            <div class="col-md-3">
                <select name="menu_type" class="form-select">
                    <option value="">-- เลือกประเภท --</option>
                    <option value="food" {{ request('menu_type') == 'food' ? 'selected' : '' }}>อาหาร</option>
                    <option value="beverage" {{ request('menu_type') == 'beverage' ? 'selected' : '' }}>เครื่องดื่ม</option>
                    <option value="sweet" {{ request('menu_type') == 'sweet' ? 'selected' : '' }}>ของหวาน</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">ค้นหา</button>
            </div>
            <div class="col-md-2">
                <a href="{{ route('user.menu') }}" class="btn btn-secondary w-100">รีเซ็ต</a>
            </div>
        </form>

        {{-- 🍴 แสดงเมนู --}}
        <div class="row">
            @forelse($menus as $menu)
                <div class="col-md-3 mb-4">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ asset('storage/' . $menu->menu_pic) }}" class="card-img-top"
                            alt="{{ $menu->menu_name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $menu->menu_name }}</h5>
                            <p class="card-text text-danger fw-bold">{{ $menu->price }} บาท</p>
                            <a href="{{ route('user.menudetail', $menu->menu_id) }}" class="btn btn-outline-dark btn-sm">
                                ดูรายละเอียด
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center text-muted">❌ ไม่พบเมนู</p>
            @endforelse
        </div>

        {{-- 📌 Pagination --}}
        <div class="d-flex justify-content-center mt-4">
            {{ $menus->withQueryString()->links() }}
        </div>
    @endsection

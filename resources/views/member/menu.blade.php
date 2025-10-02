@extends('layouts.member')

@section('content')
    <div class="container py-4">
        <h2 class="mb-4 text-center">🍜 เมนูอาหารทั้งหมด</h2>

        {{-- 🔍 ค้นหา + เลือกประเภท --}}
        <form method="GET" action="{{ route('member.menu') }}" class="row g-3 mb-4">
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
                <a href="{{ route('member.menu') }}" class="btn btn-secondary w-100">รีเซ็ต</a>
            </div>
        </form>

        {{-- 🍴 แสดงเมนู --}}
        <div class="row g-4">
            @forelse($menus as $menu)
                <div class="col-xl-3 col-lg-4 col-md-6">
                    <div class="card menu-card shadow-sm h-100">
                        <img src="{{ asset('storage/' . $menu->menu_pic) }}" class="card-img-top"
                            alt="{{ $menu->menu_name }}">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $menu->menu_name }}</h5>
                            <p class="card-price">{{ number_format($menu->price, 2) }} บาท</p>


                            {{-- ✅ ปุ่มด้านล่าง --}}
                            <div class="mt-auto">
                                <a href="{{ route('member.menudetail', $menu->menu_id) }}"
                                    class="btn btn-warning w-100 mb-2">📖 รายละเอียด</a>
                                <form action="{{ route('member.addFavorite') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="menu_id" value="{{ $menu->menu_id }}">
                                    <button type="submit" class="btn btn-danger w-100">❤️ เมนูโปรด</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center text-muted">❌ ไม่พบเมนู</p>
            @endforelse
        </div>

        {{-- 📄 Pagination --}}
        <div class="d-flex justify-content-center mt-4">
            {{ $menus->withQueryString()->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection

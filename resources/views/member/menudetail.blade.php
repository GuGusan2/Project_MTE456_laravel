@extends('layouts.member')

@section('content')
<div class="container py-4">

    {{-- 🔙 ปุ่มกลับ --}}
    <a href="{{ route('member.menu') }}" class="btn btn-secondary mb-3">
    ⬅ ย้อนกลับ
</a>


    {{-- รายละเอียดเมนู --}}
    <div class="row mb-5">
        <div class="col-md-5">
            <img src="{{ asset('storage/' . $menu->menu_pic) }}" 
                 class="img-fluid rounded shadow-sm" 
                 alt="{{ $menu->menu_name }}">
        </div>
        <div class="col-md-7">
            <h2 class="fw-bold">{{ $menu->menu_name }}</h2>
            <p class="card-price fs-4">💰 {{ number_format($menu->price, 2) }} บาท</p>
            <p class="text-muted">{{ $menu->menu_detail }}</p>

            {{-- เมนูโปรด --}}
            <form action="{{ route('member.addFavorite') }}" method="POST" class="d-inline">
                @csrf
                <input type="hidden" name="menu_id" value="{{ $menu->menu_id }}">
                <button type="submit" class="btn btn-danger">❤️ เพิ่มเมนูโปรด</button>
            </form>
        </div>
    </div>

    <hr>

    {{-- 💬 รีวิว --}}
    <h3 class="mb-3">💬 รีวิวทั้งหมด ({{ $menu->reviews->count() }})</h3>
    @forelse($menu->reviews as $rev)
    <div class="card mb-3">
        <div class="card-body">
            <strong>{{ $rev->member->mem_name ?? 'ผู้ใช้' }}</strong>
            <span class="text-warning">⭐ {{ $rev->rating }}</span>
            <p class="mb-1">{{ $rev->comment }}</p>
            <small class="text-muted">{{ $rev->created_at->format('d/m/Y H:i') }}</small>
        </div>
    </div>
    @empty
    <p class="text-muted">❌ ยังไม่มีรีวิวสำหรับเมนูนี้</p>
    @endforelse

    <hr>

    {{-- ✍️ เขียนรีวิว --}}
    <h4 class="mb-3">✍️ เขียนรีวิว</h4>
    <form action="{{ route('member.review.store', $menu->menu_id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <textarea name="comment" rows="3" class="form-control" placeholder="พิมพ์รีวิวที่นี่..."></textarea>
        </div>
        <div class="mb-3">
            <select name="rating" class="form-select" required>
                <option value="">-- ให้คะแนน --</option>
                <option value="5">⭐⭐⭐⭐⭐ (5)</option>
                <option value="4">⭐⭐⭐⭐ (4)</option>
                <option value="3">⭐⭐⭐ (3)</option>
                <option value="2">⭐⭐ (2)</option>
                <option value="1">⭐ (1)</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">ส่งรีวิว</button>
    </form>
</div>
@endsection

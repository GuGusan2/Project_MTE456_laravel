@extends('layouts.member')

@section('content')
<div class="container">
    <h2>💬 รีวิวของเมนู: {{ $menu->menu_name }}</h2>

    {{-- 🔹 แสดงรีวิวทั้งหมด --}}
    @forelse ($reviews as $rev)
        <div class="card mb-3">
            <div class="card-body">
                <p><b>{{ $rev->member->mem_name ?? 'ผู้ใช้' }}</b></p>
                <p>⭐ {{ $rev->rating }}</p>
                <p>{{ $rev->comment }}</p>
            </div>
        </div>
    @empty
        <p class="text-muted">ยังไม่มีรีวิวสำหรับเมนูนี้ 😅</p>
    @endforelse

    <hr>

    {{-- 🔹 ฟอร์มเพิ่มรีวิว --}}
    <h3>เพิ่มรีวิว</h3>
    <form action="{{ route('member.review.store', $menu_id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>เขียนรีวิว</label>
            <textarea name="comment" class="form-control" placeholder="พิมพ์รีวิวที่นี่..." required></textarea>
        </div>
        <div class="mb-3">
            <label>ให้คะแนน (1-5)</label>
            <input type="number" name="rating" class="form-control" min="1" max="5" required>
        </div>
        <button type="submit" class="btn btn-primary">ส่งรีวิว</button>
    </form>
</div>
@endsection

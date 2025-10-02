@extends('layouts.member')

@section('content')
    <div class="container">

        {{-- 🍤 Header --}}
        <div class="text-center mb-4">
            <h3 class="fw-bold" style="color:#d32f2f;">
                🦀 ข้อมูลสมาชิก - Seafood Lover 🐟
            </h3>
            <p class="text-muted">ครอบครัวร้านอาหารซีฟู้ดแสนสุข 🍲</p>
        </div>

        {{-- 🐙 Member Card --}}
        <div class="card shadow-lg border-0"
            style="background: linear-gradient(135deg, #fff8e1, #ffe0b2); border-radius:20px;">
            <div class="card-body text-center p-4">

                {{-- Avatar --}}
                <div class="mb-3">
                    <img src="{{ $member->mem_pic && file_exists(storage_path('app/public/' . $member->mem_pic))
                        ? asset('storage/' . $member->mem_pic)
                        : asset('images/user.png') }}"
                        class="rounded-circle shadow object-cover border-3 border-info" width="160" height="120"
                        alt="avatar">
                </div>

                {{-- Name --}}
                <h4 class="fw-bold" style="color:#c62828;">{{ $member->mem_name }}</h4>
                <p class="text-muted fst-italic">🍤 ยินดีต้อนรับสู่ครอบครัวซีฟู้ด 🍤</p>

                {{-- Info --}}
                <div class="text-start mt-3 mx-auto" style="max-width: 350px;">
                    <p class="mb-2">👤 <strong>Username:</strong> {{ $member->mem_username }}</p>
                    <p class="mb-2">📧 <strong>Email:</strong> {{ $member->mem_email }}</p>
                    <p class="mb-2">📞 <strong>เบอร์โทร:</strong> {{ $member->mem_phone ?? '-' }}</p>
                    <p class="mb-0">🎂 <strong>วันเกิด:</strong> {{ $member->mem_dob ?? '-' }}</p>
                </div>
            </div>
        </div>

        {{-- 🍲 Button --}}
        <div class="mt-4 text-center">
            <a href="{{ route('member.profile') }}" class="btn btn-lg text-white shadow"
                style="background: linear-gradient(90deg,#f44336,#ff9800); border-radius: 50px;">
                ✏️ แก้ไขข้อมูลสมาชิก
            </a>
        </div>

        {{-- 🦐 Footer --}}
        <div class="text-center mt-4">
            <p class="text-muted small">
                🐟 ขอบคุณที่เป็นส่วนหนึ่งของครอบครัวร้านอาหารแสนสุข 🦀
            </p>
        </div>
    </div>
@endsection

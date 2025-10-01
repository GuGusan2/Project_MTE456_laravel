@extends('layouts.member')

@section('content')
<div class="container">
    <h3>ℹ️ ข้อมูลสมาชิก</h3>

    <div class="card shadow-sm">
        <div class="card-body text-center">
            <img src="{{ asset('storage/' . $member->mem_pic) }}" 
                 class="rounded-circle mb-3 object-cover" width="100" height="100" alt="avatar">
            <h5>{{ $member->mem_name }}</h5>
            <p class="text-muted">👤 Username: {{ $member->mem_username }}</p>
            <p>📧 Email: {{ $member->mem_email }}</p>
            <p>📞 เบอร์โทร: {{ $member->mem_phone ?? '-' }}</p>
            <p>🎂 วันเกิด: {{ $member->mem_dob ?? '-' }}</p>
        </div>
    </div>

    <div class="mt-3 text-center">
        <a href="{{ route('member.profile') }}" class="btn btn-primary">แก้ไขข้อมูล ✏️</a>
    </div>
</div>
@endsection

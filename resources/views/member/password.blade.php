@extends('layouts.member')

@section('content')
<div class="container">
    <h2 class="mb-4">🔑 เปลี่ยนรหัสผ่าน</h2>

    <form action="{{ route('member.password.update') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">รหัสผ่านปัจจุบัน</label>
            <input type="password" name="current_password" class="form-control" required>
            @error('current_password') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">รหัสผ่านใหม่</label>
            <input type="password" name="new_password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">ยืนยันรหัสผ่านใหม่</label>
            <input type="password" name="new_password_confirmation" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">บันทึก</button>
    </form>
</div>
@endsection

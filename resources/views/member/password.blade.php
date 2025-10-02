@extends('layouts.member')

@section('content')
    <div class="container">
        <h2 class="mb-4">🔑 เปลี่ยนรหัสผ่าน</h2>

        <form action="{{ route('member.password.update') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">รหัสผ่านปัจจุบัน</label>
                <input type="password" name="current_password" class="form-control" required>
                @error('current_password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">รหัสผ่านใหม่</label>
                <input type="password" name="new_password" class="form-control" required>
                @if (isset($errors) && $errors->has('new_password'))
                    <div class="text-danger small mt-1">{{ $errors->first('new_password') }}</div>
                @endif
            </div>

            <div class="mb-3">
                <label class="form-label">ยืนยันรหัสผ่านใหม่</label>
                <input type="password" name="new_password_confirmation" class="form-control" required>
                @if (isset($errors) && $errors->has('new_password_confirmation'))
                    <div class="text-danger small mt-1">{{ $errors->first('new_password_confirmation') }}</div>
                @endif
            </div>

            <button type="submit" class="btn btn-success">บันทึก</button>
        </form>
    </div>
@endsection

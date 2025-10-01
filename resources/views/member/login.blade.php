@extends('layouts.user')

@section('content')
    <div class="login-container d-flex justify-content-center align-items-center">
        <div class="login-card shadow">
            <h3 class="text-center mb-4">🔑 เข้าสู่ระบบ</h3>

            {{-- ✅ ฟอร์ม login --}}
            <form action="{{ route('login.submit') }}" method="POST" class="login-form">
                @csrf
                <div class="mb-3">
                    <label for="login">Username or Email</label>
                    <input type="text" id="login" name="login" class="form-control" required autocomplete="off">
                </div>

                <div class="mb-3">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control" required autocomplete="off">
                </div>

                <button type="submit" class="btn btn-primary w-100">เข้าสู่ระบบ</button>
            </form>


            <div class="text-center mt-3">
                <p>ยังไม่มีบัญชี?
                    <a href="{{ route('member.register') }}">สมัครสมาชิก</a>
                </p>
            </div>
        </div>
    </div>
@endsection

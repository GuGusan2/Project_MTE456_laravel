@extends('layouts.user')

@section('content')
<div class="register-container">
    <div class="register-card">
        <h3 class="text-center">📝 สมัครสมาชิก</h3>

        {{-- ✅ แสดง Error รวม --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('member.register.submit') }}" method="POST" 
              class="register-form" enctype="multipart/form-data">
            @csrf

            {{-- ชื่อ-นามสกุล --}}
            <div class="mb-3">
                <label for="mem_name">ชื่อ-นามสกุล</label>
                <input type="text" id="mem_name" name="mem_name" 
                       class="form-control @error('mem_name') is-invalid @enderror" 
                       value="{{ old('mem_name') }}" required>
                @error('mem_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Username --}}
            <div class="mb-3">
                <label for="mem_username">Username</label>
                <input type="text" id="mem_username" name="mem_username" 
                       class="form-control @error('mem_username') is-invalid @enderror" 
                       value="{{ old('mem_username') }}" required>
                @error('mem_username')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Email --}}
            <div class="mb-3">
                <label for="mem_email">อีเมล</label>
                <input type="email" id="mem_email" name="mem_email" 
                       class="form-control @error('mem_email') is-invalid @enderror" 
                       value="{{ old('mem_email') }}" required>
                @error('mem_email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Phone --}}
            <div class="mb-3">
                <label for="mem_phone">เบอร์โทรศัพท์</label>
                <input type="tel" id="mem_phone" name="mem_phone" 
                       class="form-control @error('mem_phone') is-invalid @enderror" 
                       value="{{ old('mem_phone') }}"  maxlength="10" placeholder="เบอร์โทรศัพท์ 10 หลัก" required>
                @error('mem_phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Gender --}}
            <div class="mb-3">
                <label for="mem_gender">เพศ</label>
                <select required id="mem_gender" name="mem_gender" 
                        class="form-control @error('mem_gender') is-invalid @enderror">
                    <option value="">-- เลือกเพศ --</option>
                    <option value="male" {{ old('mem_gender') == 'male' ? 'selected' : '' }}>ชาย</option>
                    <option value="female" {{ old('mem_gender') == 'female' ? 'selected' : '' }}>หญิง</option>
                    <option value="other" {{ old('mem_gender') == 'other' ? 'selected' : '' }}>อื่น ๆ</option>
                </select>
                @error('mem_gender')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Date of Birth --}}
            <div class="mb-3">
                <label for="mem_dob">วันเกิด</label>
                <input type="date" required id="mem_dob" name="mem_dob" 
                       class="form-control @error('mem_dob') is-invalid @enderror"
                       value="{{ old('mem_dob') }}">
                @error('mem_dob')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Password --}}
            <div class="mb-3">
                <label for="mem_password">รหัสผ่าน</label>
                <input type="password" id="mem_password" name="mem_password" 
                       class="form-control @error('mem_password') is-invalid @enderror" required>
                @error('mem_password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Confirm Password --}}
            <div class="mb-3">
                <label for="mem_password_confirmation">ยืนยันรหัสผ่าน</label>
                <input type="password" id="mem_password_confirmation" 
                       name="mem_password_confirmation" 
                       class="form-control" required>
            </div>

            {{-- Profile Picture --}}
            <div class="mb-3">
                <label for="mem_pic">รูปโปรไฟล์</label>
                <input required type="file" id="mem_pic" name="mem_pic" class="form-control">
                <small class="text-muted">ถ้าไม่เลือก จะใช้ default.png</small>
            </div>

            <button type="submit" class="btn btn-primary w-100">สมัครสมาชิก</button>
        </form>

        <div class="text-center mt-3">
            <p>มีบัญชีแล้ว? <a href="{{ route('login') }}">เข้าสู่ระบบ</a></p>
        </div>
    </div>
</div>
@endsection

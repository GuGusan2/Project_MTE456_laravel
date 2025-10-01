@extends('layouts.member')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">

            {{-- ✅ Alert ข้อความสำเร็จ / Error --}}
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card shadow-sm">
                <div class="card-header bg-danger text-white fw-bold">
                    👤 แก้ไขข้อมูลโปรไฟล์
                </div>
                <div class="card-body">

                    {{-- 📌 ฟอร์มแก้ไขข้อมูลโปรไฟล์ --}}
                    <form action="{{ route('member.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        {{-- รูปโปรไฟล์ --}}
                        <div class="text-center mb-3">
                            @if ($member->mem_pic && $member->mem_pic !== 'default.png')
                                <img src="{{ asset('uploads/member/'.$member->mem_pic) }}" 
                                     class="rounded-circle mb-2" width="120" height="120" alt="avatar">
                            @else
                                <img src="{{ asset('uploads/member/default.png') }}" 
                                     class="rounded-circle mb-2" width="120" height="120" alt="default">
                            @endif
                            <div>
                                <input type="file" name="mem_pic" class="form-control mt-2">
                                <small class="text-muted">รองรับ jpeg, jpg, png | ไม่เกิน 5MB</small>
                            </div>
                        </div>

                        {{-- ชื่อ-นามสกุล --}}
                        <div class="mb-3">
                            <label for="mem_name" class="form-label">ชื่อ-นามสกุล</label>
                            <input type="text" name="mem_name" id="mem_name" 
                                   class="form-control @error('mem_name') is-invalid @enderror"
                                   value="{{ old('mem_name', $member->mem_name) }}" required>
                            @error('mem_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Username --}}
                        <div class="mb-3">
                            <label for="mem_username" class="form-label">Username</label>
                            <input type="text" name="mem_username" id="mem_username" 
                                   class="form-control @error('mem_username') is-invalid @enderror"
                                   value="{{ old('mem_username', $member->mem_username) }}" required>
                            @error('mem_username') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Email --}}
                        <div class="mb-3">
                            <label for="mem_email" class="form-label">อีเมล</label>
                            <input type="email" name="mem_email" id="mem_email" 
                                   class="form-control @error('mem_email') is-invalid @enderror"
                                   value="{{ old('mem_email', $member->mem_email) }}" required>
                            @error('mem_email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- Phone --}}
                        <div class="mb-3">
                            <label for="mem_phone" class="form-label">เบอร์โทรศัพท์</label>
                            <input type="text" name="mem_phone" id="mem_phone" 
                                   class="form-control @error('mem_phone') is-invalid @enderror"
                                   value="{{ old('mem_phone', $member->mem_phone) }}" required>
                            @error('mem_phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        {{-- วันเกิด --}}
                        <div class="mb-3">
                            <label for="mem_dob" class="form-label">วันเกิด</label>
                            <input type="date" name="mem_dob" id="mem_dob" 
                                   class="form-control @error('mem_dob') is-invalid @enderror"
                                   value="{{ old('mem_dob', $member->mem_dob) }}" required>
                            @error('mem_dob') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <button type="submit" class="btn btn-primary w-100">💾 บันทึกการเปลี่ยนแปลง</button>
                    </form>

                    {{-- ปุ่มลบ Avatar --}}
                    <form action="{{ route('member.avatar.delete') }}" method="POST" class="mt-2 text-center">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger btn-sm">❌ ลบรูปโปรไฟล์</button>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
@extends('home')

@section('css_before')
@endsection

@section('header')
@endsection

@section('sidebarMenu')
@endsection

@section('content')
    <div class="container-fluid" style="margin-top: 1.5rem;">
        <div class="card shadow-lg border-0 rounded-3">
            <div class="card-header text-white" style="background-color: rgb(148, 135, 148);">
                <h5 class="mb-0"><i class="fa-solid fa-user-pen me-2"></i>Form Update Employee</h5>
            </div>
            <div class="card-body p-4">

                <form action="/employee/{{ $emp_id }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')

                    {{-- Upload Pic --}}
                    <div class="mb-4">
                        <label class="form-label fw-bold">Employee Picture</label>
                        <div class="d-flex justify-content-start mb-3">
                            <div class="card shadow-sm p-3" style="width: 220px; border-radius: 15px; background:#fdfdfd;">
                                <div class="d-flex flex-column align-items-center position-relative">
                                    {{-- แสดงรูป (จะอัปเดตเมื่อเลือกไฟล์ใหม่) --}}
                                    <img id="previewImage" src="{{ asset('storage/' . $emp_pic) }}" alt="Employee Picture"
                                        class="rounded-circle border-3 shadow-sm"
                                        style="width: 120px; height:120px; object-fit: cover;">
                                    <h6 class="mt-3 text-secondary">Current Picture</h6>

                                    {{-- ปุ่มอัปโหลดใหม่ --}}
                                    <label for="emp_pic"
                                        class="position-absolute bottom-0 end-0 translate-middle p-2 bg-white rounded-circle shadow"
                                        style="cursor: pointer;" data-bs-toggle="tooltip" title="Choose image">
                                        <i class="fa-solid fa-pencil-alt text-primary"></i>
                                    </label>
                                    <input type="file" name="emp_pic" id="emp_pic" class="d-none" accept="image/*">
                                </div>
                            </div>
                        </div>
                        @if (isset($errors) && $errors->has('emp_pic'))
                            <div class="text-danger small mt-1">{{ $errors->first('emp_pic') }}</div>
                        @endif
                        <input type="hidden" name="oldImg" value="{{ $emp_pic }}">
                    </div>

                    <div class="row">
                        {{-- Name --}}
                        <div class="mb-3 col-lg-6 col-md-6">
                            <label class="form-label fw-bold">Employee Name</label>
                            <input type="text" class="form-control" name="emp_name" required placeholder="Employee Name"
                                value="{{ $emp_name }}">
                            @if (isset($errors) && $errors->has('emp_name'))
                                <div class="text-danger small mt-1">{{ $errors->first('emp_name') }}</div>
                            @endif
                        </div>

                        {{-- Email --}}
                        <div class="mb-3 col-lg-6 col-md-6">
                            <label class="form-label fw-bold">Email</label>
                            <input type="email" class="form-control" name="emp_email" required
                                placeholder="email address" value="{{ $emp_email }}">
                            @if (isset($errors) && $errors->has('emp_email'))
                                <div class="text-danger small mt-1">{{ $errors->first('emp_email') }}</div>
                            @endif
                        </div>

                        {{-- Username --}}
                        <div class="mb-3 col-lg-6 col-md-6">
                            <label class="form-label fw-bold">Username</label>
                            <input type="text" class="form-control" name="emp_username" required placeholder="Username"
                                value="{{ $emp_username }}">
                            @if (isset($errors) && $errors->has('emp_username'))
                                <div class="text-danger small mt-1">{{ $errors->first('emp_username') }}</div>
                            @endif
                        </div>

                        {{-- Phone --}}
                        <div class="mb-3 col-lg-6 col-md-6">
                            <label class="form-label fw-bold">Phone</label>
                            <input type="tel" class="form-control" name="emp_phone" required
                                placeholder="Phone 10 digit" minlength="10" maxlength="10" value="{{ $emp_phone }}">
                            @if (isset($errors) && $errors->has('emp_phone'))
                                <div class="text-danger small mt-1">{{ $errors->first('emp_phone') }}</div>
                            @endif
                        </div>

                        {{-- Gender --}}
                        <div class="mb-3 col-lg-6 col-md-6">
                            <label class="form-label fw-bold">Gender</label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="emp_gender" id="male"
                                        value="male" {{ $emp_gender == 'male' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="male">Male</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="emp_gender" id="female"
                                        value="female" {{ $emp_gender == 'female' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="female">Female</label>
                                </div>
                            </div>
                        </div>

                        {{-- Role --}}
                        <div class="mb-3 col-lg-6 col-md-6">
                            <label class="form-label fw-bold">Role</label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="role" id="admin"
                                        value="admin" {{ $role == 'admin' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="admin">Admin</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="role" id="staff"
                                        value="staff" {{ $role == 'staff' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="staff">Staff</label>
                                </div>
                            </div>
                        </div>

                        {{-- Date of Birth --}}
                        <div class="mb-3 col-lg-6 col-md-6">
                            <label class="form-label fw-bold">Date of Birth</label>
                            <input type="date" class="form-control" name="emp_dob" required
                                value="{{ $emp_dob }}">
                            @if (isset($errors) && $errors->has('emp_dob'))
                                <div class="text-danger small mt-1">{{ $errors->first('emp_dob') }}</div>
                            @endif
                        </div>

                        {{-- Start Date --}}
                        <div class="mb-3 col-lg-6 col-md-6">
                            <label class="form-label fw-bold">Start Date of Work</label>
                            <input type="date" class="form-control" name="date" required
                                value="{{ $date }}">
                            @if (isset($errors) && $errors->has('date'))
                                <div class="text-danger small mt-1">{{ $errors->first('date') }}</div>
                            @endif
                        </div>

                        
                    </div>
                    {{-- Buttons --}}
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary ms-2 mb-2">
                            <i class="fa-solid fa-save me-1"></i> Update
                        </button>
                        <a href="/employee" class="btn btn-cancle btn-danger ms-2 mb-2">
                            <i class="fa-solid fa-xmark me-1"></i> Cancel
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection

@section('footer')
@endsection

@section('js_before')
    <script>
        // เปิดใช้งาน tooltip ของ Bootstrap
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })

        // แสดงรูป preview เมื่อเลือกไฟล์ใหม่
        document.getElementById('emp_pic').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('previewImage').src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection

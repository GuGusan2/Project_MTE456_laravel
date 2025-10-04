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
                <h5 class="mb-0"><i class="fa-solid fa-user-plus me-2"></i>Form Add Employee</h5>
            </div>
            <div class="card-body p-4">

                <form action="/employee/" method="post" enctype="multipart/form-data">
                    @csrf

                    {{-- Upload Pic --}}
                    <div class="mb-4">
                        <label class="form-label fw-bold">Employee Picture</label>
                        {{-- Preview Zone --}}
                        <div class="d-flex justify-content-start mb-3">
                            <div class="card shadow-sm p-3 position-relative"
                                style="width: 220px; border-radius: 15px; background:#fdfdfd;">
                                <div class="d-flex flex-column align-items-center">
                                    <img id="previewImage" src="#" alt="Preview"
                                        class="rounded-circle border-3 shadow-sm d-none"
                                        style="width: 120px; height:120px; object-fit: cover;">
                                    <h6 class="mt-3 text-secondary">Profile Preview</h6>
                                </div>

                                {{-- ปุ่มไอคอนดินสอแทน choose file --}}
                                <input type="file" class="d-none" name="emp_pic" id="emp_pic" required
                                    accept="image/*">
                                <label for="emp_pic"
                                    class="position-absolute bottom-0 end-0 translate-middle p-2 bg-white rounded-circle shadow"
                                    style="cursor: pointer;" title="Choose image">
                                    <i class="fa-solid fa-pencil-alt text-primary"></i>
                                </label>

                            </div>
                        </div>

                        @if (isset($errors) && $errors->has('emp_pic'))
                            <div class="text-danger small mt-1">{{ $errors->first('emp_pic') }}</div>
                        @endif
                    </div>



                    <div class="row">
                        {{-- Name --}}
                        <div class="mb-3 col-md-6 col-lg-6">
                            <label class="form-label fw-bold">Name</label>
                            <input type="text" class="form-control col-md-5" name="emp_name" required placeholder="Employee Name"
                                minlength="3" value="{{ old('emp_name') }}">
                            @if (isset($errors) && $errors->has('emp_name'))
                                <div class="text-danger small mt-1">{{ $errors->first('emp_name') }}</div>
                            @endif
                        </div>

                        {{-- Email --}}
                        <div class="mb-3 col-md-6 col-lg-6">
                            <label class="form-label fw-bold">Email</label>
                            <input type="email" class="form-control" name="emp_email" required placeholder="email address"
                                minlength="3" value="{{ old('emp_email') }}">
                            @if (isset($errors) && $errors->has('emp_email'))
                                <div class="text-danger small mt-1">{{ $errors->first('emp_email') }}</div>
                            @endif
                        </div>

                        {{-- Username --}}
                        <div class="mb-3 col-md-6 col-lg-6">
                            <label class="form-label fw-bold">Username</label>
                            <input type="text" class="form-control" name="emp_username" required placeholder="Username"
                                minlength="3" value="{{ old('emp_username') }}">
                            @if (isset($errors) && $errors->has('emp_username'))
                                <div class="text-danger small mt-1">{{ $errors->first('emp_username') }}</div>
                            @endif
                        </div>

                        {{-- Password --}}
                        <div class="mb-3 col-md-6 col-lg-6">
                            <label class="form-label fw-bold">Password</label>
                            <input type="password" class="form-control" name="emp_password" required placeholder="Password"
                                minlength="3">
                            @if (isset($errors) && $errors->has('emp_password'))
                                <div class="text-danger small mt-1">{{ $errors->first('emp_password') }}</div>
                            @endif
                        </div>

                        {{-- Phone --}}
                        <div class="mb-3 col-md-6 col-lg-6">
                            <label class="form-label fw-bold">Phone</label>
                            <input type="tel" class="form-control" name="emp_phone" required
                                placeholder="Phone 10 digit" minlength="10" maxlength="10" value="{{ old('emp_phone') }}">
                            @if (isset($errors) && $errors->has('emp_phone'))
                                <div class="text-danger small mt-1">{{ $errors->first('emp_phone') }}</div>
                            @endif
                        </div>

                        {{-- Gender --}}
                        <div class="mb-3 col-md-6 col-lg-6">
                            <label class="form-label fw-bold">Gender</label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="emp_gender" id="male"
                                        value="male" {{ old('emp_gender') == 'male' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="male">Male</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="emp_gender" id="female"
                                        value="female" {{ old('emp_gender') == 'female' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="female">Female</label>
                                </div>
                            </div>
                        </div>

                        {{-- Role --}}
                        <div class="mb-3 col-md-6 col-lg-6">
                            <label class="form-label fw-bold">Role</label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="role" id="admin"
                                        value="admin" {{ old('role') == 'admin' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="admin">Admin</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" class="form-check-input" name="role" id="staff"
                                        value="staff" {{ old('role') == 'staff' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="staff">Staff</label>
                                </div>
                            </div>
                        </div>

                        {{-- Date of Birth --}}
                        <div class="mb-3 col-md-6 col-lg-6">
                            <label class="form-label fw-bold">Date of Birth</label>
                            <input type="date" class="form-control" name="emp_dob" required
                                value="{{ old('emp_dob') }}">
                            @if (isset($errors) && $errors->has('emp_dob'))
                                <div class="text-danger small mt-1">{{ $errors->first('emp_dob') }}</div>
                            @endif
                        </div>

                        {{-- Start Date --}}
                        <div class="mb-3 col-md-6 col-lg-6">
                            <label class="form-label fw-bold">Start Date of Work</label>
                            <input type="date" class="form-control" name="date" required
                                value="{{ old('date') }}">
                            @if (isset($errors) && $errors->has('date'))
                                <div class="text-danger small mt-1">{{ $errors->first('date') }}</div>
                            @endif
                        </div>

                    </div>
                    {{-- Buttons --}}
                    <div class="text-end">
                        <button type="submit" class="btn btn-success mb-2 ms-2">
                            <i class="fa-solid fa-plus me-1"></i> Insert Employee
                        </button>
                        <a href="/employee" class="btn btn-cancle btn-secondary ms-2 mb-2">
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
        document.getElementById('emp_pic').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('previewImage');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('d-none');
                };
                reader.readAsDataURL(file);
            } else {
                preview.src = "#";
                preview.classList.add('d-none');
            }
        });
    </script>
@endsection

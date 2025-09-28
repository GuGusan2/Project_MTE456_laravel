@extends('home')

@section('content')
<div class="container-fluid" style="margin-top: 1.5rem;">
    <div class="card shadow-lg border-0 rounded-3">
        <div class="card-header text-white" style="background-color: rgb(148, 135, 148);">
            <h5 class="mb-0"><i class="fa-solid fa-user-plus me-2"></i>Form Add Member</h5>
        </div>
        <div class="card-body p-4">
            <form action="{{ url('/member') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Upload Picture --}}
                <div class="mb-4">
                    <label class="form-label fw-bold">Member Picture</label>
                    <div class="d-flex justify-content-start mb-3">
                        <div class="card shadow-sm p-3 position-relative"
                            style="width: 220px; border-radius: 15px; background:#fdfdfd;">
                            <div class="d-flex flex-column align-items-center">
                                <img id="previewImage" src="#" alt="Preview"
                                    class="rounded-circle border-3 shadow-sm d-none"
                                    style="width: 120px; height:120px; object-fit: cover;">
                                <h6 class="mt-3 text-secondary">Profile Preview</h6>
                            </div>

                            <input type="file" class="d-none" name="mem_pic" id="mem_pic" accept="image/*" required>
                            <label for="mem_pic"
                                class="position-absolute bottom-0 end-0 translate-middle p-2 bg-white rounded-circle shadow"
                                style="cursor: pointer;" title="Choose image">
                                <i class="fa-solid fa-pencil-alt text-primary"></i>
                            </label>
                        </div>
                    </div>
                    @error('mem_pic')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Member Name --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">Member Name</label>
                    <input type="text" class="form-control" name="mem_name" required placeholder="Member Name"
                        minlength="3" value="{{ old('mem_name') }}">
                    @error('mem_name')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">Email</label>
                    <input type="email" class="form-control" name="mem_email" required placeholder="email/username"
                        minlength="3" value="{{ old('mem_email') }}">
                    @error('mem_email')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Username --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">Username</label>
                    <input type="text" class="form-control" name="mem_username" required placeholder="Username"
                        minlength="3" value="{{ old('mem_username') }}">
                    @error('mem_username')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">Password</label>
                    <input type="password" class="form-control" name="mem_password" required placeholder="Password"
                        minlength="3">
                    @error('mem_password')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Phone --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">Phone</label>
                    <input type="tel" class="form-control" name="mem_phone" required placeholder="Phone 10 digit"
                        minlength="10" maxlength="10" value="{{ old('mem_phone') }}">
                    @error('mem_phone')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Gender --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">Gender</label>
                    <div>
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" name="mem_gender" id="male"
                                value="male" {{ old('mem_gender') == 'male' ? 'checked' : '' }}>
                            <label class="form-check-label" for="male">Male</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" name="mem_gender" id="female"
                                value="female" {{ old('mem_gender') == 'female' ? 'checked' : '' }}>
                            <label class="form-check-label" for="female">Female</label>
                        </div>
                    </div>
                    @error('mem_gender')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Date of Birth --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">Date of Birth</label>
                    <input type="date" class="form-control" name="mem_dob" required value="{{ old('mem_dob') }}">
                    @error('mem_dob')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Buttons --}}
                <div class="text-end">
                    <button type="submit" class="btn btn-success me-2">
                        <i class="fa-solid fa-plus me-1"></i> Insert Member
                    </button>
                    <a href="{{ url('/member') }}" class="btn btn-secondary">
                        <i class="fa-solid fa-xmark me-1"></i> Cancel
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection

@section('js_before')
<script>
    document.getElementById('mem_pic').addEventListener('change', function(event) {
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

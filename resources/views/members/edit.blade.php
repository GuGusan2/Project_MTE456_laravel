@extends('home')

@section('content')
<div class="container-fluid" style="margin-top: 1.5rem;">
    <div class="card shadow-lg border-0 rounded-3">
        <div class="card-header text-white" style="background-color: rgb(148, 135, 148);">
            <h5 class="mb-0"><i class="fa-solid fa-user-pen me-2"></i>Form Update Member</h5>
        </div>
        <div class="card-body p-4">

            <form action="/member/{{ $mem_id }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')

                {{-- Upload Pic --}}
                <div class="mb-4">
                    <label class="form-label fw-bold">Member Picture</label>
                    <div class="d-flex justify-content-start mb-3">
                        <div class="card shadow-sm p-3 position-relative"
                             style="width: 220px; border-radius: 15px; background:#fdfdfd;">
                            <div class="d-flex flex-column align-items-center">
                                {{-- แสดงรูปปัจจุบัน --}}
                                <img id="previewImage"
                                     src="{{ asset('storage/' . $mem_pic) }}"
                                     alt="Member Picture"
                                     class="rounded-circle border-3 shadow-sm"
                                     style="width: 120px; height:120px; object-fit: cover;">
                                <h6 class="mt-3 text-secondary">Current Picture</h6>
                            </div>

                            <input type="file" class="d-none" name="mem_pic" id="mem_pic" accept="image/*">
                            <label for="mem_pic"
                                   class="position-absolute bottom-0 end-0 translate-middle p-2 bg-white rounded-circle shadow"
                                   style="cursor: pointer;" title="Choose image">
                                <i class="fa-solid fa-pencil-alt text-primary"></i>
                            </label>
                        </div>
                    </div>
                    @if(isset($errors) && $errors->has('mem_pic'))
                        <div class="text-danger small mt-1">{{ $errors->first('mem_pic') }}</div>
                    @endif
                    <input type="hidden" name="oldImg" value="{{ $mem_pic }}">
                </div>

                {{-- Member Name --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">Member Name</label>
                    <input type="text" class="form-control" name="mem_name" required placeholder="Member Name"
                           value="{{ $mem_name }}">
                    @if(isset($errors) && $errors->has('mem_name'))
                        <div class="text-danger small mt-1">{{ $errors->first('mem_name') }}</div>
                    @endif
                </div>

                {{-- Email --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">Email</label>
                    <input type="email" class="form-control" name="mem_email" required placeholder="email/username"
                           value="{{ $mem_email }}">
                    @if(isset($errors) && $errors->has('mem_email'))
                        <div class="text-danger small mt-1">{{ $errors->first('mem_email') }}</div>
                    @endif
                </div>

                {{-- Username --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">Username</label>
                    <input type="text" class="form-control" name="mem_username" required placeholder="Username"
                           value="{{ $mem_username }}">
                    @if(isset($errors) && $errors->has('mem_username'))
                        <div class="text-danger small mt-1">{{ $errors->first('mem_username') }}</div>
                    @endif
                </div>

                {{-- Phone --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">Phone</label>
                    <input type="tel" class="form-control" name="mem_phone" required placeholder="Phone 10 digit"
                           minlength="10" maxlength="10" value="{{ $mem_phone }}">
                    @if(isset($errors) && $errors->has('mem_phone'))
                        <div class="text-danger small mt-1">{{ $errors->first('mem_phone') }}</div>
                    @endif
                </div>

                {{-- Gender --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">Gender</label>
                    <div>
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" name="mem_gender" id="male" value="male"
                                   {{ $mem_gender == 'male' ? 'checked' : '' }}>
                            <label class="form-check-label" for="male">Male</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" name="mem_gender" id="female" value="female"
                                   {{ $mem_gender == 'female' ? 'checked' : '' }}>
                            <label class="form-check-label" for="female">Female</label>
                        </div>
                    </div>
                    @if(isset($errors) && $errors->has('mem_gender'))
                        <div class="text-danger small mt-1">{{ $errors->first('mem_gender') }}</div>
                    @endif
                </div>

                {{-- Date of Birth --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">Date of Birth</label>
                    <input type="date" class="form-control" name="mem_dob" required value="{{ $mem_dob }}">
                    @if(isset($errors) && $errors->has('mem_dob'))
                        <div class="text-danger small mt-1">{{ $errors->first('mem_dob') }}</div>
                    @endif
                </div>

                {{-- Buttons --}}
                <div class="text-end">
                    <button type="submit" class="btn btn-primary me-2">
                        <i class="fa-solid fa-save me-1"></i> Update
                    </button>
                    <a href="/member" class="btn btn-danger">
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
    // แสดง preview รูปใหม่เมื่อเลือกไฟล์
    document.getElementById('mem_pic').addEventListener('change', function(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('previewImage');
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        } else {
            preview.src = "{{ asset('storage/' . $mem_pic) }}";
        }
    });
</script>
@endsection

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
            <h5 class="mb-0"><i class="fa-solid fa-key me-2"></i>Form Update Member Password</h5>
        </div>
        <div class="card-body p-4">

            <form action="/member/reset/{{ $mem_id }}" method="post">
                @csrf
                @method('put')

                {{-- Member Name --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">Member Name</label>
                    <input type="text" class="form-control" name="mem_name" disabled
                           placeholder="Member Name" value="{{ $mem_name }}">
                </div>

                {{-- Username/Email --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">Email / Username</label>
                    <input type="email" class="form-control" name="mem_username" disabled
                           placeholder="Email" value="{{ $mem_username }}" minlength="4">
                </div>

                {{-- New Password --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">New Password</label>
                    <input type="password" class="form-control" name="password" required
                           placeholder="New Password at least 3 characters)">
                    @if(isset($errors) && $errors->has('password'))
                        <div class="text-danger small mt-1">{{ $errors->first('password') }}</div>
                    @endif
                </div>

                {{-- Confirm Password --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">Confirm Password</label>
                    <input type="password" class="form-control" name="password_confirmation" required
                           placeholder="Confirm Password at least 3 characters)" minlength="3">
                    @if(isset($errors) && $errors->has('password_confirmation'))
                        <div class="text-danger small mt-1">{{ $errors->first('password_confirmation') }}</div>
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

@section('footer')
@endsection

@section('js_before')
@endsection

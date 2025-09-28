@extends('frontendAuth')

@section('css_before')
<style>
    body {
        background: linear-gradient(135deg, #f5f0e1, #e8dcd1);
        font-family: 'Poppins', sans-serif;
    }

    .login-card {
        border-radius: 15px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        background-color: #ffffffcc;
        padding: 30px;
        transition: transform 0.3s;
    }

    .login-card:hover {
        transform: translateY(-5px);
    }

    .login-card h3 {
        font-weight: 600;
        color: #6b4c3b;
    }

    .form-control {
        border-radius: 10px;
        border: 1px solid #d6c1b0;
        padding: 12px;
        transition: all 0.3s;
    }

    .form-control:focus {
        border-color: #6b4c3b;
        box-shadow: 0 0 5px rgba(107,76,59,0.5);
    }

    .btn-login {
        background: #6b4c3b;
        color: #fff;
        border-radius: 10px;
        padding: 10px 25px;
        transition: all 0.3s;
    }

    .btn-login:hover {
        background: #5a3c2b;
    }

    .btn-cancel {
        border-radius: 10px;
        border: 2px solid #6b4c3b;
        color: #6b4c3b;
        padding: 10px 25px;
        transition: all 0.3s;
    }

    .btn-cancel:hover {
        background: #6b4c3b;
        color: #fff;
    }
</style>
@endsection

@section('navbar')
@endsection

@section('showProduct')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="login-card">
                <h3 class="text-center mb-4">Welcome Back!</h3>

                <form action="/login" method="post">
                    @csrf

                    <div class="mb-3">
                        <input type="text" class="form-control" name="login" required
                            placeholder="Username หรือ Email" value="{{ old('login') }}">
                        @if (isset($errors) && $errors->has('login'))
                            <div class="text-danger mt-1">{{ $errors->first('login') }}</div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <input type="password" class="form-control" name="emp_password" required
                            placeholder="Password" minlength="3">
                        @if (isset($errors) && $errors->has('emp_password'))
                            <div class="text-danger mt-1">{{ $errors->first('emp_password') }}</div>
                        @endif
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        <button type="submit" class="btn btn-login">Login</button>
                        <a href="/" class="btn btn-cancel">Cancel</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')
@endsection

@section('js_before')
@endsection

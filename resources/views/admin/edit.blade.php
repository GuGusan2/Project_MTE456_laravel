@extends('home')

@section('css_before')
@endsection

@section('header')
@endsection

@section('sidebarMenu')
@endsection

@section('content')

<div class="container mt-4">
    <div class="row">
        <div class="col-sm-12">

            <h3> :: form Update Admin :: </h3>


            <form action="/admin/{{ $id }}" method="post">
                @csrf
                @method('put')

                

                <div class="form-group row mb-2">
                    <label class="col-sm-2"> Admin Name </label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" name="admin_name" required placeholder="name"
                            value="{{ $admin_name }}">
                        @if(isset($errors))
                            @if($errors->has('admin_name'))
                                <div class="text-danger"> {{ $errors->first('admin_name') }}</div>
                            @endif
                        @endif
                    </div>
                </div>

                <div class="form-group row mb-2">
                    <label class="col-sm-2"> Email/Username </label>
                    <div class="col-sm-6">
                        <input type="email" class="form-control" name="admin_username" required placeholder="username"
                            value="{{ $admin_username }}">
                        @if(isset($errors))
                            @if($errors->has('admin_username'))
                                <div class="text-danger"> {{ $errors->first('admin_username') }}</div>
                            @endif
                        @endif
                    </div>
                </div>


                <div class="form-group row mb-2">
                    <label class="col-sm-2"> </label>
                    <div class="col-sm-5">
                        <button type="submit" class="btn btn-primary"> Update </button>
                        <a href="/admin" class="btn btn-danger">cancel</a>
                    </div>
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

@section('js_before')
@endsection
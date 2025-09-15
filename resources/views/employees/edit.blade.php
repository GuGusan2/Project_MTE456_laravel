@extends('home')
@section('js_before')
@include('sweetalert::alert')
@section('header')
@section('sidebarMenu')   
@section('content')


<div style="margin: 1.3rem auto;" class="container">
    <h3> :: form Update Employee :: </h3>
</div>

    <form action="/employee/{{ $emp_id }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')

        <div class="form-group row mb-2">
            <label class="col-sm-2"> Pic </label>
            <div class="col-sm-6">
                old img <br>
                <img src="{{ asset('storage/' . $emp_pic) }}" width="200px"> <br>
                choose new image <br>
                <input type="file" name="emp_pic" placeholder="Employee image" accept="image/*">
                @if(isset($errors))
                @if($errors->has('emp_pic'))
                <div class="text-danger"> {{ $errors->first('emp_pic') }}</div>
                @endif
                @endif
            </div>
        </div>

        <div class="form-group row mb-2">
            <label class="col-sm-2"> Employee Name </label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="emp_name" required placeholder="name"
                            value="{{ $emp_name }}">
                @if(isset($errors))
                            @if($errors->has('emp_name'))
                                <div class="text-danger"> {{ $errors->first('emp_name') }}</div>
                            @endif
                        @endif            
            </div>
        </div>

        <div class="form-group row mb-2">
            <label class="col-sm-2"> Email </label>
            <div class="col-sm-6">
                <input type="email" class="form-control" name="emp_email" required placeholder="email"
                            value="{{ $emp_email }}" minlength="3">
                @if(isset($errors))
                            @if($errors->has('emp_email'))
                                <div class="text-danger"> {{ $errors->first('emp_email') }}</div>
                            @endif
                        @endif
            </div>
        </div>        

        <div class="form-group row mb-2">
            <label class="col-sm-2"> Username </label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="emp_username" required placeholder="Username "
                    minlength="3" value="{{ $emp_username }}">
                    @if(isset($errors))
                            @if($errors->has('emp_username'))
                                <div class="text-danger"> {{ $errors->first('emp_username') }}</div>
                            @endif
                        @endif
            </div>
        </div>

        <div class="form-group row mb-2">
            <label class="col-sm-2"> Phone </label>
            <div class="col-sm-6">
                <input type="tel" class="form-control" name="emp_phone" required placeholder="Phone 10 digit"
                    minlength="10" maxlength="10" value="{{ $emp_phone }}">
                    @if(isset($errors))
                            @if($errors->has('emp_phone'))
                                <div class="text-danger"> {{ $errors->first('emp_phone') }}</div>
                            @endif
                        @endif
            </div>
        </div>

        <div class="form-group row mb-2">
            <label class="col-sm-2 form-label"> Gender </label>
            <div class="col-sm-6">
                <div class="form-check form-check-inline">
                    <input type="radio" class="border-2 form-check-input" name="emp_gender" id="male" value="male"
                    {{ $emp_gender == 'male' ? 'checked' : '' }}>
                    <label class="form-check-label" for="male"> Male </label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" class="border-2 form-check-input" name="emp_gender" id="female" value="female"
                    {{ $emp_gender == 'female' ? 'checked' : '' }}>
                    <label class="form-check-label" for="female"> Female </label>
                </div>

            </div>
        </div>
        <div class="form-group row mb-2">
            <label class="col-sm-2 form-label"> Role </label>
            <div class="col-sm-6">
                <div class="form-check form-check-inline">
                    <input type="radio" class="border-2 form-check-input" name="role" id="admin" value="admin"
                    {{ $role == 'admin' ? 'checked' : '' }}>
                    <label class="form-check-label" for="admin"> Admin </label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" class="border-2 form-check-input" name="role" id="staff" value="staff"
                    {{ $role == 'staff' ? 'checked' : '' }}>
                    <label class="form-check-label" for="staff"> Staff </label>
                </div>

            </div>
        </div>

        <div class="form-group row mb-2">
            <label class="col-sm-2"> Date of birth </label>
            <div class="col-sm-6">
                <input type="date" class="form-control" name="emp_dob" required placeholder="date of birth" value="{{ $emp_dob }}">
                    @if(isset($errors))
                    @if($errors->has('emp_dob'))
                        <div class="text-danger"> {{ $errors->first('emp_dob') }}</div>
                    @endif
                    @endif
            </div>
        </div>

        <div class="form-group row mb-2">
            <label class="col-sm-2"> Start date of work </label>
            <div class="col-sm-6">
                <input type="date" class="form-control" name="date" required placeholder="start date" value="{{ $date }}">
                    @if(isset($errors))
                    @if($errors->has('date'))
                        <div class="text-danger"> {{ $errors->first('date') }}</div>
                    @endif
                    @endif
            </div>
        </div>

        <div class="form-group row mb-2">
            <label class="col-sm-2"> </label>
            <div class="col-sm-10">
                <input type="hidden" name="oldImg" value="{{ $emp_pic }}">
                    <button type="submit" class="btn btn-primary mb-2 me-2"> Update </button>
                    <a href="/employee" class="btn btn-danger mb-2 me-2">cancel</a>
            </div>
        </div>

    </form>
</div>


@endsection


@section('footer')
@endsection

@section('js_before')
@endsection

{{-- devbanban.com --}}
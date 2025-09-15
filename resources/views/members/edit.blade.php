@extends('home')
@section('js_before')
@include('sweetalert::alert')
@section('header')
@section('sidebarMenu')   
@section('content')


<div style="margin: 1.3rem auto;" class="container">
    <h3> :: form Update Member :: </h3>
</div>

    <form action="/member/{{ $mem_id }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')

        <div class="form-group row mb-2">
            <label class="col-sm-2"> Pic </label>
            <div class="col-sm-6">
                old img <br>
                <img src="{{ asset('storage/' . $mem_pic) }}" width="200px"> <br>
                choose new image <br>
                <input type="file" name="mem_pic" placeholder="Member image" accept="image/*">
                @if(isset($errors))
                @if($errors->has('mem_pic'))
                <div class="text-danger"> {{ $errors->first('mem_pic') }}</div>
                @endif
                @endif
            </div>
        </div>
        
        <div class="form-group row mb-2">
            <label class="col-sm-2"> Member Name </label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="mem_name" required placeholder="name"
                            value="{{ $mem_name }}">
                @if(isset($errors))
                            @if($errors->has('mem_name'))
                                <div class="text-danger"> {{ $errors->first('mem_name') }}</div>
                            @endif
                        @endif            
            </div>
        </div>

        <div class="form-group row mb-2">
            <label class="col-sm-2"> Email </label>
            <div class="col-sm-6">
                <input type="email" class="form-control" name="mem_email" required placeholder="email"
                            value="{{ $mem_email }}" minlength="3">
                @if(isset($errors))
                            @if($errors->has('mem_email'))
                                <div class="text-danger"> {{ $errors->first('mem_email') }}</div>
                            @endif
                        @endif
            </div>
        </div>        

        <div class="form-group row mb-2">
            <label class="col-sm-2"> Username </label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="mem_username" required placeholder="Username "
                    minlength="3" value="{{ $mem_username }}">
                    @if(isset($errors))
                            @if($errors->has('mem_username'))
                                <div class="text-danger"> {{ $errors->first('mem_username') }}</div>
                            @endif
                        @endif
            </div>
        </div>

        <div class="form-group row mb-2">
            <label class="col-sm-2"> Phone </label>
            <div class="col-sm-6">
                <input type="tel" class="form-control" name="mem_phone" required placeholder="Phone 10 digit"
                    minlength="10" maxlength="10" value="{{ $mem_phone }}">
                    @if(isset($errors))
                            @if($errors->has('mem_phone'))
                                <div class="text-danger"> {{ $errors->first('mem_phone') }}</div>
                            @endif
                        @endif
            </div>
        </div>

        <div class="form-group row mb-2">
            <label class="col-sm-2 form-label"> Gender </label>
            <div class="col-sm-10">
                <div class="form-check form-check-inline">
                    <input type="radio" class="border-2 form-check-input" name="mem_gender" id="male" value="male"
                    {{ $mem_gender == 'male' ? 'checked' : '' }}>
                    <label class="form-check-label" for="male"> Male </label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" class="border-2 form-check-input" name="mem_gender" id="female" value="female"
                    {{ $mem_gender == 'female' ? 'checked' : '' }}>
                    <label class="form-check-label" for="female"> Female </label>
                </div>

            </div>
        </div>

        <div class="form-group row mb-2">
            <label class="col-sm-2"> Date of birth </label>
            <div class="col-sm-6">
                <input type="date" class="form-control" name="mem_dob" required placeholder="date of birth" value="{{ $mem_dob }}">
                    @if(isset($errors))
                    @if($errors->has('mem_dob'))
                        <div class="text-danger"> {{ $errors->first('mem_dob') }}</div>
                    @endif
                    @endif
            </div>
        </div>

        <div class="form-group row mb-2">
            <label class="col-sm-2"> </label>
            <div class="col-sm-10">
                <input type="hidden" name="oldImg" value="{{ $mem_pic }}">
                <button type="submit" class="btn btn-primary"> Update </button>
                <a href="/member" class="btn btn-danger">cancel</a>
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
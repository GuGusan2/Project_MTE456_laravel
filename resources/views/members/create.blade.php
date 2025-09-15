@extends('home')
@section('css_before')
@endsection
@section('header')
@endsection
@section('sidebarMenu')   
@endsection
@section('content')
 

<div style="margin: 1.3rem auto;" class="container">
        <h3> :: Form Add Member :: </h3>
</div>

    <form action="/member/" method="post" enctype="multipart/form-data">
        @csrf

        <div class="form-group row mb-2">
            <label class="col-sm-2"> Pic </label>
            <div class="col-sm-6">
                <input type="file" name="mem_pic" required placeholder="Member image" accept="image/*">
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
                <input type="text" class="form-control" name="mem_name" required placeholder="Member Name "
                    minlength="3" value="{{ old('mem_name') }}">
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
                <input type="email" class="form-control" name="mem_email" required placeholder="email/username" minlength="3"  value="{{ old('mem_email') }}">
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
                    minlength="3" value="{{ old('mem_username') }}">
                @if(isset($errors))
                @if($errors->has('mem_username'))
                <div class="text-danger"> {{ $errors->first('mem_username') }}</div>
                @endif
                @endif
            </div>
        </div>

        <div class="form-group row mb-2">
            <label class="col-sm-2"> Password </label>
            <div class="col-sm-6">
                <input type="password" class="form-control" name="mem_password" required placeholder="Password" minlength="3">
                @if(isset($errors))
                @if($errors->has('mem_password'))
                    <div class="text-danger"> {{ $errors->first('mem_password') }}</div>
                @endif
                @endif
            </div>
        </div>

        <div class="form-group row mb-2">
            <label class="col-sm-2"> Phone </label>
            <div class="col-sm-6">
                <input type="tel" class="form-control" name="mem_phone" required placeholder="Phone 10 digit"
                    minlength="10" maxlength="10" value="{{ old('mem_phone') }}">
                    @if(isset($errors))
                    @if($errors->has('mem_phone'))
                        <div class="text-danger"> {{ $errors->first('mem_phone') }}</div>
                    @endif
                    @endif
            </div>
        </div>

        <div class="form-group row mb-2">
            <label class="col-sm-2 form-label"> Gender </label>
            <div class="col-sm-6">
                <div class="form-check form-check-inline">
                    <input type="radio" class="border-2 form-check-input" name="mem_gender" id="male" value="male">
                    {{ old('mem_gender') == 'male' ? 'checked' : '' }}
                    <label class="form-check-label" for="male"> Male </label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" class="border-2 form-check-input" name="mem_gender" id="female" value="female">
                    {{ old('mem_gender') == 'female' ? 'checked' : '' }}
                    <label class="form-check-label" for="female"> Female </label>
                </div>

            </div>
        </div>

        <div class="form-group row mb-2">
            <label class="col-sm-2"> Date of birth </label>
            <div class="col-sm-6">
                <input type="date" class="form-control" name="mem_dob" required placeholder="date of birth" value="{{ old('mem_dob') }}">
                    @if(isset($errors))
                    @if($errors->has('mem_dob'))
                        <div class="text-danger"> {{ $errors->first('mem_dob') }}</div>
                    @endif
                    @endif
            </div>
        </div>

        <div class="form-group row mb-2">
            <label class="col-sm-2"> </label>
            <div class="col-sm-5">

                <button type="submit" class="btn btn-primary"> Insert Member </button>
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
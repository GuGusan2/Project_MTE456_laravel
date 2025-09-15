@extends('home')
@section('js_before')
@include('sweetalert::alert')
@section('header')
@section('sidebarMenu')   
@section('content')

<div style="margin: 1.3rem auto;" class="container">
    <h3> :: form Update Promotion :: </h3>
</div>

    <form action="/promotion/{{ $pro_id }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')

        <div class="form-group row mb-2">
            <label class="col-sm-2"> Pic </label>
            <div class="col-sm-7">
                old img <br>
                <img src="{{ asset('storage/' . $pro_pic) }}" width="200px"> <br>
                choose new image <br>
                <input type="file" name="pro_pic" placeholder="pro_pic" accept="image/*">
                @if(isset($errors))
                @if($errors->has('pro_pic'))
                <div class="text-danger"> {{ $errors->first('pro_pic') }}</div>
                @endif
                @endif
            </div>
        </div>

        <div class="form-group row mb-2">
            <label class="col-sm-2"> Promotion Detail </label>
            <div class="col-sm-7">
                <textarea type="text" class="form-control" name="detail" required placeholder="Promotion Detail "
                    rows="4">{{ $detail }}</textarea>
                @if(isset($errors))
                @if($errors->has('detail'))
                <div class="text-danger"> {{ $errors->first('detail') }}</div>
                @endif
                @endif
            </div>
        </div>

        <div class="form-group row mb-2">
            <label class="col-sm-2">Promotion Condition </label>
            <div class="col-sm-7">
                <textarea type="text" class="form-control" name="conditions" required placeholder="conditions"
                    rows="4">{{ $conditions }}</textarea>
                @if(isset($errors))
                @if($errors->has('conditions'))
                <div class="text-danger"> {{ $errors->first('conditions') }}</div>
                @endif
                @endif
            </div>
        </div>

        <div class="form-group row mb-2">
            <label class="col-sm-2"> start date </label>
            <div class="col-sm-6">
                <input type="date" class="form-control" name="start_date" required placeholder="start_date of utilization" value="{{ $start_date }}">
                    @if(isset($errors))
                    @if($errors->has('start_date'))
                        <div class="text-danger"> {{ $errors->first('start_date') }}</div>
                    @endif
                    @endif
            </div>
        </div>

        <div class="form-group row mb-2">
            <label class="col-sm-2"> end date </label>
            <div class="col-sm-6">
                <input type="date" class="form-control" name="end_date" required placeholder="end_date of utilization" value="{{ $end_date }}">
                    @if(isset($errors))
                    @if($errors->has('end_date'))
                        <div class="text-danger"> {{ $errors->first('end_date') }}</div>
                    @endif
                    @endif
            </div>
        </div>

        <div class="form-group row mb-2">
            <label class="col-sm-2"> </label>
            <div class="col-sm-10">
                <input type="hidden" name="oldImg" value="{{ $pro_pic }}">
                <button type="submit" class="btn btn-primary mb-2 me-2"> Update </button>
                <a href="/promotion" class="btn btn-danger mb-2 me-2">cancel</a>
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
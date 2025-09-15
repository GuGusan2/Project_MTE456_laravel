@extends('home')
@section('css_before')
@endsection
@section('header')
@endsection
@section('sidebarMenu')   
@endsection
@section('content')
 

<div style="margin: 1.3rem auto;" class="container">
        <h3> :: Form Add Promotion :: </h3>
</div>

    <form action="/promotion/" method="post" enctype="multipart/form-data">
        @csrf

        <div class="form-group row mb-2">
            <label class="col-sm-2"> Pic </label>
            <div class="col-sm-7">
                <input type="file" name="pro_pic" required placeholder="pro_pic" accept="image/*">
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
                <textarea type="text" class="form-control" name="detail" required placeholder="Promotion Detail"
                    rows="4">{{ old('menu_detail') }}</textarea>
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
                    rows="4">{{ old('conditions') }}</textarea>
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
                <input type="date" class="form-control" name="start_date" required placeholder="start_date of utilization" value="{{ old('start_date') }}">
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
                <input type="date" class="form-control" name="end_date" required placeholder="end_date of utilization" value="{{ old('end_date') }}">
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

                <button type="submit" class="btn btn-primary mb-2 me-2"> Insert promotion </button>
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
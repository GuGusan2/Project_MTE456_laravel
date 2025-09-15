@extends('home')
@section('css_before')
@endsection
@section('header')
@endsection
@section('sidebarMenu')   
@endsection
@section('content')
 

<div style="margin: 1.3rem auto;" class="container">
        <h3> :: Form Add Menu :: </h3>
</div>

    <form action="/menu/" method="post" enctype="multipart/form-data">
        @csrf

        <div class="form-group row mb-2">
            <label class="col-sm-2"> Pic </label>
            <div class="col-sm-7">
                <input type="file" name="menu_pic" required placeholder="menu_pic" accept="image/*">
                @if(isset($errors))
                @if($errors->has('menu_pic'))
                <div class="text-danger"> {{ $errors->first('menu_pic') }}</div>
                @endif
                @endif
            </div>
        </div>

        <div class="form-group row mb-2">
            <label class="col-sm-2"> Menu Name </label>
            <div class="col-sm-7">
                <input type="text" class="form-control" name="menu_name" required placeholder="menu Name "
                    minlength="3" value="{{ old('menu_name') }}">
                @if(isset($errors))
                @if($errors->has('menu_name'))
                <div class="text-danger"> {{ $errors->first('menu_name') }}</div>
                @endif
                @endif
            </div>
        </div>

        <div class="form-group row mb-2">
            <label class="col-sm-2">Price </label>
            <div class="col-sm-7">
                <input type="number" class="form-control" name="price" required placeholder="price"
                    min="0" value="{{ old('price') }}">
                @if(isset($errors))
                @if($errors->has('price'))
                <div class="text-danger"> {{ $errors->first('price') }}</div>
                @endif
                @endif
            </div>
        </div>

        <div class="form-group row mb-2">
            <label class="col-sm-2"> Menu Type </label>
            <div class="col-sm-7">
                <div class="form-check form-check-inline">
                    <input type="radio" class="border-2 form-check-input" name="menu_type" id="food" value="food">
                    {{ old('menu_type') == 'food' ? 'checked' : '' }}
                    <label class="form-check-label" for="food"> Food </label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" class="border-2 form-check-input" name="menu_type" id="beverage" value="beverage">
                    {{ old('menu_type') == 'beverage' ? 'checked' : '' }}
                    <label class="form-check-label" for="beverage"> Beverage </label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" class="border-2 form-check-input" name="menu_type" id="sweet" value="sweet">
                    {{ old('menu_type') == 'sweet' ? 'checked' : '' }}
                    <label class="form-check-label" for="beverage"> Sweet </label>
                </div>
            </div>
        </div>

        <div class="form-group row mb-2">
            <label class="col-sm-2"> Menu detail </label>
            <div class="col-sm-7">
                <textarea name="menu_detail" class="form-control" rows="4" required
                    placeholder="menu detail ">{{ old('menu_detail') }}</textarea>
                @if(isset($errors))
                @if($errors->has('menu_detail'))
                <div class="text-danger"> {{ $errors->first('menu_detail') }}</div>
                @endif
                @endif
            </div>
        </div>

        <div class="form-group row mb-2">
            <label class="col-sm-2"> </label>
            <div class="col-sm-10">

                <button type="submit" class="btn btn-primary mb-2 me-2"> Insert menu </button>
                <a href="/menu" class="btn btn-danger mb-2 me-2">cancel</a>
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
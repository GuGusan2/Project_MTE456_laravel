@extends('home')

@section('content')
<div class="container-fluid" style="margin-top: 1.5rem;">
    <div class="card shadow-lg border-0 rounded-3">
        <div class="card-header text-white" style="background-color: rgb(148, 135, 148);">
            <h5 class="mb-0"><i class="fa-solid fa-pen-to-square me-2"></i>Form Update Menu</h5>
        </div>
        <div class="card-body p-4">

            <form action="/menu/{{ $menu_id }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')

                {{-- Menu Picture --}}
                <div class="mb-4">
                    <label class="form-label fw-bold">Menu Picture</label>
                    <div class="d-flex justify-content-start mb-3">
                        <div class="card shadow-sm p-3 position-relative"
                             style="width: 220px; border-radius: 15px; background:#fdfdfd;">
                            <div class="d-flex flex-column align-items-center">
                                <img id="previewImage" src="{{ asset('storage/' . $menu_pic) }}" 
                                     alt="Menu Picture"
                                     class="rounded-circle border-3 shadow-sm"
                                     style="width: 120px; height:120px; object-fit: cover;">
                                <h6 class="mt-3 text-secondary">Current Picture</h6>
                            </div>

                            <input type="file" class="d-none" name="menu_pic" id="menu_pic" accept="image/*">
                            <label for="menu_pic"
                                   class="position-absolute bottom-0 end-0 translate-middle p-2 bg-white rounded-circle shadow"
                                   style="cursor: pointer;" title="Choose new image">
                                <i class="fa-solid fa-pencil-alt text-primary"></i>
                            </label>
                        </div>
                    </div>
                    @if(isset($errors) && $errors->has('menu_pic'))
                        <div class="text-danger small mt-1">{{ $errors->first('menu_pic') }}</div>
                    @endif
                    <input type="hidden" name="oldImg" value="{{ $menu_pic }}">
                </div>

                {{-- Menu Name --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">Menu Name</label>
                    <input type="text" class="form-control" name="menu_name" required
                           placeholder="Menu Name" minlength="3" value="{{ $menu_name }}">
                    @if(isset($errors) && $errors->has('menu_name'))
                        <div class="text-danger small mt-1">{{ $errors->first('menu_name') }}</div>
                    @endif
                </div>

                {{-- Price --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">Price</label>
                    <input type="number" class="form-control" name="price" required
                           placeholder="Price" min="0" value="{{ $price }}">
                    @if(isset($errors) && $errors->has('price'))
                        <div class="text-danger small mt-1">{{ $errors->first('price') }}</div>
                    @endif
                </div>

                {{-- Menu Type --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">Menu Type</label>
                    <div>
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" name="menu_type" id="food" value="food"
                                   {{ $menu_type == 'food' ? 'checked' : '' }}>
                            <label class="form-check-label" for="food">Food</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" name="menu_type" id="beverage" value="beverage"
                                   {{ $menu_type == 'beverage' ? 'checked' : '' }}>
                            <label class="form-check-label" for="beverage">Beverage</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" name="menu_type" id="sweet" value="sweet"
                                   {{ $menu_type == 'sweet' ? 'checked' : '' }}>
                            <label class="form-check-label" for="sweet">Sweet</label>
                        </div>
                    </div>
                    @if(isset($errors) && $errors->has('menu_type'))
                        <div class="text-danger small mt-1">{{ $errors->first('menu_type') }}</div>
                    @endif
                </div>

                {{-- Menu Detail --}}
                <div class="mb-3">
                    <label class="form-label fw-bold">Menu Detail</label>
                    <textarea name="menu_detail" class="form-control" rows="4" required
                              placeholder="Menu Detail">{{ $menu_detail }}</textarea>
                    @if(isset($errors) && $errors->has('menu_detail'))
                        <div class="text-danger small mt-1">{{ $errors->first('menu_detail') }}</div>
                    @endif
                </div>

                {{-- Buttons --}}
                <div class="text-end">
                    <button type="submit" class="btn btn-primary ms-2 mb-2">
                        <i class="fa-solid fa-save me-1"></i> Update
                    </button>
                    <a href="/menu" class="btn btn-danger btn-cancle ms-2 mb-2">
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
    document.getElementById('menu_pic').addEventListener('change', function (event) {
        const file = event.target.files[0];
        const preview = document.getElementById('previewImage');
        if(file) {
            const reader = new FileReader();
            reader.onload = function(e){
                preview.src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection

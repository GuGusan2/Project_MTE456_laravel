@extends('home')

@section('content')
    <div class="container-fluid" style="margin-top: 1.5rem;">
        <div class="card shadow-lg border-0 rounded-3">
            <div class="card-header text-white" style="background-color: rgb(148, 135, 148);">
                <h5 class="mb-0"><i class="fa-solid fa-tags me-2"></i>Form Add Promotion</h5>
            </div>
            <div class="card-body p-4">

                <form action="/promotion/" method="post" enctype="multipart/form-data">
                    @csrf

                    {{-- Promotion Picture --}}
                    <div class="mb-4">
                        <label class="form-label fw-bold">Promotion Picture</label>
                        <div class="d-flex justify-content-start mb-3">
                            <div id="previewDiv" class="card shadow-sm position-relative"
                                style="width: 100%; height: 220px; border-radius: 15px; background:#fdfdfd; 
                    background-size: cover; background-position: center; background-repeat: no-repeat;">
                                {{-- เลือกรูป --}}
                                <input type="file" class="d-none" name="pro_pic" id="pro_pic" accept="image/*"
                                    required>
                                <label for="pro_pic"
                                    class="position-absolute bottom-0 end-0 translate-middle p-2 bg-white rounded-circle shadow"
                                    style="cursor: pointer;" title="Choose image">
                                    <i class="fa-solid fa-pencil-alt text-primary"></i>
                                </label>
                            </div>
                        </div>
                        @if (isset($errors) && $errors->has('pro_pic'))
                            <div class="text-danger small mt-1">{{ $errors->first('pro_pic') }}</div>
                        @endif
                    </div>

                    {{-- Promotion Detail --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Promotion Detail</label>
                        <textarea class="form-control" name="detail" rows="4" required placeholder="Promotion Detail">{{ old('detail') }}</textarea>
                        @if (isset($errors) && $errors->has('detail'))
                            <div class="text-danger small mt-1">{{ $errors->first('detail') }}</div>
                        @endif
                    </div>

                    {{-- Promotion Conditions --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Promotion Conditions</label>
                        <textarea class="form-control" name="conditions" rows="4" required placeholder="Promotion Conditions">{{ old('conditions') }}</textarea>
                        @if (isset($errors) && $errors->has('conditions'))
                            <div class="text-danger small mt-1">{{ $errors->first('conditions') }}</div>
                        @endif
                    </div>

                    {{-- Start Date --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">Start Date</label>
                        <input type="date" class="form-control" name="start_date" required
                            value="{{ old('start_date') }}">
                        @if (isset($errors) && $errors->has('start_date'))
                            <div class="text-danger small mt-1">{{ $errors->first('start_date') }}</div>
                        @endif
                    </div>

                    {{-- End Date --}}
                    <div class="mb-3">
                        <label class="form-label fw-bold">End Date</label>
                        <input type="date" class="form-control" name="end_date" required value="{{ old('end_date') }}">
                        @if (isset($errors) && $errors->has('end_date'))
                            <div class="text-danger small mt-1">{{ $errors->first('end_date') }}</div>
                        @endif
                    </div>

                    {{-- Buttons --}}
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary me-2">
                            <i class="fa-solid fa-plus me-1"></i> Insert Promotion
                        </button>
                        <a href="/promotion" class="btn btn-danger">
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
    const inputFile = document.getElementById('pro_pic');
    const previewDiv = document.getElementById('previewDiv');

    inputFile.addEventListener('change', function(event){
        const file = event.target.files[0];
        if(file){
            const reader = new FileReader();
            reader.onload = function(e){
                previewDiv.style.backgroundImage = `url('${e.target.result}')`;
            }
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection

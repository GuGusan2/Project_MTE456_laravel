@extends('layouts.member')

@section('content')

<style>
    /* 🎨 Global */
    body {
        font-family: 'Prompt', sans-serif;
        background-color: #fffaf5;
        color: #333;
        line-height: 1.6;
    }

    /* 🍴 Card Menu */
    .card {
        border: none;
        border-radius: 14px;
        transition: transform 0.3s, box-shadow 0.3s;
        background: #fff;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 20px rgba(0, 0, 0, 0.15);
    }
    .card img {
        border-top-left-radius: 14px;
        border-top-right-radius: 14px;
        height: 200px;          /* ✅ ความสูงรูปเท่ากัน */
        width: 100%;
        object-fit: cover;      /* ✅ ครอบพอดี */
    }
    .card-title {
        font-weight: 600;
        color: #222;
        font-size: 1.05rem;
    }
    .card-text {
        font-size: 0.9rem;
        color: #666;
    }

    /* 🟨 Buttons */
    .btn-danger {
        background-color: #e60026;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        transition: 0.3s;
    }
    .btn-danger:hover {
        background-color: #cc001f;
    }

    /* Section Title */
    h3 {
        font-weight: bold;
        margin-bottom: 25px;
        color: #222;
    }
</style>

<div class="container">

    <a href="{{ route('member.menu') }}" class="btn btn-secondary mb-4">
    ⬅ ย้อนกลับ
</a>


    <h3>⭐ เมนูโปรดของฉัน</h3>

    @if($favorites->isEmpty())
        <p>ยังไม่มีเมนูโปรด 😅</p>
    @else
        <div class="row">
            @foreach($favorites as $fav)
                <div class="col-md-4 mb-3">
                    <div class="card h-100 shadow-sm">
                        
                        <img src="{{ asset('storage/' . $fav->menu->menu_pic) }}" 
                        class="card-img-top menu-img" 
                        alt="{{ $fav->menu->menu_name }}">

                        <div class="card-body text-center">
                            <h5 class="card-title">{{ $fav->menu->menu_name }}</h5>
                            <p class="card-text">ราคา: {{ number_format($fav->menu->price,2) }} บาท</p>
                        </div>
                        <div class="card-footer text-center">
                            <form action="{{ route('member.removeFavorite', $fav->menu_id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm px-3">
                                    ลบออกจากเมนูโปรด
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection

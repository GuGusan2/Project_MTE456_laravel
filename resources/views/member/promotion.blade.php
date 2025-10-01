@extends('layouts.member')

@section('content')
<div class="container">
    <h2>🎁 โปรโมชั่น</h2>
    <div class="row">
        @foreach($promotions as $promo)
            <div class="col-md-4 mb-3">
                <div class="card h-100 shadow-sm">
                    @if($promo->promo_pic)
                        <img src="{{ asset('uploads/promotions/' . $promo->promo_pic) }}" 
                             class="card-img-top" 
                             alt="{{ $promo->promo_title }}">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $promo->promo_title }}</h5>
                        <p class="card-text">{{ $promo->promo_detail }}</p>
                    </div>
                    <div class="card-footer text-muted">
                        📅 {{ $promo->promo_start }} - {{ $promo->promo_end }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

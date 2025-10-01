@extends('layouts.user')

@section('content')
<div class="container text-center">
    <h2 class="fw-bold mb-4">📞 ติดต่อเรา</h2>
    <p>📍 ที่อยู่: กรุงเทพฯ ประเทศไทย</p>
    <p>📧 อีเมล: example@gmail.com</p>
    <p>📱 โทร: 099-999-9999</p>

    {{-- Google Map Embed --}}
    <div class="mt-4">
        <iframe src="https://www.google.com/maps/embed?pb=..."
            width="100%" height="300" style="border:0;" allowfullscreen=""
            loading="lazy"></iframe>
    </div>
</div>
@endsection

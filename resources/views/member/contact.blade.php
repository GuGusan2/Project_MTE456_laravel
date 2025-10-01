@extends('layouts.member')

@section('content')
<div class="container">
    <h2>📞 ติดต่อเรา</h2>
    <p>ที่อยู่: 123 ถนนหลัก เขตเมือง</p>
    <p>โทร: 02-123-4567</p>
    <p>อีเมล: contact@furryfriends.com</p>

    <form action="#" method="POST">
        @csrf
        <div class="mb-3">
            <label>ชื่อของคุณ</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>อีเมล</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>ข้อความ</label>
            <textarea name="message" class="form-control" rows="4" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">ส่งข้อความ</button>
    </form>
</div>
@endsection

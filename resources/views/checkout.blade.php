@extends('layout')
@section('title')
    Giỏ hàng | Techchain
@endsection
@section('content')
    <form action="" method="post">
        @csrf
        <div class="b-3">
            <label for="">Fullname</label>
            <input type="text" name="fullname" id="">
        </div>
        <div class="b-3">
            <label for="">Phone</label>
            <input type="text" name="phone" id="">
        </div>
        <div class="b-3">
            <label for="">Address</label>
            <input type="text" name="address" id="">
        </div>
        <div class="b-3">
            <label for="">Email</label>
            <input type="email" name="email" id="">
        </div>
        <div class="b-3">
            <button type="submit" class="btn btn-primary">Checkout</button>
        </div>
    </form>
@endsection
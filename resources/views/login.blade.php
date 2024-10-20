@extends('app')
@section('title')
    ログイン画面
@endsection
@section('content')
    <form action="{{route("check")}}" method="POST">
        @csrf
        ID: <input type="text" name="name">
        pass: <input type="text" name="password">
        <button>送信</button>
    </form>
    @error('message')
        <p style="color: red">{{$message}}</p>
    @enderror
@endsection
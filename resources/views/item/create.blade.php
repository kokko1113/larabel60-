@extends('app')
@section('title')
    商品登録画面
@endsection
@section('content')
    <form action="{{route("item_store")}}" method="POST">
        @csrf
        name: <input type="text" name="name">
        price: <input type="number" name="price">
        <button>登録</button>
    </form>
    
    <a href="{{route("dash")}}"><button>戻る</button></a>

    @if (session("message"))
        <p style="color: orange">{{session("message")}}</p>
    @endif

    @if ($errors->any())
        <p style="color: red">{{$errors->first()}}</p>
    @endif
@endsection
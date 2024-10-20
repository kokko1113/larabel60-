@extends('app')
@section('title')
    商品編集画面
@endsection
@section('content')
    <form action="{{ route('item_update',$item->id) }}" method="POST">
        @csrf
        @method("patch")
        name: <input type="text" name="name" value="{{$item->name}}">
        price: <input type="number" name="price" value="{{$item->price}}">
        <button>保存</button>
    </form>

    <a href="{{ route('dash') }}"><button>戻る</button></a>

    @if (session('message'))
        <p style="color: orange">{{ session('message') }}</p>
    @endif

    @if ($errors->any())
        <p style="color: red">{{ $errors->first() }}</p>
    @endif
@endsection

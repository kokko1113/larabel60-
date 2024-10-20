@extends('app')
@section('title')
    セットメニュー登録画面
@endsection
@section('content')
    <form action="{{route("setmenu_store")}}" method="POST">
        @csrf
        item_name:
        <select name="item_name[]" id="" multiple>
            @foreach ($items as $item)
                <option value="{{$item->name}}">{{$item->name}}</option>
            @endforeach
        </select>
        name: <input type="text" name="name">
        <button>登録</button>
    </form>
    
    <a href="{{route("setmenu_index")}}"><button>戻る</button></a>

    @if (session("message"))
        <p style="color: orange">{{session("message")}}</p>
    @endif

    @if ($errors->any())
        <p style="color: red">{{$errors->first()}}</p>
    @endif
@endsection
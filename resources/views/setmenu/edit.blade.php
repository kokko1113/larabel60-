@extends('app')
@section('title')
    セットメニュー編集画面
@endsection
@section('content')
    <form action="{{ route('setmenu_update',$relation->setmenu->id) }}" method="POST">
        @csrf
        @method("patch")
        item_name:
        <select name="item_name" id="">
            @foreach ($items as $item)
                <option {{$item->name==$relation->item->name?"selected":""}}
                value="{{ $item->name }}">{{ $item->name }}</option>
            @endforeach
        </select>
        name: <input type="text" name="name" value="{{$item->name}}">
        <button>保存</button>
    </form>

    <a href="{{ route('setmenu_index') }}"><button>戻る</button></a>

    @if (session('message'))
        <p style="color: orange">{{ session('message') }}</p>
    @endif

    @if ($errors->any())
        <p style="color: red">{{ $errors->first() }}</p>
    @endif
@endsection

@extends('app')
@section('title')
    セットメニュー一覧
@endsection
@section('content')
    <a href="{{route("setmenu_create")}}"><button>新規登録</button></a>
    <a href="{{route("dash")}}"><button>戻る</button></a>

    <table border="1">
        <tr>
            <th>id</th>
            <th>name</th>
            <th>item_name</th>
            <th></th>
            <th></th>
        </tr>
        @foreach ($items as $item)
            <tr>
                <td>{{$item->setmenu_id}}</td>
                <td>{{$item->setmenu->name}}</td>
                <td>{{$item->item->name}}</td>
                <td><a href="{{route("setmenu_edit",$item->id)}}"><button>編集</button></a></td>
                <td>
                    <form action="{{route("setmenu_destroy",$item->id)}}" method="POST">
                        @csrf
                        @method("delete")
                        <button onclick="confirm('本当に削除しますか')">削除</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
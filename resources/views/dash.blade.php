@extends('app')
@section('title')
    ログイン画面
@endsection
@section('content')
    <a href="{{ route('logout') }}"><button>logout</button></a>
    <a href="{{ route('item_create') }}"><button>商品新規登録</button></a>
    <a href="{{ route('setmenu_index') }}"><button>セットメニュー一覧</button></a>

    <table border="1">
        <tr>
            <th>id</th>
            <th>shop_id</th>
            <th>name</th>
            <th>price</th>
            <th></th>
            <th></th>
        </tr>
        @foreach ($items as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->shop_id }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->price }}</td>
                <td><a href="{{ route('item_edit', $item->id) }}"><button>編集</button></a></td>
                <td>
                    <form action="{{ route('item_destroy', $item->id) }}" method="POST">
                        @csrf
                        @method('delete')
                        <button onclick="confirm('本当に削除しますか')">削除</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection

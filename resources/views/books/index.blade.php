@extends('layouts.app')

@section('content')
    <h2 class="txt_center title">書籍一覧</h2>
    <div class="main_content">
        <button class="button is-success member_span" onclick="location.href='{{route('books.create')}}'" >＋資料登録</button>
    <form action="{{route('books.index')}}" method="get">
        @include('books.search')
        <button type="submit">検索</button>
    </form>
    </div>
    <table class="table_center margin-top">
        <thead>
            <tr>
                <th>ISBN番号</th>
                <th>タイトル</th>
                <th>著者名</th>
                <th>分類コード</th>
                <th>在庫数</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($books as $book)
               <tr>
                <td>{{$book->isbn}}</td>
                <td>
                    <a href="{{route('books.show',$book->id)}}">
                        {{$book->title}}</a> 
                </td>
                <td>{{$book->author}}</td>
                <td>{{$book->category_id}}({{$book->category->name}})</td>
                <td>1/3</td>
            </tr> 
            @endforeach
        </tbody>
    </table>
    {{$books -> appends(Request::all())->links()}}
</div>
    
@endsection
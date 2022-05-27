@extends('layouts.app')

@section('content')
<h2 class="txt_center title">書籍一覧</h2>
<!-- フラッシュメッセージ -->
<div class="flash_message">
    {{ session('flash_message') }}
</div>
<div class="main_content">
    <div class="book_div">
        {{-- 書籍登録ボタン --}}
        <button class="button is-success book_span" onclick="location.href='{{route('books.create')}}'" >＋書籍登録</button>
    </div>   
        <form action="{{route('books.index')}}" method="get">
        @include('books.search')
        {{-- 検索ボタン --}}
        <button type="submit" class="button is-primary page_button">検索</button>
        </form>
    

    <table class="table_center margin-top margin-bottom">
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
                <td>{{$count_inv[$book->id]->count()}}/{{ $book->inventories->count()}}</td>
            </tr> 
            @endforeach
        </tbody>
    </table>
    
    {{$books -> appends(Request::all())->links()}}
    
</div>
    
@endsection
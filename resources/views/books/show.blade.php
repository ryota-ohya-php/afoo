@extends('layouts.app')

@section('content')
<form action="{{ route('inventories.create') }}" method="get">
    <input type="hidden" name="book_id" value="{{ $book->id }}">
    <button type="submit">在庫登録</button>
</form>
    <h1>書籍詳細</h1>
    <dl>
        <dt>ISBN番号</dt>
        <dd>{{$book->isbn}}</dd>
        <dt>タイトル</dt>
        <dd>{{$book->title}}</dd>
        <dt>著者</dt>
        <dd>{{$book->author}}</dd>
        <dt>カテゴリーID</dt>
        <dd>{{$book->category_id}}</dd>
        <dt>出版社</dt>
        <dd>{{$book->publisher}}</dd>
        <dt>出版日</dt>
        <dd>{{$book->published_at}}</dd>
        <dt>在庫数</dt>
        <dd>2</dd>
    </dl>

    <a href="{{route('books.edit',$book)}}">編集する</a>
    <a href="#" onclick="deleteBook()">削除する</a>
        <form action="{{route('books.destroy',$book)}}" method="POST" id="delete-form">
            @csrf
            @method('delete')
        </form>
        <script>
            function deleteBook() {
                event.preventDefault();
                if (window.confirm('本当に削除しますか？')) {
                    document.getElementById('delete-form').submit();
                }
            }
        </script>
@endsection
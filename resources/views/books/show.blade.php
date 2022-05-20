@extends('layouts.app')

@section('content')
    <form action="">+在庫登録</form>
    <h1>書籍詳細</h1>
    <dl>
        <dt>ISBN番号</dt>
        <dd>0000000000001</dd>
        <dt>タイトル</dt>
        <dd>test</dd>
        <dt>著者</dt>
        <dd>おおや</dd>
        <dt>カテゴリーID</dt>
        <dd>9</dd>
        <dt>出版社</dt>
        <dd>A社</dd>
        <dt>出版日</dt>
        <dd>2022/5/19</dd>
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
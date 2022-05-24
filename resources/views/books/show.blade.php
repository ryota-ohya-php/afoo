@extends('layouts.app')

@section('content')


</form>

<div class="main_content">
    <div class="book_div">
        <h2 class="title txt_center">書籍詳細</h2>
      
        {{-- 在庫登録ボタン --}}
        <form action="{{ route('inventories.create') }}" method="get">
            <input type="hidden" name="book_id" value="{{ $book->id }}">
            <button type="submit" class="button is-success book_span">＋在庫登録</button>
        </form>
        
         {{-- 書籍イメージ --}}
        <div class="block">
            <p id="book_img"></p>
        </div>

        {{-- 書籍詳細情報 --}}
        <div class="block">
            <div class="info_dl">
                <dl>
                    <dt>ISBN番号</dt>
                    <dd id="isbn">{{$book->isbn}}</dd>
                    <dt>タイトル</dt>
                    <dd>{{$book->title}}</dd>
                    <dt>著者</dt>
                    <dd>{{$book->author}}</dd>
                    <dt>カテゴリーID</dt>
                    <dd>{{$book->category_id}}</dd>
                    <dt>出版社</dt>
                    <dd>{{$book->publisher}}</dd>
                    <dt>出版日</dt>
                    <dd>{{$book->published_date}}</dd>
                    <dt>在庫数</dt>
                    <dd>{{ $book->inventories->count() }}</dd>
                </dl>
            </div>
        </div>
    </div>

    <div class="block">
        {{-- 書籍一覧画面に戻るボタン --}}
        <button class="button is-primary mamber_button" 
            onclick="location.href='{{ route('books.index') }}'">書籍一覧画面に戻る</button>
        {{-- 編集ボタン --}}
        <button class="button is-link mamber_button" 
            onclick="location.href='{{ route('books.edit',$book)}}'">編集する</button>
    </div>
    {{-- 削除ボタン --}}
    <div class="block">
        <form action="{{route('books.destroy',$book)}}" method="POST" id="delete-form">
            @csrf
            @method('delete')
            <button class="mamber_button button is-danger" onclick="deleteBook()">削除する</button>
        </form>
        <script>
            function deleteBook() {
                event.preventDefault();
                if (window.confirm('本当に削除しますか？')) {
                    document.getElementById('delete-form').submit();
                }
            }
        </script>
    </div>

    <script>
        // この関数でisbn番号からデータ取得して代入
        $(function() {
            $('#getBookInfo').ready( function( e ) {
                // e.preventDefault();
                // 定数isbnにidがisbnのvalueを代入している
                // console.log($("#isbn").val())
                const isbn = $("#isbn").text();
                // isbn番号をopenbd(webapi)にgetで送信するurl
                const url = "https://api.openbd.jp/v1/get?isbn=" + isbn;
    
                // isbn番号に対するレスポンスがdata[0]に入っている
                $.getJSON( url, function( data ) {
                    if( data[0].summary.cover == "" ){
                        $("#book_img").html('<img src=\"\" />');
                    } else {
                        $("#book_img").html('<img src=\"' + data[0].summary.cover + '\" style=\"border:solid 1px #000000\" />');
                    }
                });
            });
        });
        
    </script>
@endsection
</div>
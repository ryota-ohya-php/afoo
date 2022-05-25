@extends('layouts.app')

@section('content')
<h2 class="title txt_center">書籍の新規登録</h2>
@include('commons/flash')
    <div class="main_content">
        <div class="block">
            <form action="{{route('books.confirm-create')}}" method="POST">
                @include('books.form')
                {{-- 一覧画面に戻るボタン --}}
                <button type="button" class="button is-primary page_button"
                onclick="location.href='{{ route('books.index')}}'">書籍一覧画面に戻る</button>
                {{-- 入力確認ボタン --}}
                <button type="submit" class="page_button button is-warning">入力確認する</button>
            </form>
        </div>
    <!-- 分類コードの一覧表 -->
        <div class="ndc">
            <img src="/imgs/ndccode.png" /><p>出典：公共社団法人 日本図書館協会</p>
        </div>
    </div>
@endsection
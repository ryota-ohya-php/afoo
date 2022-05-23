@extends('layouts.app')

@section('content')
<h2 class="title txt_center">書籍登録</h2>
    <div class="main_content">
        <form action="{{route('books.confirm-create')}}" method="POST">
            @include('books.form')
            <button type="submit">登録確認する</button>
        </form>
    <!-- 分類コードの一覧表 -->
        <div class="ndc">
            <img src="/imgs/ndccode.png" /><p>出典：公共社団法人 日本図書館協会</p>
        </div>
    </div>
@endsection
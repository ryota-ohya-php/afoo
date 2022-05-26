@extends('layouts.app')

@section('content')
<h2 class="title txt_center">入力確認</h2>
    <div class="main_content">
        <!-- 入力情報表示 -->
        @include('books.confirm-text')
        <form action="{{route('books.store')}}" method="post">
            @csrf
            @include('books.confirm-hidden')
                <!-- ボタン -->
                <button type="button" class="button is-primary page_button"onclick="history.back()">登録画面に戻る</button>
                <button type="submit" class="page_button button is-success">登録する</button>
        </form>
    </div>
@endsection
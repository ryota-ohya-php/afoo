@extends('layouts.app')

@section('content')
    <h2 class="title txt_center">書籍情報の編集</h2>
    <div class="main_content">
        @include('commons/flash')       
        <form action="{{ route('books.confirm-edit',$book->id)}}" method="POST">
            @include('books.form')
            <!-- ボタン -->
            <button type="button" class="page_button button is-primary" onclick="history.back()">書籍詳細画面に戻る</button>
            <button type="submit" class="page_button button is-warning">入力確認する</button>
        </form>
    </div>
@endsection
@extends('layouts.app')

@section('content')
    <h2 class="title txt_center">書籍情報の編集</h2>
@include('commons/flash')
    <div class="main_content">
        <form action="{{ route('books.confirm-edit',$book->id)}}" method="POST">
            @include('books.form')
            {{-- 詳細画面に戻るボタン --}}
            <button type="button" class="page_button button is-primary"
            onclick="history.back()">書籍詳細画面に戻る</button>
            {{-- 入力確認ボタン --}}
            <button type="submit" class="page_button button is-warning">入力確認する</button>
        </form>
    </div>
@endsection
@extends('layouts.app')

@section('content')
<h2 class="title txt_center">入力確認</h2>
    <div class="main_content">
        {{-- 入力情報表示 --}}
        @include('books.confirm-text')

        <form action="{{route('books.store')}}" method="post">
            @csrf

            @include('books.confirm-hidden')
            {{-- 登録画面に戻るボタン --}}
            <button type="button" class="button is-primary mamber_button"
                    onclick="history.back()">登録画面に戻る</button>
            {{-- 登録ボタン --}}
            <button type="submit" class="mamber_button button is-success">登録する</button>
        </form>

    </div>
@endsection
@extends('layouts.app')

@section('content')
<h2 class="title txt_center">登録確認画面</h2>
    <div class="main_content">
        @include('books.confirm-text')
            <form action="{{route('books.store')}}" method="post">
                @csrf
                @include('books.confirm-hidden')
                <button type="submit">登録する</button>
            </form>
    </div>
@endsection
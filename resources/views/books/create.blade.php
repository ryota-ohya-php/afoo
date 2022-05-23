@extends('layouts.app')

@section('content')
<h2 class="title txt_center">書籍登録</h2>
    <div class="main_content">
    <form action="{{route('books.confirm-create')}}" method="POST">
        @include('books.form')
        <button type="submit">登録確認する</button>
    </form>
    </div>
@endsection
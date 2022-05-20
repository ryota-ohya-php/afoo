@extends('layouts.app')

@section('content')
<h2 class="title txt_center">書籍登録</h2>
    <div class="main_content">
    <form action="{{route('books.store')}}" method="POST">
        @include('books.form')
        <button type="submit">登録する</button>
    </form>
    </div>
@endsection
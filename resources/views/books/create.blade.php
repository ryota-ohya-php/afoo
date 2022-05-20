@extends('layouts.app')

@section('content')
    <h1>資料登録</h1>
    <form action="{{route('books.store')}}" method="POST">
        @include('books.form')
        <button type="submit">登録する</button>
    </form>
@endsection
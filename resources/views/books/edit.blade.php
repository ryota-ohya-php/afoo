@extends('layouts.app')

@section('content')
    <h1>資料編集画面</h1>
    <form action="{{ route('books.update',$book->id)}}" method="POST">
        @method('patch')
        @include('books.form')
        <button type="submit">更新</button>
    </form>
@endsection
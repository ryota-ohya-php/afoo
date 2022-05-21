@extends('layouts.app')

@section('content')
    <h2 class="title txt_center">資料編集画面</h2>
    <div class="main_content">
        <form action="{{ route('books.confirm-edit',$book->id)}}" method="POST">
            @include('books.edit-form')
            <button type="submit">編集確認する</button>
        </form>
    </div>
@endsection
@extends('layouts.app')

@section('content')
<h2 class="title txt_center">編集確認画面</h2>
    <div class="main_content">
        @include('books.confirm-text')
            <form action="{{route('books.update',$request->book_id)}}" method="post">
                @csrf
                @method('patch')
                @include('books.confirm-hidden')
                <button type="submit">編集する</button>
            </form>
    </div>
@endsection
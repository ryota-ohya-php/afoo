@extends('layouts.app')

@section('content')
<div class="main_content">
<h1>会員の新規登録</h1> 
     <form action="{{route('members.confirm')}}" method="post">
        @include('members/form')

    </form>
<hr>
<a href="/">戻る</a>
@endsection
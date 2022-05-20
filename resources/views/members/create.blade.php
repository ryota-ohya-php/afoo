@extends('layouts.app')

@section('content')

<h1>会員の新規登録</h1> 
{{-- 会員の新規登録フォーム --}}
    <form action="{{ route('members.store') }}" method="post">
    @csrf
    @include('members/form')
</form>

<hr>
<a href="/">戻る</a>
@endsection
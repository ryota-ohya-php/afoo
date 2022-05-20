{{-- レイアウト挿入 --}}
@extends('layouts.app')

@section('content')

<h1>会員情報の編集</h1> 

<form action="{{route('members.confirm')}}" method="post">
    @include('members/form')
</form>
    <!--{{-- <form action="{{ route('members.update') }}" method="post"> --}}
    {{-- @csrf --}}
    {{-- @method('patch') --}}

        <dl>
            <dt><label>会員ID</dt>
            <dd>
                <input type="text" name="member_id"></label>
            </dd>
            <dt><label>会員名</dt>
            <dd>
                <input type="text" name="name"></label>
            </dd>
            <dt><label>住所</dt>
            <dd>
                <input type="text" name="address"></label>
            </dd>
            <dt><label>電話番号</dt>
            <dd>
                <input type="tel" name="tel"></label>
            </dd>
            <dt><label>生年月日</dt>
            <dd>
                <input type="date" name="birthday"></label>
            </dd>
            <dt><label>メールアドレス</dt>
            <dd>
                <input type="email" name="email"></label>
            </dd>
        </dl>
        <button type ="submit">登録する</button>

{{-- </form> --}}-->

<hr>
<a href="/">戻る</a>
@endsection
@extends('layouts.app')

@section('content')

<h2 class="txt_center title">入力確認画面</h2>
    <div class="main_content">
        <dl>
            <!--<dt>会員ID</dt>
            <dd>{{--$request->member_id--}}</dd>-->
            <dt>会員名</dt>
            <dd>{{$request->name}}</dd>
            <dt>住所</dt>
            <dd>{{$request->address}}</dd>
            <dt>電話番号</dt>
            <dd>{{$request->tel}}</dd>
            <dt>生年月日</dt>
            <dd>{{$request->birthday}}</dd>
            <dt>メールアドレス</dt>
            <dd>{{$request->email}}</dd>
        </dl>

    <form action="{{($request->confirm == 'create') ? route('members.store') : route('members.update',$request->member_id);}}" method="post">
        @csrf

        @if($request->confirm != 'create')
        
        @method('patch')

        @endif

        <input type="hidden" name="member_id" value="{{$request->member_id}}">
        <input type="hidden" name="name" value="{{$request->name}}">
        <input type="hidden" name="address" value="{{$request->address}}">
        <input type="hidden" name="tel" value="{{$request->tel}}">
        <input type="hidden" name="birthday" value="{{$request->birthday}}">
        <input type="hidden" name="email" value="{{$request->email}}">
        <button type ="submit">登録する</button>
    </form>
</div>
@endsection
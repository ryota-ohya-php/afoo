@extends('layouts.app')

@section('content')

<h2 class="txt_center title">入力確認</h2>
<div class="main_content">
    <div class="info_dl">
        <dl>
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
    </div>
    <div class="member_form">
        <div class="sub_block">
            @if($request->confirm == 'create')
                {{-- 新規登録の時：登録画面に戻るボタン --}}
                <button class="button is-primary mamber_button"
                onclick="location.href='{{ route('members.create')}}';history.back()">登録画面に戻る</button>
            @else
                {{-- 編集の時：編集画面に戻るボタン --}}
                <button class="button is-primary mamber_button"
                onclick="location.href='{{ route('members.edit', $request->member_id)}}'">編集画面に戻る</button>
            @endif

        </div>
        <div class="sub_block">
            <form action="{{($request->confirm == 'create') ? route('members.store') : route('members.update',$request->member_id);}}" method="post">
                @csrf

                @if($request->confirm != 'create')
                
                @method('patch')

                @endif

                <input type="hidden" name="member_id" value="{{$request->member_id}}">
                <input type="hidden" name="name"      value="{{$request->name}}">
                <input type="hidden" name="address"   value="{{$request->address}}">
                <input type="hidden" name="tel"       value="{{$request->tel}}">
                <input type="hidden" name="birthday"  value="{{$request->birthday}}">
                <input type="hidden" name="email"     value="{{$request->email}}">
                {{-- 登録ボタン --}}
                <button type ="submit" class="mamber_button button is-success">登録する</button>
            </form>
        </div>
    </div>
</div>
@endsection
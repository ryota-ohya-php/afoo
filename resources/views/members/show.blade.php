{{-- レイアウト挿入 --}}
@extends('layouts.app')

@section('content')


<h2 class="title txt_center">会員詳細</h2>
<div class="main_content">
<dl>
    <dt>会員ID</dt>
    <dd>{{$member->id}}</dd>
    <dt>会員名</dt>
    <dd>{{$member->name}}</dd>
    <dt>住所</dt>
    <dd>{{$member->address}}</dd>
    <dt>電話番号</dt>
    <dd>{{$member->tel}}</dd>
    <dt>生年月日</dt>
    <dd>{{$member->birthday}}</dd>
    <dt>メールアドレス</dt>
    <dd>{{$member->email}}</dd>
</dl>


<a href ="{{route('members.edit',$member->id)}}">編集する</a>

<form action="{{route('members.destroy',$member->id)}}" method="post">

    @csrf
    @method('delete')
    <button type="submit" class="mamber_button button is-warning">削除する</button>
</form>

<hr>
<a href="/">戻る</a>
</div>
@endsection
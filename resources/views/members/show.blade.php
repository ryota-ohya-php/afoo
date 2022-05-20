{{-- レイアウト挿入 --}}
@extends('layouts.app')

@section('content')

<h1>会員詳細</h1>
{{-- 会員情報表示 --}}
<dl>
    <dt>会員ID</dt>
    <dd>0000‐0000</dd>
    <dt>会員名</dt>
    <dd>山田太郎</dd>
    <dt>住所</dt>
    <dd>東京都新宿区○○町△‐×</dd>
    <dt>電話番号</dt>
    <dd>000‐0000‐0000</dd>
    <dt>生年月日</dt>
    <dd>1995/1/1</dd>
    <dt>メールアドレス</dt>
    <dd>laravel@pp.jp</dd>
</dl>

{{-- 編集ボタン --}}
<a href ="{{ route(membres.edit) }}">編集する</a>

{{-- 削除ボタン --}}
<form action="{{ route('members.destroy', $member->id) }}" method="post">
    @csrf
    @method('delete')
    <button type="submit">削除する</button>
</form>

<hr>
<a href="/">戻る</a>
@endsection
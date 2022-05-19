@extends('layouts.app')

@section('content')

<h1>会員詳細</h1>

<p>会員ID：0000‐0000</p>
<p>会員名：山田太郎</p>
<p>住所：東京都新宿区○○町△‐×</p>
<p>電話番号：000‐0000‐0000</p>
<p>生年月日：1995/1/1</p>
<p>メールアドレス：</p>

<a href ="">編集する</a>
<form action="" method="post">
    @csrf
    @method('delete')
    <button type="submit">削除する</button>
</form>

<a href="/">戻る</a>
@endsection
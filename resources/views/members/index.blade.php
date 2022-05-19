@extends('layouts.app')

@section('content')

<h1>会員一覧</h1>

<form action="" method="get">
    <p>
        <label>キーワード</label>
        <input type="text" name="keyword" value="">
        <button type="submit">検索</button>
    </p>
</form>
    
    <h1><a href="">＋会員登録</a></h1>
    
    <table border="1">
        <thead>
            <tr>
                <th>会員ID</th>
                <th>会員名</th>
                <th>電話番号</th>
            </tr>
        </thead>
        <tbody> 
            <tr>
                <td>0000‐0000</td>
                <td><a>山田太郎</a></td>
                <td>000‐0000‐0000</td>
            </tr>
        </tbody>
<hr>
<a href="/">戻る</a>
@endsection

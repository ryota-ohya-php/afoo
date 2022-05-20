{{-- レイアウト挿入 --}}
@extends('layouts.app')

@section('content')

<h1>会員一覧</h1>
{{-- 会員検索 --}}
<form action="{{ route(members.index) }}" method="get">
    <p>
        <label>キーワード</label>
        <input type="text" name="keyword" value="">
        <button type="submit">検索</button>
    </p>
</form>

   {{--会員登録--}}
    <p><a href="{{ route('members.create') }}">＋会員登録</a></p>
   
    {{-- 会員一覧表示 --}}
    <table border="1">
        <thead>
            <tr>
                <th>会員ID</th>
                <th>会員名</th>
                <th>電話番号</th>
            </tr>
        </thead>
        <tbody> 
            @foreach($members as $member)
            <tr>
                <td>0000‐0000</td>
                <td><a href="/members/{{ $member-> id }}">
                    {{ $members-> name }}</a></td>
                <td>000‐0000‐0000</td>
            </tr>
        </tbody>
<hr>
<a href="/">戻る</a>
@endsection

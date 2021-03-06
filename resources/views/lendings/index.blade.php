<!-- layouts.appのテンプレート取得-->
@extends('layouts.app')

<!-- body内の記述スタート-->
@section('content')
<h2 class="txt_center title">貸出一覧画面</h2>
<!-- フラッシュメッセージ -->
<div class="flash_message">
    {{ session('flash_message') }}
</div>
<div class="main_content">
    <div class="book_div">
        {{-- 書籍登録ボタン --}}
        <button class="button is-success book_span" onclick="location.href='{{route('lendings.create')}}'" style="margin-bottom: 10px">貸出手続きをする</button>
        <button class="button is-success book_span" onclick="location.href='{{route('lendings.rebook')}}'" style="margin-bottom: 10px">返却手続きをする</button>
    </div>
    <!--貸出検索-->
    <form action="{{route('lendings.index')}}" method="get">
        {{-- 検索フォーム --}}
        <div class="field">
            <label class="label">キーワード</label>
            {{-- 検索ボタン --}}
            <div class="control">
                <input type="text" name="keyword" class="input form-sizing">
                    <button type="submit" class="button is-primary lending_search-button">
                        検索する
                    </button>
            </div>
        </div>
    </form>

    <!--貸出一覧表示-->
    <table class="table_center">
        <thead>
            <tr>
                <th>会員ID</th>
                <th>資料名</th>
                <th>著者名</th>
                <th>貸出日</th>
                <th>期限日</th>
            </tr>
        </thead>
        <tbody>
            @foreach($lending as $lend)
            <tr>
                <td>{{$lend->member_id}}<br>
                在庫ID{{$lend->inventory_id}}</td>
                <td>{{$lend->title}}</td>
                <td>{{$lend->author}}</td>
                <td>{{$lend->lent_date}}</td>
                <td>{{$lend->due_date}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
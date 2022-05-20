<!-- layouts.appのテンプレート取得-->
@extends('layouts.app')

<!-- body内の記述スタート-->
@section('content')
<h2 class="txt_center title">貸出登録画面</h2>
<div class="main_content">
    <!--貸出検索-->
    <form action="{{route('lendings.confirm')}}" method="post">
        @csrf
        <dl class="lending_dl margin-bottom">
            <dt>
                会員ID
            </dt>
                <dd>    
                    <input type="number" name="member_id" class="lending_inp">
                </dd>
            <dt>
                在庫ID
            </dt>
                <dd> 
                    <input type="number" name="title" class="lending_inp">
                </dd>
            <dt>
                貸出日
            </dt>
                <dd> 
                    <input type="date" name="lent_date" value="{{date('Y-m-j')}}" class="lending_inp">
                </dd>
            <dt>
                備考
            </dt>
                <dd> 
                    <input type="text" name="remarks" class="lending_inp">
                </dd>
        </dl>
        <button type="submit" class="button is-warning">入力確認画面へ</button>
    </form>
</div>
@endsection
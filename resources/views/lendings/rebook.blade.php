<!-- layouts.appのテンプレート取得-->
@extends('layouts.app')

<!-- body内の記述スタート-->
@section('content')
<h2 class="txt_center title">返却画面</h2>
<div class="main_content">
    <!--貸出検索-->
    <form action="{{route('lendings.confirm')}}" method="post" id="form_submit">
        @include('lendings/returnform')
    </form>
</div>
@endsection
<!-- layouts.appのテンプレート取得-->
@extends('layouts.app')

<!-- body内の記述スタート-->
@section('content')
<h2 class="txt_center title">貸出画面</h2>
<div class="main_content">
    @include('commons/flash')  
    <!--貸出検索-->
    <form action="{{route('lendings.confirm')}}" method="post" onsubmit="return nosubmit()">
        @include('lendings/lendform')
    </form>
</div>
@endsection
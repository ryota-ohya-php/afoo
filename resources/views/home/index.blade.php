<!-- layouts.appのテンプレート取得-->
@extends('layouts.app')

<!-- body内の記述スタート-->
@section('content')

<div class="main_content">
    <button class="button is-primary is-large">予約</button>
    <button class="button is-success is-large">貸出</button>
    <button class="button is-danger is-large">返却</button>
</div>

<!-- body内の記述エンド-->
@endsection
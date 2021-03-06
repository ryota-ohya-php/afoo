{{-- レイアウト挿入 --}}
@extends('layouts.app')

@section('content')

<div class="main_content">
    <h2 class="title txt_center">会員情報の編集</h2>
        <!-- フラッシュメッセージ -->
        <div class="flash_message">
            {{ session('flash_message') }}
        </div>
    <div class="member_div"> 
            @include('commons/flash')   
        <form action="{{route('members.confirm')}}" method="post">
            @include('members/form')
        </form>
</div>
@endsection
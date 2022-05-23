{{-- レイアウト挿入 --}}
@extends('layouts.app')

@section('content')

<div class="main_content">
    <h2 class="title txt_center">会員情報の編集</h2> 

        <form action="{{route('members.confirm')}}" method="post">
            @include('members/form')
        </form>
    
    <hr>
    <a href="/">戻る</a>
</div>
@endsection
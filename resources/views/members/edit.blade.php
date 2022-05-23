{{-- レイアウト挿入 --}}
@extends('layouts.app')

@section('content')

<h2 class="title txt_center">会員情報の編集</h2> 

<form action="{{route('members.confirm')}}" method="post">
    @include('members/form')
</form>

{{-- 会員詳細画面に戻る --}}
{{-- <div class="block"> --}}
   {{-- <button class="button is-primary mamber_button" --}}
        {{-- onclick="location.href='{{ route('members.show', $member->id) }}'">会員詳細画面に戻る</button> --}}
{{-- </div> --}}
   
<hr>
<a href="/">戻る</a>
@endsection
{{-- レイアウト挿入 --}}
@extends('layouts.app')

@section('content')


<h2 class="title txt_center">会員詳細</h2>
<div class="main_content">
    <div class="info_dl">
        <dl>
            <dt>会員ID</dt>
            <dd>{{$member->id}}</dd>
            <dt>会員名</dt>
            <dd>{{$member->name}}</dd>
            <dt>住所</dt>
            <dd>{{$member->address}}</dd>
            <dt>電話番号</dt>
            <dd>{{$member->tel}}</dd>
            <dt>生年月日</dt>
            <dd>{{$member->birthday}}</dd>
            <dt>メールアドレス</dt>
            <dd>{{$member->email}}</dd>
        </dl>
    </div>

    <div class="block">
        <button class="button is-primary mamber_button" 
        onclick="location.href='{{ route('members.index') }}'">会員一覧画面に戻る</button>

        <button class="button is-link mamber_button" 
        onclick="location.href='{{ route('members.edit', $member->id)}}'">編集する</button>
    </div>

    <div class="block">
        <form action="{{route('members.destroy',$member->id)}}" method="post" id="delete-form">

            @csrf
            @method('delete')
            <button type="submit" class="mamber_button button is-danger">削除する</button>
        </form>
        <script>
            function deleteBook() {
                event.preventDefault();
                if (window.confirm('本当に削除しますか？')) {
                    document.getElementById('delete-form').submit();
                }
            }
        </script>
    </div>
<hr>
<a href="/">戻る</a>
</div>
@endsection
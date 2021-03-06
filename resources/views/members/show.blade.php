{{-- レイアウト挿入 --}}
@extends('layouts.app')

@section('content')


<h2 class="title txt_center">会員詳細</h2>
<div class="main_content">
    <!-- フラッシュメッセージ -->
    <div class="flash_message">
            {{ session('flash_message') }}
    </div>
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
        {{-- 会員一覧画面に戻る --}}
        <button class="button is-primary mamber_button" 
        onclick="location.href='{{ route('members.index') }}'">会員一覧画面に戻る</button>

        {{-- 編集ボタン  --}}
        <button class="button is-link mamber_button" 
        onclick="location.href='{{ route('members.edit', $member->id)}}'">この会員を編集する</button>
    </div>

    <form action="{{route('members.destroy',$member->id)}}" method="post" id="delete-form">
        @csrf
        @method('delete')
        {{-- 会員情報削除ボタン --}}
        <button class="button is-danger" onclick="deleteMember()">この会員を削除する</button>
    </form>
    <script type="text/javascript">
        function deleteMember() {
            event.preventDefault();
            if (window.confirm('本当に削除しますか？')) {
                document.getElementById('delete-form').submit();
            }
        }
    </script>
    <button class="lend_click button is-secondary" style="margin-top: 10px">貸出状況を見る</button>
</div>

<div class="section">
    <h2 class="title txt_center">{{$member->name}}(会員ID:{{$member->id}})様の貸出状況</h2>
    <table class="table_center" style="width:700px" >
        <thead>
            <tr>
                <th>本のタイトル</th>
                <th>返却期限日</th>
                {{-- <th>貸出期限日</th> --}}
            </tr>
            @foreach ($lendinfo as $lend)
            <tr>
                <td>{{$lend->title}}</td>
                <td>{{$lend->due_date}}</td>
            </tr>
            @endforeach
        </thead>
    </table>

</div>
@if ($lendinfo->count())
    <div class="main_content">
    <button class="button top_button is-success is-small sectionn" style="font-size:20px" onclick="location.href='http://localhost:8000/lendings/create?member_id={{$member->id}}'">本を貸し出す</button>
    <!--<button class="button top_button is-danger is-small sectionn" onclick="location.href='{{route('lendings.rebook',$member->id)}}'">本を返却する</button>-->
    <button class="button top_button is-danger is-small sectionn" style="font-size:20px" onclick="location.href='http://localhost:8000/lendings/rebook?member_id={{$member->id}}'">本を返却する</button>
</div>
@else
    <div class="main_content">
        <h3 class="sectionn">現在借りている本はありません</h3>
        <button class="button top_button is-success is-small sectionn" onclick="location.href='http://localhost:8000/lendings/create?member_id={{$member->id}}'">本を貸し出す</button>
    </div>
        @endif


<script>
    $(function() {
        $('.section').hide();
        $('.sectionn').hide();

        $('.lend_click').click( function( e ) {
            $('.section').show();
            $('.lend_click').hide();
            $('.sectionn').show();
                });
            });
</script>
@endsection
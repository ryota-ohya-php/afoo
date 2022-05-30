{{-- レイアウト挿入 --}}
@extends('layouts.app')

@section('content')

<h2 class="txt_center title">会員一覧</h2>
<div class="main_content">
    <!-- フラッシュメッセージ -->
    <div class="flash_message">
        {{ session('flash_message') }}
    </div>
    <div class="member_div">
        {{-- 会員登録ボタン --}}
        <button class="button is-success member_span" onclick="location.href='{{route('members.create')}}'" >＋会員を登録する</button>
                {{-- 会員検索フォーム --}}
                <form action="{{route('members.index')}}" method="get">
                    <p>
                    <div class="field">
                        <label class="label">キーワード</label>
                        <div class="control">
                        <input type="text" name="keyword" 
                        value="{{(isset($keyword)) ? $keyword : '';}}"
                        placeholder="会員ID、会員名、電話番号" class="input form-sizing">
                        {{-- 検索ボタン --}}
                        <button button type="submit" class="button is-primary member_search-button">検索する</button>
                        </div>
                    </div>
                    </p>
                </form>
        {{--  会員一覧表示--}}
        <table class="table_center margin-top">
            <thead>
                <tr>
                    <th>会員ID</th>
                    <th>会員名</th>
                    <th>電話番号</th>
                </tr>
            </thead>
            <tbody> 
                @foreach($members as $member)
                <tr>
                    <td>{{$member->id}}</td>
                    <td><a href="{{route('members.show',$member->id)}}">{{$member->name}}</a></td>
                    <td>{{$member->tel}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
{{ $members->appends(Request::all())->links() }}
</div>
@endsection

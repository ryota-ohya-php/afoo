{{-- レイアウト挿入 --}}
@extends('layouts.app')

@section('content')


<h2 class="txt_center title">会員一覧</h2>
<div class="main_content">
    <div class="member_div">
      <button class="button is-success member_span" onclick="location.href='{{route('members.create')}}'" >＋会員登録</button>
        <form action="{{route('members.index')}}" method="get">
            <p>
                <label>キーワード
                <input type="text" name="keyword" 
                value="{{(isset($keyword)) ? $keyword : '';}}"
                placeholder="会員ID、会員名、電話番号を入力してください"></label>
                <button button type="submit" class="button is-primary mamber_button">検索</button>
            </p>
        </form>
    
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
</div>
{{$members->links()}}
<hr>
<a href="/">戻る</a>
@endsection

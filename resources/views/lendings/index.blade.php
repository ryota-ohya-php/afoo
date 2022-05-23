<!-- layouts.appのテンプレート取得-->
@extends('layouts.app')

<!-- body内の記述スタート-->
@section('content')
<h2 class="txt_center title">貸出一覧画面</h2>
<div class="main_content">
    <!--貸出検索-->
    <form action="{{route('lendings.index')}}" method="post">
        @csrf
        <dl class="lending_dl margin-bottom">
            <dt>
                会員ID
            </dt>
                <dd>    
                    <input type="number" name="member_id" >
                </dd>
            <dt>
                資料名
            </dt>
                <dd> 
                    <input type="text" name="title" ><div class="txt_right"><button type="submit" class="button is-primary">検索</button></div>
                </dd>

        </dl>
        
    </form>

    <!--貸出一覧表示-->
    <table class="table_center">
        <thead>
            <tr>
                <th>会員ID</th>
                <th>資料名</th>
                <th>著者名</th>
                <th>貸出日</th>
                <th>期限日</th>
            </tr>
        </thead>
        <tbody>
            @foreach($lending as $lend)
            <tr>
                <td>{{$lend->member_id}}</td>
                <td>{{$lend->inventory_id}}</td>
                <td>{{$lend->lent_date}}</td>
                <td>{{$lend->return_date}}</td>
                <td>{{$lend->remarks}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
<!-- layouts.appのテンプレート取得-->
@extends('layouts.app')

<!-- body内の記述スタート-->
@section('content')
<h2 class="txt_center title">入力確認画面</h2>
<div class="main_content">
    <!--貸出確認画面-->
    

        <dl class="lending_dl margin-bottom">
            <dt>
                会員ID
            </dt>
                <dd>    
                    {{$request->member_id}}
                </dd>
            <dt>
                在庫ID
            </dt>
                <dd> 
                    {{$request->inventory_id}}
                </dd>
            <dt>
                貸出日
            </dt>
                <dd> 
                    {{$request->lend_date}}
                </dd>
            <dt>
                備考
            </dt>
                <dd> 
                    {{$request->remarks}}
                </dd>
        </dl>
        <form action="{{route('lending.store')}}" method="post">
            @csrf
            <input type="hidden" name="member_id" value="{{$request->member_id}}">
            <input type="hidden" name="inventory_id" value="{{$request->inventory_id}}">
            <input type="hidden" name="lend_date" value="{{$request->lend_date}}">
            <input type="hidden" name="remakes" value="{{$request->remarks}}">
        <button type="submit" class="button is-warning">登録する</button>
    </form>

</div>
@endsection
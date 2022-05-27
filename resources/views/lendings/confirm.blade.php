<!-- layouts.appのテンプレート取得-->
@extends('layouts.app')

<!-- body内の記述スタート-->
@section('content')
<h2 class="txt_center title">入力確認画面</h2>
<div class="main_content">
    <!--貸出確認画面-->
    
    <div  class="info_dl">
        <dl>
            <dt>
                会員ID
            </dt>
                <dd>    
                    {{$request->member_id}}
                </dd>
            <dt>
                {{isset(($_POST['lent_date'])) ? '貸出日' : '返却日';}}
            </dt>
                <dd> 
                    {{isset(($_POST['lent_date']))? $request->lent_date : $request->return_date;}}
                </dd>
            <dt>
                備考
            </dt>
                <dd> 
                    {{$request->remarks}}
                </dd>
        </dl>
    </div>
        <p class="f_bold">貸出情報</p>
        <table class="table_center" style="width:700px" >
            <thead>
                <tr>
                    <th>ID</th>
                    <th style="width:50%">資料名</th>
                    <th>貸出日</th>
                    <th>貸出期限日</th>
                </tr>
            </thead>
            @foreach($data as $val)
                @foreach($val as $s)
            <tr>
                <td>{{$s->id}}</td>
                <td>{{$s->title}}</td>
                <td>{{$s->lent_date}}</td>
                <td>{{$s->due_date}}</td>
            </tr>
                @endforeach
            @endforeach
        </table>
        <div class="block margin-top">
        <div class="sub_block">
            <button class="button is-primary mamber_button"
                onclick="location.href='{{ route('lendings.create')}}';history.back()">登録画面に戻る</button>
        </div>
        <div class="sub_block">
        <form action=" {{($request->lend_or_rebook == 'lend') ? route('lendings.store') : route('lendings.rebooks')}}" method="post">
            @csrf
            {{-- @if($request->lend_or_rebook != 'lend')
        
            @method('patch')
    
            @endif --}}
            @foreach($data as $val)
                @foreach($val as $s)
                 <input type="hidden" name="id[]" value="{{$s->id}}">
                @endforeach
            @endforeach
            <input type="hidden" name="member_id" value="{{$request->member_id}}">
            <input type="hidden" name="inventory_id" value="{{$request->inventory_id}}">
            <input type="hidden" name="{{isset(($_POST['lent_date']))? 'lent_date' : 'return_date';}}"
             value="{{isset(($_POST['lent_date']))? $request->lent_date : $request->return_date;}}">
            <input type="hidden" name="remarks" value="{{$request->remarks}}">
        <button type="submit" class="button is-warning"style="height: 33px;">登録する</button>
    </form>
    </div>
    </div>
</div>
@endsection
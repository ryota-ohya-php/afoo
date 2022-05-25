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
                会員情報
            </dt>
                <dd>    
                    {{-- {{$request->member_name}} --}}
                    会員ID:{{$request->member_id}}
                </dd>
            <dt>
                備考
            </dt>
                <dd> 
                    {{$request->remarks}}
                </dd>
        </dl>
    </div>
        <p>貸出情報</p>
        <table class="table_center" style="width:700px" >
            <thead>
                <tr>
                    <th>資料名</th>
                    <th>貸出日</th>
                    {{-- <th>貸出期限日</th> --}}
                </tr>
            </thead>
            @foreach($data as $val)
                @foreach($val as $s)
            {{-- @for ($i = 0; $i < $data->count(); $i++) --}}
                <tr>
                <td>{{$s->title}}</td>
                <td>{{$request->lent_date}}</td>
                {{-- <td>NULL</td> --}}
            </tr>
            {{-- @endfor --}}
            
                @endforeach
            @endforeach
        </table>
        <form action=" {{route('lendings.store')}}" method="post">
            @csrf
            @foreach($data as $val)
                @foreach($val as $s)
                 <input type="hidden" name="id[]" value="{{$s->id}}">
                 {{-- <input type="hidden" name="book_id[]" value="{{$s->book_id}}"> --}}
                @endforeach
            @endforeach

            <input type="hidden" name="member_id" value="{{$request->member_id}}">
            {{-- <input type="hidden" name="inventory_id" value="{{$request->inventory_id}}"> --}}
            <input type="hidden" name="{{isset(($_POST['lent_date']))? 'lent_date' : 'return_date';}}"
             value="{{isset(($_POST['lent_date']))? $request->lent_date : $request->return_date;}}">
            <input type="hidden" name="remarks" value="{{$request->remarks}}">
        <button type="submit" class="button is-warning">登録する</button>
    </form>

</div>
@endsection
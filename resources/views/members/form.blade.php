
@csrf
<!-- menber/createだったら valueが空のフォームを適応 -->
@if($_SERVER['REQUEST_URI'] == '/members/create')

<dl>
    <!--<dt>会員ID</dt>
    <dd><input type="text" name="member_id"></dd>-->
    <dt>会員名</dt>
    <dd><input type="text" name="name" 
        value=""></dd>
    <dt>住所</dt>
    <dd><input type="text" name="address"></dd>
    <dt>電話番号</dt>
    <dd><input type="tel" name="tel"></dd>
    <dt>生年月日</dt>
    <dd><input type="date" name="birthday"></dd>
    <dt>メールアドレス</dt>
    <dd><input type="email" name="email"></dd>
</dl>
<button type ="submit">入力確認する</button>

@else
@foreach($member as $val)
<dl>
        <!--<dt>会員ID</dt>
        <dd><input type="text" name="member_id"></dd>-->
        <dt>会員名</dt>
        <dd><input type="text" name="name" 
            value="{{$val->name}}"></dd>
        <dt>住所</dt>
        <dd><input type="text" name="address" value="{{$val->address}}"></dd>
        <dt>電話番号</dt>
        <dd><input type="tel" name="tel" value="{{$val->tel}}"></dd>
        <dt>生年月日</dt>
        <dd><input type="date" name="birthday" value="{{$val->birthday}}"></dd>
        <dt>メールアドレス</dt>
        <dd><input type="email" name="email" value="{{$val->email}}"></dd>
    </dl>
    <button type ="submit">入力確認する</button>
    @endforeach
@endif


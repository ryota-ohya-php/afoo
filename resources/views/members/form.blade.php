
@csrf
<!-- menber/createだったら valueが空のフォームを適応 -->
@if($_SERVER['REQUEST_URI'] == '/members/create')

<div class="main_content">
    <div class="info_dl">
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
    </div>
        <input type="hidden" name="confirm" value="create">
        <button type="submit" class="mamber_button button is-warning">入力確認する</button>
    
</div>

    @else
    @foreach($member as $val)
    <div class="main_content">
        <div class="info_dl">
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
        </div>

        <input type="hidden" name="confirm" value="updata">
        <input type="hidden" name="member_id" value="{{$val->id}}">
        <button type="submit" class="mamber_button button is-warning">入力確認する</button>
        @endforeach
    @endif
    </div>


@csrf
<!-- menber/createだったら valueが空のフォームを適応 -->
@if($_SERVER['REQUEST_URI'] == '/members/create')

<div class="main_content">
    <div class="info_dl">
        <dl>
            <dt>会員名 <span class="span_red">[必須]</span></dt>
            <dd><input type="text"  name="name"     value="{{ old('name') }}"></dd>

            <dt>住所<span class="span_red">[必須]</span></dt>
            <dd><input type="text"  name="address"  value="{{ old('address') }}"></dd>

            <dt>電話番号 <span class="span_red">[必須]</span></dt>
            <dd><input type="tel"   name="tel"      value="{{ old('tel') }}"></dd>
            
            <dt>生年月日<span class="span_red">[必須]</span></dt>
            <dd><input type="date"  name="birthday" value="{{ old('birthday') }}"></dd>
            
            <dt>メールアドレス</dt>
            <dd><input type="email" name="email"    value="{{ old('email') }}"></dd>
        </dl>
    </div>
    {{-- 一覧画面に戻るボタン --}}
    <button type="button" class="button is-primary mamber_button"
            onclick="location.href='{{ route('members.index')}}'">会員一覧画面に戻る</button>
    {{-- 入力確認ボタン --}}
    <input type="hidden" name="confirm" value="create">
    <button type ="submit" class="mamber_button button is-warning">入力確認する</button>
</div>

@else
@foreach($member as $val)
<div class="main_content">
    <div class="info_dl">
        <dl>
            <dt>会員名 <span class="span_red">[必須]</span></dt>
            <dd><input type="text" name="name"value="{{$val->name}}" ></dd>

            <dt>住所<span class="span_red">[必須]</span></dt>
            <dd><input type="text" name="address" value="{{$val->address}}"></dd>

            <dt>電話番号 <span class="span_red">[必須]</span></dt>
            <dd><input type="tel" name="tel" value="{{$val->tel}}"></dd>

            <dt>生年月日<span class="span_red">[必須]</span></dt>
            <dd><input type="date" name="birthday" value="{{$val->birthday}}"></dd>
            
            <dt>メールアドレス</dt>
            <dd><input type="email" name="email" value="{{$val->email}}"></dd>
        </dl>
    </div>
    {{-- 詳細画面に戻るボタン --}}
    <button type="button" class="button is-primary mamber_button"
            onclick="location.href='{{ route('members.show', $val->id)}}'">会員詳細画面に戻る</button>
    {{-- 入力確認ボタン --}}
    <input type="hidden" name="confirm" value="updata">
    <input type="hidden" name="member_id" value="{{$val->id}}">
    <button type="submit" class="mamber_button button is-warning">入力確認する</button>
    @endforeach
    @endif
    </div>

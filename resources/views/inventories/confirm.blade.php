@extends('layouts.app')

@section('content')
<h2 class="txt_center title">在庫登録</h2>
<div class="main_content">
      <dl>
        <label for="inventory_num">
          <dt>在庫数</dt>
          <dd></dd>
        </label>
      </dl>
      <dl>
        <label for="arrival_date">
          <dt>入荷年月日</dt>
          <dd></dd>
        </label>
      </dl>
      <dl>
        <label for="remarks">
          <dt>備考</dt>
          <dd></dd>
        </label>
      </dl>
    <form action="{{ route('inventories.store') }}" method="post">
      @csrf
      <input type="hidden" name="book_id" value="">
      <input type="hidden" name="arrival_date" value="{{$request->arrival_date}}">
      <input type="hidden" name="disposal_date">
      <input type="hidden" name="remarks" value="{{$request->remarks}}">
      <input type="hidden" name="inventory_num" value="{{$request->inventory_num}}">
      <button type="submit">在庫登録</button>
    </form>
    <a href="{{ route('inventories.create') }}">在庫登録画面に戻る</a>
</div>
    
@endsection
@extends('layouts.app')

@section('content')
<h2 class="txt_center title">入力確認</h2>
<div class="main_content">
  <!-- 入力情報表示 -->
  <div class="info_dl">
      <dl>
          <dt>在庫数</dt>
          <dd>{{ $request->inventory_num }}</dd>
          <dt>入荷年月日</dt>
          <dd>{{ $request->arrival_date }}</dd>
          <dt>備考</dt>
          <dd>{{ $request->remarks }}</dd>
      </dl>
  </div>

    <!-- hiddenでstoreメソッドに送る -->
    <form action="{{ route('inventories.store') }}" method="post">
      @csrf
      <input type="hidden" name="book_id" value="{{ $request->book_id }}">
      <input type="hidden" name="arrival_date" value="{{$request->arrival_date}}">
      <input type="hidden" name="remarks" value="{{$request->remarks}}">
      <input type="hidden" name="inventory_num" value="{{$request->inventory_num}}">

      {{-- 登録画面に戻るボタン --}}
      <button type="button" class="page_button button is-primary"
        onclick="history.back()">登録画面に戻る</button>
        {{-- <a href='{{ route('inventories.create') }}">在庫登録画面に戻る</a> --}}

      {{-- 登録ボタン --}}
      <button type="submit" class="page_button button is-success">登録する</button>
    </form>
</div>
@endsection
@extends('layouts.app')

@section('content')
<h2 class="txt_center title">在庫登録</h2>
<div class="main_content">
      <dl>
          <dt>在庫数</dt>
          <dd>{{ $request->inventory_num }}</dd>
          <dt>入荷年月日</dt>
          <dd>{{ $request->arrival_date }}</dd>
          <dt>備考</dt>
          <dd>{{ $request->remarks }}</dd>
      </dl>
    <!-- hiddenでstoreメソッドに送る -->
    <form action="{{ route('inventories.store') }}" method="post">
      @csrf
      <input type="hidden" name="book_id" value="{{ $request->book_id }}">
      <input type="hidden" name="arrival_date" value="{{$request->arrival_date}}">
      <input type="hidden" name="remarks" value="{{$request->remarks}}">
      <input type="hidden" name="inventory_num" value="{{$request->inventory_num}}">
      <button type="submit">在庫登録</button>
    </form>
    <a href="{{ route('inventories.create') }}">在庫登録画面に戻る</a>
</div>
    
@endsection
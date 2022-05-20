@extends('layouts.app')

@section('content')
    <h2 class="txt_center title">在庫登録</h2>
    <div class="main_content">
    <form action="{{ route('inventories.confirm') }}" method="post">
      @csrf
      <dl>
        <label for="inventory_num">
          <dt>在庫数</dt>
          <dd><input type="number" name="inventory_num" id="inventory_num" value="1" required></dd>
        </label>
      </dl>
      <dl>
        <label for="arrival_date">
          <dt>入荷年月日</dt>
          <dd><input type="date" name="arrival_date" id="arrival_date" value="<?php echo date('Y-m-d'); ?>" required></dd>
        </label>
      </dl>
      <dl>
        <label for="remarks">
          <dt>備考</dt>
          <dd><input type="text" name="remarks" id="remarks"></dd>
        </label>
      </dl>
      <button type="submit">在庫登録確認画面へ</button>
    </form>
    <a href="/">戻る</a>
    </div>
    
@endsection
@extends('layouts.app')

@section('content')
    <h1>在庫登録</h1>
    <form action="{{ route('inventories.confirm') }}" method="post">
      @csrf
      <dl>
        <label for="inventory_num">
          <dt>在庫数</dt>
          <dd></dd>
        </label>
      </dl>
      <dl>
        <label for="stock_date">
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
      <button type="submit">在庫登録確認画面へ</button>
    </form>
    <a href="{{ route('inventories.create') }}">在庫登録画面に戻る</a>
@endsection
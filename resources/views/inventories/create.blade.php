@extends('layouts.app')

@section('content')
<h2 class="txt_center title">在庫登録</h2>
    <div class="main_content">
      <form action="{{ route('inventories.confirm') }}" method="post">
        @csrf
        <dl>
          <dt>タイトル</dt>
          <dd>
            @foreach($book as $book_info)
              {{ $book_info->title }}
            @endforeach
          </dd>
          <dt>著者</dt>
          <dd>
            @foreach($book as $book_info)
              {{ $book_info->author }}
            @endforeach
          </dd>
          <label for="inventory_num">
            <dt>在庫数</dt>
            <dd><input type="number" name="inventory_num" id="inventory_num" value="1" required></dd>
          </label>
          <label for="arrival_date">
            <dt>入荷年月日</dt>
            <dd><input type="date" name="arrival_date" id="arrival_date" value="<?php echo date('Y-m-d'); ?>" required></dd>
          </label>
          <label for="remarks">
            <dt>備考</dt>
            <dd><input type="text" name="remarks" id="remarks"></dd>
          </label>
        </dl>
        <button type="submit">在庫登録確認画面へ</button>

        <!-- book_idをhiddenで確認画面へ送る -->
        <input type="hidden" name="book_id" 
        value="@foreach($book as $book_info)
                {{ $book_info->id }}
              @endforeach">
      </form>
      <a href="/">TOPに戻る</a>
    </div>
    
@endsection
@extends('layouts.app')

@section('content')
<h2 class="txt_center title">在庫の新規登録</h2>
  <div class="main_content">
     <!-- バリデーションのエラーメッセージ -->
    @include('commons/flash')

      <!-- 在庫登録フォーム -->
      <form action="{{ route('inventories.confirm') }}" method="post">
        @csrf
        <!-- フォーム内容 -->
        <div class="info_dl">
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

            <dt><label for="inventory_num">在庫数</label></dt>
            <dd><input type="number" name="inventory_num" id="inventory_num" value="1" required></dd>

            <dt><label for="arrival_date">入荷年月日</label></dt>
            <dd><input type="date" name="arrival_date" id="arrival_date" 
                value="<?php echo date('Y-m-d'); ?>" required></dd>
            
            <dt><label for="remarks">備考</label></dt>
            <dd><input type="text" name="remarks" id="remarks"></dd>
          </dl>
        </div>

        <!-- 詳細画面に戻るボタン -->
        <button type="button" class="page_button button is-primary"
        onclick="history.back()">書籍詳細画面に戻る</button>
        <!-- 登録ボタン -->
        <button type="submit" class="page_button button is-warning">入力確認する</button>

        <!-- book_idをhiddenで確認画面へ送る -->
        <input type="hidden" name="book_id" 
        value=" @foreach($book as $book_info)
                  {{ $book_info->id }}
                @endforeach">
      </form>

@endsection
</div>
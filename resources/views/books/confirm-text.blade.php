{{---- 確認画面で表示される内容表示 ----}}
<dl>
    <dt>ISBN番号</dt>
    <dd>{{$request->isbn}}</dd>
    <dt>タイトル</dt>
    <dd>{{$request->title}}</dd>
    <dt>著者</dt>
    <dd>{{$request->author}}</dd>
    <dt>分類コード</dt>
    <dd>{{$request->category_id}}</dd>
    <dt>出版社</dt>
    <dd>{{$request->publisher}}</dd>
    <dt>出版日</dt>
    <dd>{{$request->published_date}}</dd>
</dl>

{{-- ------------------------------- --}}
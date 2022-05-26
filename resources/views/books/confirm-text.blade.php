<!-- 確認画面で表示される内容表示 -->
<p id="book_img"></p>
<div class="info_dl">
    <dl>
        <dt>ISBN番号</dt>
        <dd id="isbn">{{$request->isbn}}</dd>
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
</div>
<script>
    // この関数でisbn番号からデータ取得して代入
    $(function() {
        $('#getBookInfo').ready( function( e ) {
            // e.preventDefault();
            // 定数isbnにidがisbnのvalueを代入している
            // console.log($("#isbn").val())
            const isbn = $("#isbn").text();
            // isbn番号をopenbd(webapi)にgetで送信するurl
            const url = "https://api.openbd.jp/v1/get?isbn=" + isbn;

            // isbn番号に対するレスポンスがdata[0]に入っている
            $.getJSON( url, function( data ) {
                if( data[0].summary.cover == "" ){
                    $("#book_img").html('<img src=\"\" />');
                } else {
                    $("#book_img").html('<img src=\"' + data[0].summary.cover + '\" style=\"border:solid 1px #000000\" />');
                }
            });
        });
    });
</script>
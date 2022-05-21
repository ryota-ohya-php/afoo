@csrf
{{-- booksのフォーム部分部品化 --}}
<dl>
    {{-- old関数で一つ前の値を表示 --}}
    <dt><label for="isbn">ISBN番号</label></dt>
    <dd>
        {{-- <form action="{{route('books.create')}}" method="GET"> --}}
            <input type="number" name="isbn" id="isbn" pattern="^\d{13}$" value="" autofocus>
            <button id="getBookInfo">ISBN番号で自動補完</button>
        {{-- <button type="submit">ISBN番号で検索する</button>  --}}
        {{-- </form> --}}
    </dd>
    <dt><label for="title">タイトル</label></dt>
    <dd>
        <input type="text" name="title" id="title" value="">
    </dd>
    <dt><label for="author">著者</label></dt>
    <dd>
        <input type="text" name="author" id="author" value="">
    </dd>
    <dt><label for="category">分類コード(現段階自分で手入力)</label></dt>
    <dd>
        <select name="category_id" id="category_id">
            <option value="0">総記</option>
            <option value="1">哲学</option>
            <option value="2">歴史</option>
            <option value="3">社会科学</option>
            <option value="4">自然科学</option>
            <option value="5">技術</option>
            <option value="6">産業</option>
            <option value="7">芸術</option>
            <option value="8">言語</option>
            <option value="9">文学</option>
        </select>
    </dd>
    <dt><label for="publisher">出版社</label></dt>
    <dd>
        <input type="text" name="publisher" id="publisher" value="">
    </dd>
    <dt><label for="published_date">出版日(上手く補完されない)</label></dt>
    <dd>
        <input type="date" name="published_date" id="published_date" value="">
    </dd>
</dl>
<input type="hidden" name="book_id" value="{{$book->id}}">

<script>
    $(function() {
        $('#getBookInfo').click( function( e ) {
            e.preventDefault();
            const isbn = $("#isbn").val();
            const url = "https://api.openbd.jp/v1/get?isbn=" + isbn;

            $.getJSON( url, function( data ) {
                if( data[0] == null ) {
                    alert("データが見つかりません");
                } else {
                    // if( data[0].summary.cover == "" ){
                    //     $("#thumbnail").html('<img src=\"\" />');
                    // } else {
                    //     $("#thumbnail").html('<img src=\"' + data[0].summary.cover + '\" style=\"border:solid 1px #000000\" />');
                    // }
                    $("#title").val(data[0].summary.title);
                    $("#publisher").val(data[0].summary.publisher);
                    // $("#volume").val(data[0].summary.volume);
                    // $("#series").val(data[0].summary.series);
                    $("#author").val(data[0].summary.author);
                    $("#published_date").val(data[0].summary.pubdate);
                    // $("#cover").val(data[0].summary.cover);
                    // $("#description").val(data[0].onix.CollateralDetail.TextContent[0].Text);
                }
            });
        });
    });
</script>
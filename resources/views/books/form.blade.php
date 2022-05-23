@csrf
{{-- booksのフォーム部分部品化 --}}
<div>
    <p id = "book_img"></p>
</div>
<dl>
    {{-- old関数で一つ前の値を表示 --}}
    <dt><label for="isbn">ISBN番号</label></dt>
    <dd>
        {{-- <form action="{{route('books.create')}}" method="GET"> --}}
            <input type="number" name="isbn" id="isbn" maxlength="13" pattern="^\d{13}$" value="{{old('isbn',$book->isbn)}}" autofocus>
            <button id="getBookInfo">ISBN番号で自動補完</button>
        {{-- <button type="submit">ISBN番号で検索する</button>  --}}
        {{-- </form> --}}
    </dd>
    <dt><label for="title">タイトル</label></dt>
    <dd>
        <input type="text" name="title" id="title" size="20" value="{{old('title',$book->title)}}">
    </dd>
    <dt><label for="author">著者</label></dt>
    <dd>
        <input type="text" name="author" id="author" size="20" value="{{old('author',$book->author)}}">
    </dd>
    <dt><label for="category">分類コード(現段階自分で手入力)</label></dt>
    <dd>
        <select name="category_id" id="category_id">
            <option value="0">0(総記)</option>
            <option value="1">1(哲学)</option>
            <option value="2">2(歴史)</option>
            <option value="3">3(社会科学)</option>
            <option value="4">4(自然科学)</option>
            <option value="5">5(技術)</option>
            <option value="6">6(産業)</option>
            <option value="7">7(芸術)</option>
            <option value="8">8(言語)</option>
            <option value="9">9(文学)</option>
        </select>
    </dd>
    <dt><label for="publisher">出版社</label></dt>
    <dd>
        <input type="text" name="publisher" id="publisher" value="{{old('publisher',$book->publisher)}}">
    </dd>
    <dt><label for="published_date">出版日</label></dt>
    <dd>
        <input type="date" name="published_date" id="published_date" value="{{old('published_date',$book->published_date)}}">
    </dd>
</dl>
<input type="hidden" name="book_id" value="{{$book->id}}">

<script>
    // この関数でisbn番号からデータ取得して代入
    $(function() {
        $('#getBookInfo').click( function( e ) {
            e.preventDefault();
            // 定数isbnにidがisbnのvalueを代入している
            const isbn = $("#isbn").val();
            // isbn番号をopenbd(webapi)にgetで送信するurl
            const url = "https://api.openbd.jp/v1/get?isbn=" + isbn;

            // isbn番号に対するレスポンスがdata[0]に入っている
            $.getJSON( url, function( data ) {
                if( data[0] == null ) {
                    alert("データが見つかりません");
                } else {
                    if( data[0].summary.cover == "" ){
                        $("#book_img").html('<img src=\"\" />');
                    } else {
                        $("#book_img").html('<img src=\"' + data[0].summary.cover + '\" style=\"border:solid 1px #000000\" />');
                    }

                    // $("代入する箇所のcssセレクタ").val(代入する値)で各value属性に代入

                    $("#title").val(data[0].summary.title);
                    $("#publisher").val(data[0].summary.publisher);
                    $("#author").val(data[0].summary.author);

                    console.log(data[0].summary.pubdate);
                    let data_date = String(data[0].summary.pubdate);
                    console.log(data[0].summary.pubdate.length);
                    let year = data[0].summary.pubdate.slice(0,4);
                    // let month = data[0].summary.pubdate.slice(4,6);
                    if (data[0].summary.pubdate.length == 8) {
                        console.log("a");
                        let month = data[0].summary.pubdate.slice(4,6);
                        console.log(month);
                        let day = data[0].summary.pubdate.slice(6,8);
                        let date = String(year + '-' + month + '-' + day);
                        $("#published_date").val(date);
                    }
                    if(data[0].summary.pubdate.length == 7){
                        let month = data_date.slice(5,7);
                        let day = "01";
                        let date = String(year + '-' + month + '-' + day);
                        $("#published_date").val(date);
                    }

                    // console.log(month);
                    // let date = new Date(year + "/" + month + "/" + day);

                    // let date = String(year + '-' + month + '-' + day);

                    // console.log(year);
                    // console.log(month);
                    // console.log(day);
                    // console.log("year + '/' + month + '/' + day");
                    // console.log(date);
                    // $("#published_date").val(date);
                    console.log(data[0]);
                    
                    

                    // $("#volume").val(data[0].summary.volume);
                    // $("#series").val(data[0].summary.series);
                    // $("#cover").val(data[0].summary.cover);
                    // $("#description").val(data[0].onix.CollateralDetail.TextContent[0].Text);
                    
                }
            });
        });
    });
    
</script>
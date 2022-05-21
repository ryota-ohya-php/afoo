@csrf
{{-- booksのフォーム部分部品化 --}}
<dl>
    {{-- old関数で一つ前の値を表示 --}}
    <dt><label for="isbn">ISBN番号</label></dt>
    <dd>
        {{-- <form action="{{route('books.create')}}" method="GET"> --}}
            <input type="number" name="isbn" id="isbn" pattern="^\d{13}$" value="{{old('isbn',$book->isbn)}}">
        {{-- <button type="submit">ISBN番号で検索する</button>  --}}
    {{-- </form> --}}
    </dd>
    <dt><label for="title">タイトル</label></dt>
    <dd>
        <input type="text" name="title" id="title" value="{{old('title',$book->title)}}">
    </dd>
    <dt><label for="author">著者</label></dt>
    <dd>
        <input type="text" name="author" id="author" value="{{old('author',$book->author)}}">
    </dd>
    <dt><label for="category">分類コード</label></dt>
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
        <input type="text" name="publisher" id="publisher" value="{{old('publisher',$book->publisher)}}">
    </dd>
    <dt><label for="published_date">出版日</label></dt>
    <dd>
        <input type="date" name="published_date" id="published_date" value="{{old('published_date',$book->published_date)}}">
    </dd>
</dl>
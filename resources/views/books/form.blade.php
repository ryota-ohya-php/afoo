@csrf
<dl>
    <dt><label for="isbn">ISBN番号</label></dt>
    <dd>
        <input type="number" name="isbn" id="isbn" pattern="^\d{13}$">
    </dd>
    <dt><label for="title">タイトル</label></dt>
    <dd>
        <input type="text" name="title" id="title" value="タイトル">
    </dd>
    <dt><label for="author">著者</label></dt>
    <dd>
        <input type="text" name="author" id="author" value="著者">
    </dd>
    <dt><label for="category">分類コード</label></dt>
    <dd>
        <select name="category" id="category">
            <option value="1">総記</option>
            <option value="2">哲学</option>
            <option value="3">歴史</option>
            <option value="4">社会科学</option>
            <option value="5">自然科学</option>
            <option value="6">技術</option>
            <option value="7">産業</option>
            <option value="8">芸術</option>
            <option value="9">言語</option>
            <option value="10">文学</option>
        </select>
    </dd>
    <dt><label for="publisher">出版社</label></dt>
    <dd>
        <input type="text" name="publisher" id="publisher" value="出版社">
    </dd>
    <dt><label for="published_at">出版日</label></dt>
    <dd>
        <input type="date" name="published_at" id="published_at" value="published_at">
    </dd>
</dl>
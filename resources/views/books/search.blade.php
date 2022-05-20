<dl>
    <dt><label for="isbn" >ISBN番号</label></dt>
    <dd>
        <input type="number" name="isbn" id="isbn" pattern="^\d{13}$" value="{{request('isbn')}}" placeholder="13桁の数字を入力してください">
    </dd>
    <dt><label for="title">タイトル</label></dt>
    <dd>
        <input type="text" name="title" id="title" value="{{request('title')}}" placeholder="タイトルを入力してください">
    </dd>
    <dt><label for="author">著者</label></dt>
    <dd>
        <input type="text" name="author" id="author" value="{{request('author')}}" placeholder="著者を入力してください">
    </dd>
    <dt><label for="category">分類コード</label></dt>
    <dd>
    <select name="category_id" id="category_id">
        <option value=""></option>
        @foreach ($categories as $category)
            <option value="{{$category->id}}">
                {{request('category_id') == $category->id ? '' : ''}}
                >
                {{$category->name}} ({{$category->books_count}})
            </option>
        @endforeach
    
        {{-- <option value="0">総記</option>
    <option value="1">哲学</option>
    <option value="2">歴史</option>
    <option value="3">社会科学</option>
    <option value="4">自然科学</option>
    <option value="5">技術</option>
    <option value="6">産業</option>
    <option value="7">芸術</option>
    <option value="8">言語</option>
    <option value="9">文学</option> --}}
    </select>
    </dd>
</dl>
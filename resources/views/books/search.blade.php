
<div class="field">
    <label class="label" for="isbn" >ISBN番号</label>
    <div class="control">
        <input type="number" name="isbn" id="isbn" pattern="^\d{13}$" value="{{request('isbn')}}"
                placeholder="13桁の数字を入力してください" class="input form-sizing">
    </div>
</div>
<div class="field">
    <label class="label" for="title">タイトル</label>
    <div class="control">
        <input type="text" name="title" id="title" value="{{request('title')}}"
            placeholder="タイトルを入力してください" class="input form-sizing">
    </div>
</div>
<div class="field">
    <label class="label" for="author">著者</label>
    <div class="control">
        <input type="text" name="author" id="author" value="{{request('author')}}"
            placeholder="著者を入力してください" class="input form-sizing">
    </div>
</div>
<div class="field">
    <label class="label" for="category">分類コード</label>
    <div class="control">
        <div class="select">
            <select name="category_id" id="category_id" class="form-sizing">
            <option value="カテゴリーを選択してください"></option>
            @foreach ($categories as $category)
                {{-- なぜかidが0の際検索できなかったので条件分岐 --}}
                <option value="{{ $category->id == 0 ? '%0' : $category->id}}"
                    {{request('category_id') == $category->id ? 'selected' : ' '}}>
                    {{$category->name}} ({{$category->books_count}})  
                    {{-- books_countはwithCount関数の値が入っている --}}
                </option>
            @endforeach
            </select>
        </div>
    </div>
</div>
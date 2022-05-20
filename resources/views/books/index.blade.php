@extends('layouts.app')

@section('content')
    <h2 class="txt_center title">書籍一覧</h2>
    <div class="main_content">
        <button class="button is-success member_span" onclick="location.href='{{route('books.create')}}'" >＋資料登録</button>
    <form action="{{route('books.index')}}" method="get">
        <dl>
            <dt><label for="isbn">ISBN番号</label></dt>
            <dd>
                <input type="number" name="isbn" id="isbn" pattern="^\d{13}$" placeholder="13桁の数字を入力してください">
            </dd>
            <dt><label for="title">タイトル</label></dt>
            <dd>
                <input type="text" name="title" id="title" placeholder="タイトルを入力してください">
            </dd>
            <dt><label for="author">著者</label></dt>
            <dd>
                <input type="text" name="author" id="author" placeholder="著者を入力してください">
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
        </dl>
        <button type="submit">検索</button>
    </form>
    </div>
    <table class="table_center margin-top">
        <thead>
            <tr>
                <th>ISBN番号</th>
                <th>タイトル</th>
                <th>著者名</th>
                <th>分類コード</th>
                <th>在庫数</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($books as $book)
               <tr>
                <td>{{$book->isbn}}</td>
                <td>
                    <a href="{{route('books.show',$book->id)}}">
                        {{$book->title}}</a> 
                </td>
                <td>{{$book->author}}</td>
                <td>{{$book->category_id}}</td>
                <td>1/3</td>
            </tr> 
            @endforeach
        </tbody>
    </table>
    {{$books ->links()}}
</div>
    
@endsection
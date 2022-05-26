<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Inventory;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->validate($request,[
            'isbn' => 'max:13',
        ]);
        $query = Book::with('category');
        if ($request->category_id) {
            $query->where('category_id',$request->category_id);
        }

        if ($request->title) {
            $query->where('title','LIKE','%'.$request->title . '%');
        }

        if ($request->author) {
            $query->where('author','LIKE','%'.$request->author . '%');
        }

        if ($request->isbn) {
            $query->where('isbn',$request->isbn);
        }
        
        $books = $query->orderBy('published_date','desc')->paginate(10);
        $categories = Category::withCount('books')->get();


        foreach($books as $book){
            // dd($book->id);
            $in=Inventory::select('id','lend_flag');
            // $in->join('books', 'inventories.book_id', '=', 'books.id');
            $in->where('book_id','=',$book->id);
            $in->where('lend_flag','=',0);
            $count_inv[$book->id]=$in->get();
            // $count = array($count_inv->count());
            // dd($counn);
            // 
        }
        //  dd($count_inv);

        return view('books.index',[

            'books'      => $books,
            'categories' => $categories,
            'count_inv'  => $count_inv

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::get();
        $book = new Book;
        return view('books.create',['book'=>$book,'categories'=>$categories]);
    }

    public function confirm_create(Request $request)
    {
        // バリデーション（フォーム送信内容）
        $validated = $request->validate([
            'isbn'        => ['required', 'digits:13'],
            'title'       => ['required', 'string','max:500',],
            'author'      => ['required', 'string','max:255',],
            'category_id' => ['required', ],
            'publisher'   => ['required', 'string','max:100',],
        ],
        [
        // エラーメッセージ、一覧画面に表示。
            'isbn.required'        => 'isbn番号を入力してください。',
            'isbn.digits'          => '13桁のisbn番号を入力してください。',
            
            'title.required'       => 'タイトルは必須項目です。',
            'title.max'            => 'タイトルは500文字以内です。',
            
            'author.required'      => '著者は必須項目です。',
            'author.max'           => '著者は255文字以内です。',

            'category_id.required' => 'カテゴリーIDは必須項目です。',

            'publisher.required'   => '出版社は必須項目です。',
            'publisher.max'        => '出版社は100文字以内です。',
        ]);

        // バリデーション（同一書籍の新規登録）
        if (Book::where('isbn', $request->isbn)->get()->count()) {
            // 書籍一覧画面に遷移
            return redirect(route('books.index'))
            ->with('flash_message', 'すでに書籍登録されています。検索後、在庫登録をしてください。');
        } else{
            // 登録確認画面へ遷移
            return view('books.confirm-create',['request'=>$request]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'isbn' => 'max:13',
        ]);
        $book = new Book;
        $book->create($request->all());
        return redirect(route('books.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        /**現在の在庫数表示 */
        
        $in=Inventory::select('id','lend_flag');
        $in->where('book_id','=',$book->id);
        $in->where('lend_flag','=',0);
        $count_inv=$in->get();
        
        return view('books.show',['book'=>$book,'count_inv'=>$count_inv]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        $categories = Category::get();
        // dd($categories);
        return view('books.edit',['book'=>$book,'categories'=>$categories]);
    }

    public function confirm_edit(Request $request)
    {
        // バリデーション（フォーム送信内容）
        $validated = $request->validate([
            'isbn'        => ['required', 'digits:13'],
            'title'       => ['required', 'string','max:500',],
            'author'      => ['required', 'string','max:255',],
            'category_id' => ['required', ],
            'publisher'   => ['required', 'string','max:100',],
        ],
        [
        // エラーメッセージ、一覧画面に表示。
            'isbn.required'        => 'isbn番号を入力してください。',
            'isbn.digits'          => '13桁のisbn番号を入力してください。',
            
            'title.required'       => 'タイトルは必須項目です。',
            'title.max'            => 'タイトルは500文字以内です。',
            
            'author.required'      => '著者は必須項目です。',
            'author.max'           => '著者は255文字以内です。',

            'category_id.required' => 'カテゴリーIDは必須項目です。',

            'publisher.required'   => '出版社は必須項目です。',
            'publisher.max'        => '出版社は100文字以内です。',
        ]);

        // バリデーション（同一書籍の新規登録）
        if (Book::where('isbn', $request->isbn)->get()->count()) {
            // 書籍一覧画面に遷移
            return redirect(route('books.index'))
            ->with('flash_message', 'すでに書籍登録されています。検索後、在庫登録をしてください。');
        } else{
            // 編集確認画面へ遷移
            return view('books.confirm-edit',['request'=>$request]);
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $this->validate($request,[
            'isbn' => 'max:13',
        ]);
        $book->update($request->all());
        return redirect(route('books.show',$book));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect(route('books.index'));
    }
}

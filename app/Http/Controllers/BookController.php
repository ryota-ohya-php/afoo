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

        $books = $query->orderBy('created_at','desc')->paginate(10);

        $categories = Category::withCount('books')->get();

        return view('books.index',['books' => $books,'categories' =>$categories]);
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
        // validationを追加,確認画面に遷移させない
        $validated = $request->validate([
            'isbn' => ['required', 'digits:13'],
            'title' => ['required','string','max:500',],
            'author' => ['required','string','max:255',],
            'category_id' => ['required','string',],
            'publisher' => ['required','string','max:100',],
        ],
        [
            // エラーメッセージカスタマイズ
            'isbn.required' => 'isbn番号を入力してください。',
            'isbn.digits' => '13桁のisbn番号を入力してください。',
            
            'title.required' => 'タイトルは必須です。',
            'title.max' => 'タイトルは500文字以内です。',
            
            'author.required' => '著者は必須です。',
            'author.max' => '著者は255文字以内です。',

            'category_id.required' => 'カテゴリーIDは必須です。',

            'publisher.required' => '出版社は必須です。',
            'publisher.max' => '著者は100文字以内です。',

            
        ]);
        return view('books.confirm-create',['request'=>$request]);
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
        return view('books.show',['book'=>$book]);
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
        // validationを追加,確認画面に遷移させない
        $validated = $request->validate([
            'isbn' => ['required', 'digits:13'],
            'title' => ['required','string','max:500',],
            'author' => ['required','string','max:255',],
            'category_id' => ['required','string',],
            'publisher' => ['required','string','max:100',],
        ],
        [
            // エラーメッセージカスタマイズ
            'isbn.required' => 'isbn番号を入力してください。',
            'isbn.digits' => '13桁のisbn番号を入力してください。',
            
            'title.required' => 'タイトルは必須です。',
            'title.max' => 'タイトルは500文字以内です。',
            
            'author.required' => '著者は必須です。',
            'author.max' => '著者は255文字以内です。',

            'category_id.required' => 'カテゴリーIDは必須です。',
            
            'publisher.required' => '出版社は必須です。',
            'publisher.max' => '著者は100文字以内です。',             
        ]);
        return view('books.confirm-edit',['request'=>$request]);
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

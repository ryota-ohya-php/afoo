<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $id)
    {
        $book = \App\Models\Book::find($id);  
        return view('inventories.create', ['book'=>$book]);
    }

    // 登録確認画面
    public function confirm(Request $request)
    {
        // バリデーション（フォーム送信内容）
        $validated = $request->validate([
            'inventory_num' => ['required', 'numeric', 'min:1','digits_between:1,2'],
            'arrival_date'  => ['required', 'date', 'before:now', ],
            'remarks'       => ['nullable', 'string','max:100',],
        ],
        // エラーメッセージ
        [
            'inventory_num.required'        => '1回の登録は1～99冊までです。',
            'inventory_num.min'             => '1回の登録は1～99冊までです。',
            'inventory_num.digits_between'  => '1回の登録は1～99冊までです。',
            'arrival_date.date'             => '日付が正しくありません。',
            'arrival_date.before'           => '登録日より先の入荷は登録できません。',
            'remarks.max'                   => '備考は100文字以内です。',  
        ]);

        // 確認画面へ遷移       
		return view('inventories.confirm', ['request' =>$request]);
	}	

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 在庫テーブルに入力された在庫数分の行を登録
        $inventory_num = $request->inventory_num;
        for ($i=0; $i < $inventory_num ; $i++) { 
            $inventory = new Inventory;
            $inventory->book_id      = $request->book_id;
            $inventory->arrival_date = $request->arrival_date;
            $inventory->remarks      = $request->remarks;
            $inventory->save();

        }
        return redirect(route('books.show', $request->book_id))
        ->with('flash_message', '在庫登録が完了しました。');
    }



    // 未使用アクション
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function show(Inventory $inventory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function edit(Inventory $inventory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Inventory $inventory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Inventory  $inventory
     * @return \Illuminate\Http\Response
     */
    public function destroy(Inventory $inventory)
    {
        //
    }
}

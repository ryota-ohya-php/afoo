<?php

namespace App\Http\Controllers;

use App\Models\Lending;
use App\Models\Member;
use App\Models\Inventory;
use Illuminate\Http\Request;

class LendingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $lending=Lending::all();
        return view('lendings.index',['lending'=>$lending]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Lending::get()->has('id') == false) {
            
        }
        $inventory = Inventory::select('inventories.id','books.id','books.title');
        $inventory->join('books', 'inventories.book_id', '=', 'books.id');
        $inventories = $inventory->get();

        // $inventory=Lending::select('lendings.id,,
        //'inventory_id','books.title','lent_date','due_date','return_date');
        // $inventory->whereNull('return_date);
        // $inventory->join('inventories', 'lendings.inventory_id', '=', 'inventories.id');
        // $inventory->join('books', 'inventories.book_id', '=', 'books.id');
        // $inventories = $inventory->get();
        // dd($inventories);
        return view('lendings.create',['inventories'=>$inventories]);
    }
    
    // $mem=Lending::select('lendings.id','member_id','members.name','members.tel',
    //     'inventory_id','books.title','lent_date','due_date','return_date');
    //     $mem->where('member_id')
    //      ->whereNull('return_date');
    //     $mem->join('members', 'lendings.member_id', '=', 'members.id');
    //     $mem->join('inventories', 'lendings.inventory_id', '=', 'inventories.id');
    //     $mem->join('books', 'inventories.book_id', '=', 'books.id');
    //     $member=$mem->get();

    public function rebook()
    {
        return view('lendings.rebook');
    }
    public function confirm(Request $request)
    {

        // dd($request);
        return view('lendings.confirm',['request'=>$request]);

        //print_r($_POST['lend'][0]);
        foreach($_POST['lend'] as $num){
            
        
             $n=Lending::select('lendings.id','member_id','members.name','members.tel','inventory_id','books.title','lent_date','due_date');
             $n->where('lendings.id','=',$num);
             $n->join('members', 'lendings.member_id', '=', 'members.id');
             $n->join('inventories', 'lendings.inventory_id', '=', 'inventories.id');
             $n->join('books', 'inventories.book_id', '=', 'books.id');
             $data[]=$n->get();
            }
             
        
       
        return view('lendings.confirm',[
            'request'=>$request,
        'data'=>$data]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($request);
        $lend= new Lending;
        $lend->member_id=$request->member_id;
        $lend->inventory_id=$request->inventory_id;
        $lend->lent_date=$request->lent_date;
        $lend->remarks=$request->remarks;
        $lend->save();
        return view('lendings.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lending  $lending
     * @return \Illuminate\Http\Response
     */
    public function show(Lending $lending)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lending  $lending
     * @return \Illuminate\Http\Response
     */
    public function edit(Lending $lending)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lending  $lending
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lending $lending)
    {
        
        foreach($request->id as $val){
            $lend= Lending::find($val);
            $lend->return_date=$request->return_date;
            $lend->remarks=$request->remarks;
            $lend->save();
        }
        
        return redirect('lendings/rebook');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lending  $lending
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lending $lending)
    {
        //
    }
    public function add($id)
    {
        $mem=Lending::select('lendings.id','member_id','members.name','members.tel',
        'inventory_id','books.title','lent_date','due_date','return_date');
        $mem->where('member_id','=',$id)
        ->whereNull('return_date');

        $mem->join('members', 'lendings.member_id', '=', 'members.id');
        $mem->join('inventories', 'lendings.inventory_id', '=', 'inventories.id');
        $mem->join('books', 'inventories.book_id', '=', 'books.id');
        $member=$mem->get();
        
        return response()->json($member);
    }
}

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
       $keyword=$request->keyword;
        if(isset($keyword)){
            $lend=Lending::select('lendings.id','member_id','members.name',
            'books.author','inventory_id','books.title','lendings.lent_date','lendings.due_date');
            $lend->where('lend_flag', '=',1)
            ->where(function($q) use ($keyword){
                $q->orwhere('member_id','LIKE',"%$keyword%");
                $q->orwhere('title','LIKE',"%$keyword%");
            });
            $lend->join('members', 'lendings.member_id', '=', 'members.id');
            $lend->join('inventories', 'lendings.inventory_id', '=', 'inventories.id');
            $lend->join('books', 'inventories.book_id', '=', 'books.id');

        }else{

        $lend=Lending::select('lendings.id','member_id','members.name',
        'books.author','inventory_id','books.title','inventories.lend_flag','lent_date','due_date');
        $lend->where('lend_flag', '=',1);
        $lend->join('members', 'lendings.member_id', '=', 'members.id');
        $lend->join('inventories', 'lendings.inventory_id', '=', 'inventories.id');
        $lend->join('books', 'inventories.book_id', '=', 'books.id');

        }


        $lending=$lend->get();
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

        return view('lendings.create',['inventories'=>$inventories]);
    }
    

    public function rebook()
    {
        return view('lendings.rebook');
    }
    public function confirm(Request $request)
    {

        // dd($request);
        //return view('lendings.confirm',['request'=>$request]);

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
        'data'=>$data
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        foreach($request->id as $val){
            $in=Inventory::select('inventoryies.id','book_id','books.published_date');
            $in->where('inventoryies.id','=',$val);
            $in->join('books', 'inventories.book_id', '=', 'books.id');
            $publised_date[]=$in->published_date;
        }
        $today=date('Y-m-d');
        /* */ 
        foreach($publised_date as $pub){
            $pub_month=date('m', strtotime($pub))-date('m', strtotime($today));
        
            $lend= new Lending;
            $lend->member_id=$request->member_id;
            $lend->inventory_id=$request->inventory_id;
            $lend->lent_date=$request->lent_date;
            /*返却期限日の登録*/ 
            if($pub_month >= 3){
                $lend->due_date=date('Y-m-d',strtotime("day +15"));
            }else{
                $lend->due_date=date('Y-m-d',strtotime("day +10"));
            }
            $lend->remarks=$request->remarks;
            $lend->save();
        }
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
            
            $inv= Inventory::find($request->inventory_id);
            $inv->lend_flag=0;
            $inv->save();

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

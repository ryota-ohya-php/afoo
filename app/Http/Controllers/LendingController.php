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
        // 貸し出されていない在庫の情報を取ってくる
        $inventory=Inventory::select('inventories.id','lend_flag',
        'book_id','books.title');
        $inventory->join('books', 'inventories.book_id', '=', 'books.id');
        $inventory->where('lend_flag','=',0);
        $inventories = $inventory->get();

        // dd($inventories);
        // メンバーの情報もってくる
        $member = Member::select('members.id','members.name');
        $members=$member->get();
        
        return view('lendings.create',['inventories'=>$inventories,'members'=>$members]);
    }


    public function rebook()
    {
        return view('lendings.rebook');
    }
    public function confirm(Request $request)
    {
        //返却確認;
        if (isset($_POST['lend'])) 
        {
            foreach($_POST['lend'] as $num){
                $n=Lending::select('lendings.id','member_id','members.name','members.tel','inventory_id','books.title','lent_date','due_date');
                $n->where('lendings.id','=',$num);
                $n->join('members', 'lendings.member_id', '=', 'members.id');
                $n->join('inventories', 'lendings.inventory_id', '=', 'inventories.id');
                $n->join('books', 'inventories.book_id', '=', 'books.id');
                $data[]=$n->get();
                }
                // dd($data);
                return view('lendings.confirm',[
                    'request'=>$request,
                'data'=>$data]);
        }
        // 貸出確認
        if (isset($_POST['inventory'])) 
        {
            foreach($_POST['inventory'] as $num){
                // $n = Lending::select()
                $n=Inventory::select('inventories.id','books.title');
                $n->where('inventories.id','=',$num);
                $n->join('books', 'inventories.book_id', '=', 'books.id');
                $data[]=$n->get();
               }
               $member = Member::find($request->member_id);
               return view('lendings.confirm-create',[
                'request'=>$request,
            'data'=>$data]); 
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

        // dd($request);
        // 貸出テーブルに値をインサート
        // foreach ($request->id as $val)
        // {
        //     $lend= new Lending;
        //     $lend->member_id=$request->member_id;
        //     $lend->inventory_id=$val;
        //     $lend->lent_date=$request->lent_date;
        //     // $lend->due_date=$request->due_date;
        //     $lend->remarks=$request->remarks;
        //     $lend->save();
        //     // 在庫テーブルの貸出情報を貸出中にする
        //     $inventory= Inventory::find($val);
        //     $inventory->lend_flag = 1;
        //     $inventory->save();
        // }
        
        // return redirect('lendings');

        foreach($request->id as $val_id){
            // echo ($val_id);
            $in=Inventory::select('books.published_date');
            $in->where('inventories.id','=',$val_id);
            $in->join('books', 'inventories.book_id', '=', 'books.id');
            $published_date[$val_id] = $in->get();
            // $publised_date[]=$in->published_date;
            // echo $in->published_date;
            // exit;
            // dd($published_date);
        //  print_r($published_date);
            $today=date('Y-m-d');

        /* */ 
        // foreach($published_date as $key=>$pub){
        //     foreach($pub as $val){
            //    dd($published_date[$val_id]);
            // echo $val->published_date;
            // exit;
            // dd(date($val->published_date));
            $pub_date = (strtotime($today) - strtotime($published_date[$val_id]))/86400;
            // echo $pub_date .'<br>';
            
            $pub_mon = $pub_date/30;
            $pub_month = floor($pub_mon);

            // $pub_month=date('m', strtotime(date($val->published_date)))-date('m', strtotime($today));
        
            $lend= new Lending;
            $lend->member_id=$request->member_id;
            $lend->inventory_id=$val_id;
            $lend->lent_date=$request->lent_date;
            /*返却期限日の登録*/ 
            if($pub_month >= 3){
                $lend->due_date=date('Y-m-d',strtotime("+15 day"));
            }else{
                $lend->due_date=date('Y-m-d',strtotime("+10 day"));
            }
            $lend->remarks=$request->remarks;

            $lend->save();
            // echo $lend->toSql();
            $inventory= Inventory::find($val_id);
            $inventory->lend_flag = 1;
            $inventory->save();
            //     }
            // }
        }
        
        // exit;
        return redirect('lendings');

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
            
            dd($val);
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

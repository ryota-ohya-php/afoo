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

        $lend=Lending::select('lendings.id','member_id','members.name','lendings.inventory_id',

        'books.author','books.title','inventories.lend_flag','lent_date','due_date');
        
        $lend->join('members', 'lendings.member_id', '=', 'members.id');
        $lend->join('inventories', 'lendings.inventory_id', '=', 'inventories.id');
        $lend->join('books', 'inventories.book_id', '=', 'books.id');
        // $lend->where('new_lend_flag', '=',0);
        $lend->whereNull('return_date');


        }

        $lending=$lend->get();
        return view('lendings.index',['lending'=>$lending]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        // 貸し出されていない在庫の情報を取ってくる
        $inventory=Inventory::select('inventories.id','lend_flag',
        'book_id','books.title');
        $inventory->join('books', 'inventories.book_id', '=', 'books.id');
        $inventory->where('lend_flag','=',0);
        $inventories = $inventory->get();

        
        // メンバーの情報もってくる
        $member = Member::select('members.id','members.name');
        $members=$member->get();

        // メンバーの在庫情報取得
        $inve = Member::select('members.id','members.name','inventories.lend_flag','lendings.return_date');
        $inve->selectRaw('COUNT(members.id) as inv_coun');
        $inve->leftjoin('lendings', 'members.id', '=', 'lendings.member_id');
        $inve->leftjoin('inventories', 'lendings.inventory_id', '=', 'inventories.id');
        $inve->where('inventories.lend_flag','=',1);
        $inve->wherenull('lendings.return_date');
        $inve->groupBy('members.id');
        
        $test=$inve->get();
        
        if(isset($request->member_id)){
            $mem=$_GET['member_id'];
            return view('lendings.create',[
                'inventories'=>$inventories,
                'members'=>$members,
                'test'=>$test,
                'mem'=>$mem
            ]);
        }else{
            return view('lendings.create',[
                'inventories'=>$inventories,
                'members'=>$members,
                'test'=>$test,
                
            ]);
        }
    }


    public function rebook(Request $request)
    {
        
        
        if(isset($request->member_id)){
            $mem=$_GET['member_id'];
            
            return view('lendings.rebook',['mem'=>$mem]);
        }else{
            
        return view('lendings.rebook');
        }
    }
    public function confirm(Request $request)
    {

        $validated = $request->validate([
            'member_id'        => ['required',],
            'lent_date'       => [ 'date','before:now'],
            'return_date'       => [ 'date','before:now'],
            'remarks'       => ['nullable', 'string','max:100',],
        ],
        [
            // エラーメッセージ、一覧画面に表示。
                'member_id.required'        => '会員IDを入力してください。',
                'lent_date.before'             => '日付が正しくありません。',
                'return_date.before'             => '日付が正しくありません。',
                'remarks.max'                   => '備考は100文字以内です。',

            ]);
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

        foreach($request->id as $val_id){

            $in=Inventory::select('books.published_date');
            $in->where('inventories.id','=',$val_id);
            $in->join('books', 'inventories.book_id', '=', 'books.id');
            $published_date[$val_id] = $in->get();

            $today=date('Y-m-d');
            var_dump($today);
            // var_dump($published_date[$val_id]->pluck('published_date'));
            $pub = $published_date[$val_id]->pluck("published_date");
            $publishdate = $pub[0];
            $pub_date = (strtotime($today) - strtotime($publishdate))/86400;
            var_dump(strtotime($today));
            
            $pub_mon = $pub_date/30;
            var_dump($pub_mon);
            $pub_month = floor($pub_mon);
            var_dump($pub_month);
            // exit;

            // $pub_month=date('m', strtotime(date($val->published_date)))-date('m', strtotime($today));

        


            $lend= new Lending;
            $lend->member_id=$request->member_id;
            $lend->inventory_id=$val_id;
            $lend->lent_date=$request->lent_date;
            /*返却期限日の登録*/ 
            if ($request->lent_date == date('Y-m-d')) {
                    if($pub_month >= 3){
                        $lend->due_date=date('Y-m-d',strtotime("+15 day"));
                    }else{
                        $lend->due_date=date('Y-m-d',strtotime("+10 day"));
                    }
                }
            else{
                    if($pub_month >= 3){
                    $lend->due_date=date('Y-m-d',strtotime(date($request->lent_date).'+15 day'));
                    }else{
                    $lend->due_date=date('Y-m-d',strtotime(date($request->lent_date).'+10 day'));
                    }
                }
            
            $lend->remarks=$request->remarks;

            $lend->save();

            // echo $lend->toSql();

            $id =$lend->id;

            $inventory= Lending::select('lendings.id','inventories.lend_flag');
            $inventory->join('inventories', 'lendings.inventory_id', '=', 'inventories.id');
            $inventory->where('lendings.id','=',$id);
            $inventory->update(['inventories.lend_flag' => 1]);

            // $inventory = Inventory::select('inventories.id','')
            
            
            // echo $inventory->toSql();
            // $inventory->save();
            //     }
            //

        }
       

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
    public function rebooks(Request $request, Lending $lending)
    {
    //    dd($request);
        foreach($request->id as $val){
            //->id
            // dd($request->inventory_id);
            $lend= Lending::find($val);
            $lend->return_date=$request->return_date;
            $lend->remarks=$request->remarks;
            // $lend->new_lend_flag =1;
            $lend->save();
            

            $inv = Lending::select('lendings.id','inventory_id');
            $inv->join('inventories', 'lendings.inventory_id', '=', 'inventories.id');
            $inv->where('lendings.id','=',$val);
            $invs[$val] = $inv->get();
            $ii = $invs[$val]->pluck('inventory_id');
            // echo $ii[0];
            // echo 58;
            // exit;
            $inven= Inventory::find($ii[0]);
            $inven->lend_flag=0;
            $inven->save();

        }
        
        return redirect('lendings');

        
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
        ->wherenull('return_date');
        $mem->join('members', 'lendings.member_id', '=', 'members.id');
        $mem->join('inventories', 'lendings.inventory_id', '=', 'inventories.id');
        $mem->join('books', 'inventories.book_id', '=', 'books.id');
        $member=$mem->get();
        
        return response()->json($member);
    }
}

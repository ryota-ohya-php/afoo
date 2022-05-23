<?php

namespace App\Http\Controllers;

use App\Models\Member;

use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $mem=Member::select('id','name','tel');  
        if(isset($request->keyword)){      
            $mem=Member::select('id','name','tel');   
            $mem->where('id','LIKE',"%$request->keyword%");
            $mem->orwhere('name','LIKE',"%$request->keyword%");
            $mem->orwhere('tel','LIKE',"%$request->keyword%");
            $members=$mem->get();
        }else{
            $members = $mem->orderBy('id',)->paginate(10);
            /*$members=Member::all()->paginate(10);*/
        }
        return view('members.index',[
            'members'=>$members,
            'keyword'=>$request->keyword,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('members.create');
    }
    public function confirm(Request $request)
    {
        return view('members.confirm',['request'=>$request]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $member= new Member;
        $member->name=$request->name;
        $member->address=$request->address;
        $member->tel=$request->tel;
        $member->email=$request->email;
        $member->birthday=$request->birthday;
        $member->save();
        return redirect(route('members.index'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function show(Member $member)
    {
        /*$test=Member::find($member);*/
        return view('members.show',['member'=>$member]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit(Member $member)
    {

        
        $mem=Member::find($member);

        return view('members.edit',['member'=>$mem]);
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Member $member)
    {
       //echo $member->id;exit;
        $members= Member::find($member->id);
        $members->name=$request->name;
        $members->address=$request->address;
        $members->tel=$request->tel;
        $members->email=$request->email;
        $members->birthday=$request->birthday;
        $members->save();
        return redirect(route('members.show',$member->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $member)
    {
        $members= Member::find($member->id);;
        $members->delete();
        return redirect(route('members.index'));
    }
}

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
    public function index()
    {
        $members=Member::all();
        return view('members.index',['members'=>$members]);
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
        $test=Member::find($member);
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
        echo $member;exit;
        $member= Member::find($request);
        $member->name=$request->name;
        $member->address=$request->address;
        $member->tel=$request->tel;
        $member->email=$request->email;
        $member->birthday=$request->birthday;
        $member->save();
        return redirect(route('members.show'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $member)
    {
        //
    }
}

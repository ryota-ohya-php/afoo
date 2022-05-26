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
            
            /*$members=Member::all()->paginate(10);*/
        }$members = $mem->orderBy('id',)->paginate(10);
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
    // validationを追加,確認画面に遷移させない
        $validated = $request->validate([
            'name' => ['required','max:20',],
            'address' => ['required','string','max:255',],
            'tel' => ['required','regex:/^(0{1}\d{1,4}-{0,1}\d{1,4}-{0,1}\d{4})$/','string', 'min:10'],
            'birthday' => ['required', 'date',],
            'email' => ['nullable','string','max:255',],
        ],
        [
            // エラーメッセージカスタマイズ
            'name.required' => '会員名は必須です。',
            'name.max' => '会員名は20文字以内です。',

            'address.required' => '住所を入力してください。',
            'address.max' => '住所は255文字以内です。',

            'tel.required' => '電話番号は必須です。',
            'tel.regex' => '正しい電話番号をもう一度入力してください。',
            'tel.min' => '',

            'birthday.required' => '生年月日を入力してください。',
            'birthday.date' => '生年月日を正しい形式で入力してください。',

            'email.max' => 'メールアドレスは255文字以内です。',  
        ]);  
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
    // validationを追加,確認画面に遷移させない
        $validated = $request->validate([
            'name' => ['required','max:20',],
            'address' => ['required','string','max:255',],
            'tel' => ['required','regex:/^(0{1}\d{1,4}-{0,1}\d{1,4}-{0,1}\d{4})$/','string', 'min:10'],
            'birthday' => ['required', 'date',],
            'email' => ['nullable','string','max:255',],
        ],
        [
            // エラーメッセージカスタマイズ
            'name.required' => '会員名は必須です。',
            'name.max' => '会員名は20文字以内です。',

            'address.required' => '住所を入力してください。',
            'address.max' => '住所は255文字以内です。',

            'tel.required' => '電話番号は必須です。',
            'tel.regex' => '正しい電話番号をもう一度入力してください。',
            'tel.min' => '',

            'birthday.required' => '生年月日を入力してください。',
            'birthday.date' => '生年月日を正しい形式で入力してください。',

            'email.max' => 'メールアドレスは255文字以内です。',  
        ]);  
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

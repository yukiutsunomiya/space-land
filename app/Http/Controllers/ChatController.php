<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str; 
use Illuminate\Http\Request;
use App\Models\Chat;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       // ユーザー識別子がなければランダムに生成してセッションに登録
       if($request->session()->missing('user_identifier')){
         session(['user_identifier' => Str::random(20)]); 
        }

       // ユーザー名を変数に登録（デフォルト値：Guest）
       if($request->session()->missing('user_name')){
         session(['user_name' => 'Guest']); 
        }
       
       // データーベースの件数を取得
       $length = Chat::all()->count();

       // 画面に表示する件数を代入
       $display = 5;

       // 最新のチャットを画面に表示する分だけ取得して変数に代入
       //$chats = Chat::offset($length-$display)->limit($display)->get();

       $chats = Chat::all();
       // チャットデータをビューに渡して表示
       return view('chat',compact('chats'));
   }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // ユーザー名をフォームから取得してセッションに登録
       session(['user_name' => $request->user_name]);
        $chat = new Chat;
        $form = $request->all();
        $chat->fill($form)->save();
        return redirect('/chat');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

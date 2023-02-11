<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\sendMail;

class MainController extends Controller
{
    public function index(Request $request)
    {
        $products = DB::select('select * from products');
        return $products;                     
    }

    public function select(Request $request)
    {   
        $param = ['name' => $request -> name ];
        $product = DB::select('select * from products where name = :name', $param);
        return $product; 
    }

    public function commodity(Request $request)
    {
        $data = [
            'id' => $request -> id,
            'name' => $request -> name ,
            'price' => $request -> price ,
            'img1' => $request -> img1 ,
            'img2' => $request -> img2 ,
     
            ];
        return view('commodity',$data);
    }

    public function confirm(Request $request)
    {
        $user_id = auth()->id();
        if($request->has('cart')){
            $params= [
                'product_id' => $request -> product_id ,
                'name' => $request -> name ,
                'img1' => $request -> img1 ,
                'img2' => $request -> img2 ,
                'price' => $request -> price ,
                'user_id' => $user_id,
                'quantity' => $request -> quantity,
            ];
            DB::insert('insert into carts (product_id,name,price,img1,img2,user_id,quantity) values (:product_id,:name,:price,:img1,:img2,:user_id,:quantity)',$params);
            return redirect('/carts');

        }elseif($request->has('purchase')){
            $params= [
                'product_id' => $request -> product_id ,
                'name' => $request -> name ,
                'img1' => $request -> img1 ,
                'img2' => $request -> img2 ,
                'price' => $request -> price ,
                'user_id' => $user_id,
                'quantity' => $request -> quantity,
                'ship' => $request -> ship,
            ];
            $param= [
                'id' => $request -> id 
            ];
            DB::insert('insert into purchases (product_id,name,price,img1,img2,user_id,quantity,ship,created_at) values (:product_id,:name,:price,:img1,:img2,:user_id,:quantity,:ship,CURRENT_TIMESTAMP)',$params);
            DB::delete('delete from carts where id = :id',$param);
            return redirect('/purchases');
        }                     
    }

    public function carts(Request $request){
        $params= [
            'user_id' => auth()->id()
            ];
        $carts = DB::select('select * from carts where user_id = :user_id ORDER BY id DESC;',$params);
        return view('carts',['carts' => $carts]);
    }

    public function purchases(Request $request){
        $params= [
            'user_id' => auth()->id()
            ];
        $purchases = DB::select('select * from purchases where user_id = :user_id ORDER BY id DESC',$params);
        return view('purchases',['purchases' => $purchases]);
     }

    public function cartDeleate(Request $request){
        $param= [
            'id' => $request -> id
            ];
        DB::delete('delete from carts where id = :id',$param);
        return redirect('/carts');
    }

    public function cartDeleates(Request $request){
        $params= [
            'user_id' => $request -> user_id
            ];
        $carts = DB::delete('delete from carts where user_id = :user_id',$params);
        return redirect('/carts');
    }

    public function changeCart(Request $request){
        $user_id = auth()->id();
        $cart= [
            'product_id' => $request -> product_id ,
            'name' => $request -> name ,
            'img1' => $request -> img1 ,
            'img2' => $request -> img2 ,
            'price' => $request -> price ,
            'user_id' => $user_id,
            'quantity' => $request -> quantity
            ];
        return view('changeCart',$cart);
    }

    public function updateCart(Request $request){
        if($request->has('cart')){
            $params= [
                'id' => $request -> id ,
                'quantity' => $request -> quantity
                ];
            DB::update('update carts set quantity = :quantity where id = :id',$params);
            return redirect('/carts');
        }elseif($request->has('purchase')){
            $user_id = auth()->id();
            $params= [
                'product_id' => $request -> product_id ,
                'name' => $request -> name ,
                'img1' => $request -> img1 ,
                'img2' => $request -> img2 ,
                'price' => $request -> price ,
                'user_id' => $user_id,
                'quantity' => $request -> quantity
                ];
            DB::insert('insert into purchases (product_id,name,price,img1,img2,user_id,quantity,created_at) values (:product_id,:name,:price,:img1,:img2,:user_id,:quantity,CURRENT_TIMESTAMP)',$params);
            return redirect('/purchases');
        }
    }

    public function contactconfirm(Request $request){
        $contact= [
            'name' => $request -> name ,
            'email' => $request -> email ,
            'replyRequest' => $request -> replyRequest ,
            'subject' => $request -> subject ,
            'content' => $request -> content 
            ];
        return view('contactconfirm',$contact);
    }

    public function sendContact(Request $request){
        // バリデーション
        $request->validate([
            'email' => 'required|email',
        ]);
        // actionの値を取得
        //actionの値で分岐
        if($request->has('back')){
            // 戻るボタンの場合リダイレクト処理
            $contact= [
                'name' => $request -> name ,
                'email' => $request -> email ,
                'subject' => $request -> subject ,
                'content' => $request -> content ,
                ];
            return view('contact',$contact);
        }elseif($request->has('submit')){
            $user_id = auth()->id();
            $contact= [
                'name' => $request -> name ,
                'email' => $request -> email ,
                'replyRequest' => $request -> replyRequest ,
                'subject' => $request -> subject ,
                'content' => $request -> content ,
                'user_id' => $user_id,
                'admin_situation'  => $request -> admin_situation
                ];
            DB::insert('insert into contacts (name,email,replyRequest,subject,content,user_id,admin_situation) values (:name,:email,:replyRequest,:subject,:content,:user_id,:admin_situation)',$contact);
            // 送信ボタンの場合、送信処理
            // ユーザにメールを送信s
            \Mail::to($request -> email)->send(new sendMail($request -> name,$request -> email));
            // 自分にメールを送信
            \Mail::to('k317708@gmail.com')->send(new sendMail($request -> name,$request -> email));
            // 二重送信対策のためトークンを再発行
            $request->session()->regenerateToken();
            // 送信完了ページのviewを表示
            if($user_id != null){
                return redirect('/inquiryList');
            }else{
                return view('sendCompletely');
            }
            
        }
    }

    public function inquiryList(Request $request){
        $param= [
            'user_id' => auth()->id()
            ];
        $contacts = DB::select('select * from contacts where user_id = :user_id ORDER BY id DESC',$param);
        return view('inquiryList',['contacts' => $contacts]);
    }
    
    public function inquiry(Request $request){
        $param= [
            'id' => $request -> id
            ];
        $contact = DB::select('select * from contacts where id = :id',$param);
        return view('inquiry',['contact' => $contact[0]]);
    }

    public function user(Request $request){
        $param = [
            'id' =>  auth()->id() 
        ];
        $user = DB::select('select * from users where id = :id', $param);
        return view('user',['user' => $user[0]]);
    }

    public function userEdit(Request $request){
        $user = [
            'id' => $request -> id,
            'name'=> $request -> name,
            'furigana'=> $request -> furigana,
            'telephone'=> $request -> telephone,
            'email'=> $request -> email,
            'zipCode'=> $request -> zipCode,
            'prefectures'=> $request -> prefectures,
            'address'=> $request -> address,
            'password'=> $request -> password
        ];
        return view('userEdit',$user);
    }

    public function userUpdate(Request $request){    
        $params = [
            'id' => $request -> id,
            'name'=> $request-> name,
            'furigana'=> $request-> furigana,
            'telephone'=> $request-> telephone,
            'email'=> $request-> email,
            'zipCode'=> $request-> zipCode,
            'prefectures'=> $request -> prefectures,
            'address'=> $request -> address,
        ];
            DB::update('update users set name = :name,furigana = :furigana,telephone = :telephone,email = :email,zipCode = :zipCode,prefectures = :prefectures,address = :address where id = :id', $params);
        $param = [
            'id' => $request -> id,
        ];
        $user = DB::select('select * from users where id = :id', $param);
        return view('user',['user' => $user[0]]);
    }

}
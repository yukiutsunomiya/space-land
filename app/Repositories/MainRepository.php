<?php

namespace App\Repositories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Repositories\MainRepositoryInterface;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\AuthManager;
use App\Models\User;
use Illuminate\Support\Facades\Hash; 


use App\Mail\sendMail;

class MainRepository implements MainRepositoryInterface
{
    public function productsSelect()
    {
        $products = DB::select('select * from products');
        return $products;                     
    }

    public function productSelect(Request $request)
    {   
        $param = ['name' => $request -> name ];
        $product = DB::select('select * from products where name = :name', $param);
        return $product; 
    }

    public function cartInsert(Request $request){
        //$user_id = auth()->id();
        $params= [
            'product_id' => $request -> product_id ,
            'name' => $request -> name ,
            'img1' => $request -> img1 ,
            'img2' => $request -> img2 ,
            'price' => $request -> price ,
            'user_id' => $request -> user_id,
            'quantity' => $request -> quantity,
        ];
        DB::insert('insert into carts (product_id,name,price,img1,img2,user_id,quantity) values (:product_id,:name,:price,:img1,:img2,:user_id,:quantity)',$params);
    }

    public function purchaseInsert(Request $request){
        //$user_id = auth()->id();
        $params= [
            'product_id' => $request -> product_id ,
            'name' => $request -> name ,
            'img1' => $request -> img1 ,
            'img2' => $request -> img2 ,
            'price' => $request -> price ,
            'user_id' => $request -> user_id,
            'quantity' => $request -> quantity,
            'ship' => $request -> ship,
        ];
        DB::insert('insert into purchases (product_id,name,price,img1,img2,user_id,quantity,ship,created_at) values (:product_id,:name,:price,:img1,:img2,:user_id,:quantity,:ship,CURRENT_TIMESTAMP)',$params);
        //DB::insert('insert into purchases (product_id,name,price,img1,img2,user_id,quantity,created_at) values (:product_id,:name,:price,:img1,:img2,:user_id,:quantity,CURRENT_TIMESTAMP)',$params);
    }

    public function cartSelect(){
        $params= [
            'user_id' => auth()->id()
        ];
        $carts = DB::select('select * from carts where user_id = :user_id ORDER BY id DESC;',$params);
        return $carts;
    }

    public function purchases(){
        $params= [
            'user_id' => auth()->id()
            ];
        $purchases = DB::select('select * from purchases where user_id = :user_id ORDER BY id DESC',$params);
        return $purchases;
     }

    public function cartDelete(Request $request){
        $param= [
            'id' => $request -> id
        ];
        DB::delete('delete from carts where id = :id',$param);
        
    }

    public function cartDeletes(Request $request){
        $params= [
            'user_id' => $request -> user_id
        ];
        DB::delete('delete from carts where user_id = :user_id',$params);
    }

    public function cartUpdate($request){
        $params= [
            'id' => $request -> id ,
            'quantity' => $request -> quantity
            ];
        DB::update('update carts set quantity = :quantity where id = :id',$params);
        //return redirect('/carts');
    }

    public function inquiryList(){
        $param= [
            'user_id' => auth()->id()
        ];
        $contacts = DB::select('select * from contacts where user_id = :user_id ORDER BY id DESC',$param);
        return $contacts;
    }
    
    public function inquiry(Request $request){
        $param= [
            'id' => $request -> id
            ];
        $contact = DB::select('select * from contacts where id = :id',$param);
        return $contact;
    }

    public function contactInsertContainsUserId(Request $request){
        $contact= [
            'name' => $request -> name ,
            'email' => $request -> email ,
            'replyRequest' => $request -> replyRequest ,
            'subject' => $request -> subject ,
            'content' => $request -> content ,
            'user_id' => $request -> user_id,
            'admin_situation'  => $request -> admin_situation
        ];
        DB::insert('insert into contacts (name,email,replyRequest,subject,content,user_id,admin_situation,created_at) values (:name,:email,:replyRequest,:subject,:content,:user_id,:admin_situation,CURRENT_TIMESTAMP)',$contact);
    }

    public function contactInsert(Request $request){
        $contact= [
            'name' => $request -> name ,
            'email' => $request -> email ,
            'replyRequest' => $request -> replyRequest ,
            'subject' => $request -> subject ,
            'content' => $request -> content ,
            'admin_situation'  => $request -> admin_situation
        ];
        DB::insert('insert into contacts (name,email,replyRequest,subject,content,admin_situation,created_at) values (:name,:email,:replyRequest,:subject,:content,:admin_situation,CURRENT_TIMESTAMP)',$contact);
    }
    
    public function user(){
        $param = [
            'id' =>  auth()->id() 
        ];
        $user = DB::select('select * from users where id = :id', $param);
        return $user;
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
    }

    public function attemptLogin(array $credentials)
    {
        $auth = app(AuthManager::class); 
        // 認証処理
        if ($auth->guard()->attempt($credentials)) {
            $user = $auth->guard()->user();
            return $user;
        }
        return null; // 認証失敗時はnullを返す
    }

    public function userCreate($request)
    {
        $user = User::create([
            'name' => $request-> name,
            'email' => $request-> email,
            'password' => Hash::make($request-> password),
            'furigana' => $request-> furigana,
            'telephone' => $request-> telephone,
            'zipCode' => $request-> zipCode,
            'prefectures' => $request-> prefectures,
            'address' => $request-> address,
        ]);
        return $user;
    }

    public function userDelete(Request $request){    
        $params = ['id' => $request->id];
        DB::delete('DELETE FROM users WHERE id = :id', $params);
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $params= [
            'product_id' => $request -> product_id ,
            'name' => $request -> name ,
            'img1' => $request -> img1 ,
            'img2' => $request -> img2 ,
            'price' => $request -> price ,
            'user_id' => $user_id,
            'quantity' => $request -> quantity
            ];
        if($request->has('cart')){
            DB::insert('insert into carts (product_id,name,price,img1,img2,user_id,quantity) values (:product_id,:name,:price,:img1,:img2,:user_id,:quantity)',$params);
            return redirect('/carts');

        }elseif($request->has('purchase')){
            DB::insert('insert into purchases (product_id,name,price,img1,img2,user_id,quantity) values (:product_id,:name,:price,:img1,:img2,:user_id,:quantity)',$params);
            return redirect('/purchases');
        }                     
    }

    public function carts(Request $request){
        $params= [
            'user_id' => auth()->id()
            ];
        $carts = DB::select('select * from carts where user_id = :user_id',$params);
        return view('carts',['carts' => $carts]);
    }

    public function purchases(Request $request){
        $params= [
            'user_id' => auth()->id()
            ];
        $purchases = DB::select('select * from purchases where user_id = :user_id',$params);
        return view('purchases',['purchases' => $purchases]);
     }

    public function cartDeleate(Request $request){
        $params= [
            'id' => $request -> id
            ];
        $carts = DB::delete('delete from carts where id = :id',$params);
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
            DB::insert('insert into purchases (product_id,name,price,img1,img2,user_id,quantity) values (:product_id,:name,:price,:img1,:img2,:user_id,:quantity)',$params);
            return redirect('/purchases');
        }
    }
} 
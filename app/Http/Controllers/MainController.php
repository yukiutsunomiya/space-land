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
            DB::insert('insert into purchases (product_id,name,price,img1,img2,user_id,quantity) values (:product_id,:name,:price,:img1,:,:user_id,:quantity)',$params);
            return redirect('/purchases');
        }                     
    }

    public function carts(Request $request){
        $carts = DB::select('select * from carts');
        $carts_json = json_encode($carts);
        return view('carts',['carts' => $carts,'carts_json' =>$carts_json]);
    }

    public function purchases(Request $request){
        $purchases = DB::select('select * from purchases');
        return view('purchases',['purchases' => $purchases]);
     }
} 
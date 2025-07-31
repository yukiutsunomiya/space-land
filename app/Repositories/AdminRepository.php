<?php

namespace App\Repositories;
use App\Repositories\AdminRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Auth\AuthManager;
use App\Models\Admin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class AdminRepository implements AdminRepositoryInterface
{
    public function users(){
        $users = DB::select('select * from users');
        return $users;
    }

    public function user(Request $request){
        $param = ['id' => $request -> id ];
        $user = DB::select('select * from users where id = :id', $param);
        return $user[0];
    }

    public function purchaseForEachUser(Request $request){
        $param = ['id' => $request -> id ];
        $purchases = DB::select('select * from purchases where user_id = :id ORDER BY id DESC',$param);
        return $purchases;
    }

    public function purchaseSelectForShip(Request $request){
        $param = ['ship' => $request -> ship ];
        $purchases = DB::select('select * from purchases where ship = :ship ORDER BY id DESC',$param);
        return $purchases;
    }

    public function purchaseForEachUserAndShip(Request $request){
        $params= [
            'id' =>  $request -> id,
            'ship' =>  $request -> ship
        ];
        $purchases = DB::select('select * from purchases where user_id = :id and ship = :ship ORDER BY id DESC',$params);
        return $purchases;
    }

    public function userUpdateContainsPassword(Request $request){
        $param = [
            'id' => $request -> id,
            'name'=> $request-> name,
            'furigana'=> $request-> furigana,
            'telephone'=> $request-> telephone,
            'email'=> $request-> email,
            'zipCode'=> $request-> zipCode,
            'prefectures'=> $request -> prefectures,
            'address'=> $request -> address,
            'password'=> $request -> password
        ];
        DB::update('update users set name = :name,furigana = :furigana,telephone = :telephone,email = :email,zipCode = :zipCode,prefectures = :prefectures,address = :address,password = :password where id = :id', $param);
    }

    public function userUpdate(Request $request){
        $param = [
            'id' => $request -> id,
            'name'=> $request-> name,
            'furigana'=> $request-> furigana,
            'telephone'=> $request-> telephone,
            'email'=> $request-> email,
            'zipCode'=> $request-> zipCode,
            'prefectures'=> $request -> prefectures,
            'address'=> $request -> address,
        ];
        DB::update('update users set name = :name,furigana = :furigana,telephone = :telephone,email = :email,zipCode = :zipCode,prefectures = :prefectures,address = :address where id = :id', $param);
    }

    
    public function purchasesSelect(){
        $purchases = DB::select('select * from purchases ORDER BY id DESC');
        return $purchases;
    }

    public function purchaseSelect(Request $request){
        $param= [
            'ship' =>  $request -> ship_situation
        ];
        $purchases = DB::select('select * from purchases where ship = :ship ORDER BY id DESC',$param);
        return $purchases;
    }
    
    public function contactsSelect(){
        $contacts = DB::select('select * from contacts ORDER BY id DESC');
        return $contacts;
    }

    public function contactSelect(Request $request){
        $param= [
            'id' => $request -> id
        ];
        $contact = DB::select('select * from contacts where id = :id',$param);
        return $contact;
    }

    public function contactUpdate(Request $request){
        $params = [
            'id' => $request -> id,
            'admin_situation' => $request -> admin_situation
        ];
        DB::update('update contacts set admin_situation = :admin_situation where id = :id', $params);
    }

    public function purchaseUpdate(Request $request){
        $params = [
            'id' => $request -> id,
            'ship' => $request -> ship
        ];
        DB::update('update purchases set ship = :ship where id = :id', $params);
    }

    public function userDelete(Request $request){
        $param = ['id' => $request -> id ];
        DB::delete('delete from users where id = :id', $param);
    }

    public function cartSelect(Request $request){
        $param= [
            'user_id' =>  $request -> id
        ];
        $carts = DB::select('select * from carts where user_id = :user_id ORDER BY id DESC',$param);
        return $carts;
    }

    public function userInquiryList(Request $request){
        $param= [
            'user_id' =>  $request -> id
            ];
        $contacts = DB::select('select * from contacts where user_id = :user_id ORDER BY id DESC',$param);
        return $contacts;
    }

    public function userInquiry(Request $request){
        $param= [
            'id' =>  $request -> id
        ];
        $contact = DB::select('select * from contacts where id = :id',$param);
        return $contact[0];
    }

    public function productsSelect(){
        $products = DB::select('select * from products');
        return $products;
    }

    public function productSelect(Request $request){
        $param= [
            'id' =>  $request -> id
        ];
        $product = DB::select('select * from products where id = :id',$param);
        return $product[0];
    }

    public function attemptLogin(array $credentials): ?Admin
    {
        $admin = Admin::where('email', $credentials['email'])->first();

        if ($admin && Hash::check($credentials['password'], $admin->password)) {
            return $admin;
        }

        return null;
    }

    public function userCreate(Request $request)
    {
        $user = Admin::create([
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

}
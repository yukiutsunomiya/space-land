<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function users(Request $request){
        $users = DB::select('select * from users');
        return view('admin.users',['users' => $users]);
    }

    public function user(Request $request){
        $param = ['id' => $request -> id ];
        $user = DB::select('select * from users where id = :id', $param);
        return view('admin.user',['user' => $user[0]]);
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
        return view('admin.userEdit',$user);
    }

    public function userUpdate(Request $request){
        if($request->has('password')){
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
        }else{
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
        $param = [
            'id' => $request -> id,
        ];
        $user = DB::select('select * from users where id = :id', $param);
        return view('admin.user',['user' => $user[0]]);
    }

    public function userDelete(Request $request){
        $param = ['id' => $request -> id ];
        DB::delete('delete from users where id = :id', $param);
        return redirect('/admin/users');
        
    }

    public function carts(Request $request){
        $params= [
            'user_id' => auth()->id()
            ];
        $carts = DB::select('select * from carts where user_id = :user_id',$params);
        return view('carts',['carts' => $carts]);
    }
    
    public function orderHistory(Request $request){
        $purchases = DB::select('select * from purchases');
        return view('admin.orderHistory',['purchases' => $purchases]);
    }


    public function inquiryList(Request $request){
        $contacts = DB::select('select * from contacts');
        return view('admin.inquiryList',['contacts' => $contacts]);
    }
}

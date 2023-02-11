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
        $purchases = DB::select('select * from purchases where user_id = :id ORDER BY id DESC',$param);
        return view('admin.user',['user' => $user[0],'purchases' => $purchases]);
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

    public function userCart(Request $request){
        $param= [
            'user_id' =>  $request -> id
            ];
        $carts = DB::select('select * from carts where user_id = :user_id ORDER BY id DESC',$param);
        return view('admin.userCart',['carts' => $carts,'user_id' => $request -> id,'user_name' =>  $request -> name]);
    }

    public function userInquiryList(Request $request){
        $param= [
            'user_id' =>  $request -> id
            ];
        $contacts = DB::select('select * from contacts where user_id = :user_id ORDER BY id DESC',$param);
        return view('admin.userInquiryList',['contacts' => $contacts,'user_name' =>  $request -> name]);
    }

    public function userInquiry(Request $request){
        $param= [
            'id' =>  $request -> id
            ];
        $contact = DB::select('select * from contacts where id = :id',$param);
        return view('admin.userInquiry',['contact' => $contact[0],'user_name' =>  $request -> name]);
    }
    
    public function orderHistory(Request $request){
        $purchases = DB::select('select * from purchases ORDER BY id DESC');
        return view('admin.orderHistory',['purchases' => $purchases]);
    }

    public function inquiryList(Request $request){
        $contacts = DB::select('select * from contacts ORDER BY id DESC');
        return view('admin.inquiryList',['contacts' => $contacts]);
    }

    public function inquiry(Request $request){
        $param= [
            'id' => $request -> id
            ];
        $contact = DB::select('select * from contacts where id = :id',$param);
        return view('admin.inquiry',['contact' => $contact[0]]);
    }

    public function shipUpdate(Request $request){
        $params = [
            'id' => $request -> purchase_id,
            'ship' => $request -> ship
        ];
        DB::update('update purchases set ship = :ship where id = :id', $params);
        $param = [
            'id' => $request -> user_id,
        ];
        $user = DB::select('select * from users where id = :id', $param);
        $purchases = DB::select('select * from purchases where user_id = :id ORDER BY id DESC',$param);
        if($request->has('orderHistory')){
            return redirect('/admin/orderHistory');
        }elseif($request->has('user')){
            return view('admin.user',['user' => $user[0],'purchases' => $purchases]);
        }
        
    }

    public function situationUpdate(Request $request){
        $params = [
            'id' => $request -> id,
            'admin_situation' => $request -> admin_situation
        ];
        DB::update('update contacts set admin_situation = :admin_situation where id = :id', $params);
        $param = [
            'id' => $request -> id,
        ];
        $contact = DB::select('select * from contacts where id = :id',$param);
        if($request->has('user_name')){
            return view('admin.userInquiry',['contact' => $contact[0],'user_name' =>  $request -> user_name]);
        }else{
            return view('admin.inquiry',['contact' => $contact[0]]);
            
        }
    }

    
}

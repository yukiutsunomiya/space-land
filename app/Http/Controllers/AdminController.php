<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Image;

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
        return view('admin.userInquiryList',['contacts' => $contacts,'id' =>  $request -> id,'user_name' =>  $request -> name]);
    }

    public function userInquiry(Request $request){
        $param= [
            'id' =>  $request -> id
            ];
        $contact = DB::select('select * from contacts where id = :id',$param);
        return view('admin.userInquiry',['contact' => $contact[0],'user_name' =>  $request -> name]);
    }
    
    public function orderHistory(Request $request){
        $param= [
            'ship' =>  $request -> ship_situation
            ];
        if($request -> ship_situation === '全履歴'){
            $purchases = DB::select('select * from purchases ORDER BY id DESC');
        }else{
            $purchases = DB::select('select * from purchases where ship = :ship ORDER BY id DESC',$param);
        }
        return view('admin.orderHistory',['purchases' => $purchases,'ship_situation' => $request -> ship_situation]);
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
            'id' => $request -> id,
            'ship' => $request -> ship
        ];
        DB::update('update purchases set ship = :ship where id = :id', $params);
        if($request->has('orderHistory')){
            $param= [
                'ship' =>  $request -> ship_situation
            ];
            if($request -> ship_situation === '全履歴'){
                $purchases = DB::select('select * from purchases ORDER BY id DESC');
            }else{
                $purchases = DB::select('select * from purchases where ship = :ship ORDER BY id DESC',$param);
            }
            return view('admin.orderHistory',['purchases' => $purchases,'ship_situation' => $request -> ship_situation]);
        }elseif($request->has('user')){
            $params= [
                'id' =>  $request -> user_id,
                'ship' =>  $request -> ship_situation
            ];
            $purchases = DB::select('select * from purchases where user_id = :id and ship = :ship ORDER BY id DESC',$params);
            return view('admin.userOrderHistory',['purchases' => $purchases,'user_id' => $request -> user_id,'user_name' =>  $request -> user_name,'ship_situation' => $request -> ship_situation]);
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

    public function userOrderHistory(Request $request){
        if($request -> ship_situation === '全履歴'){
            $param = ['user_id' => $request -> user_id ];
            $purchases = DB::select('select * from purchases where user_id = :user_id ORDER BY id DESC',$param);
        }else{
            $params= [
                'user_id' => $request -> user_id ,
                'ship' =>  $request -> ship_situation
            ];
            $purchases = DB::select('select * from purchases where user_id = :user_id and ship = :ship ORDER BY id DESC',$params);
        }    
        return view('admin.userOrderHistory',['purchases' => $purchases,'user_id' => $request -> user_id,'user_name' =>  $request -> user_name,'ship_situation' => $request -> ship_situation]);
    }

    public function productRegistrationConfirmation(Request $request){
        // ディレクトリ名
        $dir = 'img';
        $img1 = '';
        $img2 = '';
        if($request->has('$img1')){
            // アップロードされたファイル名を取得
            $file_name = $request->file('img1')->getClientOriginalName();
            // imgディレクトリに画像を保存
            $request->file('img1')->store('public/' . $dir);
            // ファイル情報をDBに保存
            $image = new Image();
            $image->name = $file_name;
            $image->path = 'storage/' . $dir . '/' . $file_name;
            $image->save();
        }
        if($request->has('$img2')){
            // アップロードされたファイル名を取得
            $file_name = $request->file('img2')->getClientOriginalName();
            // imgディレクトリに画像を保存
            $request->file('img2')->store('public/' . $dir);
            // ファイル情報をDBに保存
            $image = new Image();
            $image->name = $file_name;
            $image->path = 'storage/' . $dir . '/' . $file_name;
            $image->save();
        }
        
        $products = [
            'name'=> $request-> name,
            'price'=> $request-> price,
            'img1'=> $request-> img1,
            'img2'=> $request-> img2,
            'description'=> $request-> description,
            'releaseYear'=> $request-> releaseYear,
            'releaseMonth'=> $request -> releaseMonth,
            'releaseDate'=> $request -> releaseDate,
            'situation'=> $request -> releaseDate,
        ];
        DB::insert('insert into products (name,price,img1,img2,description,releaseYear,releaseMonth,releaseDate,situation,created_at) values (:name,:price,:img1,:img2,:description,:releaseYear,:releaseMonth,:releaseDate,:situation,CURRENT_TIMESTAMP)',$products);
        return view('admin.productRegistrationConfirmation',$products);
    }

    public function products(Request $request){
        $products = DB::select('select * from products');
        return view('admin.products',['products' => $products]);
    }

    public function product(Request $request){
        $product = [
            'id'=> $request-> id,
            'name'=> $request-> name,
            'price'=> $request-> price,
            'img1'=> $request-> img1,
            'img2'=> $request-> img2,
            'description'=> $request-> description,
            'releaseYear'=> $request-> releaseYear,
            'releaseMonth'=> $request -> releaseMonth,
            'releaseDate'=> $request -> releaseDate,
            'order'=> $request -> order,
            'situation'=> $request -> releaseDate,
        ];
        return view('admin.product',$product);
    }

}

<?php

namespace App\Services;
use App\Repositories\AdminRepositoryInterface as AdminRepository;
use Illuminate\Http\Request;
use Auth;

class AdminService
{
    public function userUpdate(Request $request){
        $adminRepository = app() -> make("\App\Repositories\AdminRepository");
        if($request->has('password')){
            $adminRepository -> userUpdateContainsPassword($request);
        }else{
            $adminRepository -> userUpdate($request);
        }
        $user = $adminRepository -> user($request);
        return $user;
    }
    
    public function orderHistory(Request $request){
        $adminRepository = app() -> make("\App\Repositories\AdminRepository");
        if($request -> ship_situation === '選択してください。'){
            return back()->withInput();
        }elseif($request -> ship_situation === '全履歴'){
            $purchases = $adminRepository -> purchasesSelect();
        }else{
            $purchases = $adminRepository -> purchaseSelect($request);
        }
        return view('admin.orderHistory',['purchases' => $purchases,'ship_situation' => $request -> ship_situation]);
    }

    public function shipUpdate(Request $request){
        $adminRepository = app() -> make("\App\Repositories\AdminRepository");
        $adminRepository -> purchaseUpdate($request);
        if($request -> ship === '選択してください。'){
            return back()->withInput();
        }elseif($request->has('orderHistory')){
            if($request -> ship_situation === '全履歴'){
                $purchases = $adminRepository -> purchasesSelect();
            }else{
                $purchases = $adminRepository -> purchaseSelectForShip($request);
            }
            return view('admin.orderHistory',['purchases' => $purchases,'ship_situation' => $request -> ship]);
        }elseif($request->has('user')){
            $purchases = $adminRepository -> purchaseForEachUserAndShip($request);
            return view('admin.userOrderHistory',['purchases' => $purchases,'user_id' => $request -> user_id,'user_name' =>  $request -> user_name,'ship_situation' => $request -> ship]);
        }
    }

    public function situationUpdate(Request $request){
        $adminRepository = app() -> make("\App\Repositories\AdminRepository");
        $adminRepository -> contactUpdate($request);
        $contact = $adminRepository -> contactSelect($request);
        if($request->has('user_name')){
            return view('admin.userInquiry',['contact' => $contact[0],'user_name' =>  $request -> user_name]);
        }else{
            return view('admin.inquiry',['contact' => $contact[0]]);
        }
    }

    public function userOrderHistory(Request $request){
        $adminRepository = app() -> make("\App\Repositories\AdminRepository");
        if($request -> ship === '選択してください。'){
            return back()->withInput();
        }elseif($request -> ship === '全履歴'){
            $purchases = $adminRepository -> purchaseForEachUser($request);
        }else{
            $purchases = $adminRepository -> purchaseForEachUserAndShip($request);
        }    
        return view('admin.userOrderHistory',['purchases' => $purchases,'user_id' => $request -> user_id,'user_name' =>  $request -> user_name,'ship_situation' => $request -> ship]);
    }

    public function productRegistrationConfirmation(Request $request){
        $adminRepository = app() -> make("\App\Repositories\AdminRepository");
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
        
        $product = [
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
        $adminRepository -> productInsert($request);
        return $product;
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
<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Image;
use App\Services\AdminService;
use App\Repositories\AdminRepositoryInterface as AdminRepository;

class AdminController extends Controller
{
    public function users(Request $request,AdminRepository $adminRepository){
        $users = $adminRepository -> users();
        return view('admin.users',['users' => $users]);
    }

    public function user(Request $request,AdminRepository $adminRepository){
        $user = $adminRepository -> user($request);
        $purchases = $adminRepository -> purchaseForEachUser($request);
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

    public function userUpdate(Request $request,AdminService $adminService){
        $user =$adminService -> userUpdate($request);
        return view('admin.user',['user' => $user[0]]);
    }

    public function userDelete(Request $request,AdminRepository $adminRepository){
        $adminRepository -> userDelete($request);
        return redirect('/admin/users');
    }

    public function userCart(Request $request,AdminRepository $adminRepository){
        $carts = $adminRepository -> cartSelect($request);
        return view('admin.userCart',['carts' => $carts,'user_id' => $request -> id,'user_name' =>  $request -> name]);
    }

    public function userInquiryList(Request $request,AdminRepository $adminRepository){
        $contacts = $adminRepository -> userInquiryList($request);
        return view('admin.userInquiryList',['contacts' => $contacts,'id' =>  $request -> id,'user_name' =>  $request -> name]);
    }

    public function userInquiry(Request $request,AdminRepository $adminRepository){
        $contact = $adminRepository -> userInquiry($request);
        return view('admin.userInquiry',['contact' => $contact[0],'user_name' =>  $request -> name]);
    }
    
    public function orderHistory(Request $request,AdminService $adminService){
        $purchases = $adminService -> orderHistory($request);
        return view('admin.orderHistory',['purchases' => $purchases,'ship_situation' => $request -> ship_situation]);
    }

    public function inquiryList(Request $request,AdminRepository $adminRepository){
        $contacts = $adminRepository -> contactsSelect();
        return view('admin.inquiryList',['contacts' => $contacts]);
    }

    public function inquiry(Request $request,AdminRepository $adminRepository){
        $contact = $adminRepository -> contactSelect($request);
        return view('admin.inquiry',['contact' => $contact[0]]);
    }
    
    public function shipUpdate(Request $request,AdminService $adminService){
        $redirect = $adminService -> shipUpdate($request);
        return $redirect;
    }

    public function situationUpdate(Request $request,AdminService $adminService){
        $redirect = $adminService -> situationUpdate($request);
        return $redirect;
    }

    public function userOrderHistory(Request $request,AdminService $adminService){
        $redirect = $adminService -> userOrderHistory($request);
        return $redirect;
    }

    public function productRegistrationConfirmation(Request $request,AdminService $adminService){
        $product = adminService -> productRegistrationConfirmation($request);
        return view('admin.productRegistrationConfirmation',$products);
    }

    public function products(Request $request,AdminRepository $adminRepository){
        $products = $adminRepository ->productsSelect();
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

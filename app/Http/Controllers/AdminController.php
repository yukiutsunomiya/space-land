<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Image;
use App\Services\AdminService;
use App\Repositories\AdminRepositoryInterface as AdminRepository;

class AdminController extends Controller
{
    public function users(AdminRepository $adminRepository){
        $users = $adminRepository -> users();
        return $users;
    }

    public function user(Request $request,AdminRepository $adminRepository){
        $user = $adminRepository -> user($request);
        //$purchases = $adminRepository -> purchaseForEachUser($request);
        return $user;
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
        $adminService -> userUpdate($request);
    }

    public function userDelete(Request $request,AdminRepository $adminRepository){
        $adminRepository -> userDelete($request);
        return redirect('/admin/users');
    }

    public function userCart(Request $request,AdminRepository $adminRepository){
        $carts = $adminRepository -> cartSelect($request);
        return $carts;
    }

    public function userInquiryList(Request $request,AdminRepository $adminRepository){
        $contacts = $adminRepository -> userInquiryList($request);
        return $contacts;
    }

    public function userInquiry(Request $request,AdminRepository $adminRepository){
        $contact = $adminRepository -> userInquiry($request);
        return $contact;
    }
    
    public function orderHistory(Request $request,AdminService $adminService){
        $purchases  = $adminService -> orderHistory($request);
        return $purchases;
    }

    public function inquiryList(AdminRepository $adminRepository){
        $contacts = $adminRepository -> contactsSelect();
        return $contacts;
    }

    public function inquiry(Request $request,AdminRepository $adminRepository){
        $contact = $adminRepository -> contactSelect($request);
        return $contact[0];
    }
    
    public function shipUpdate(Request $request,AdminRepository $adminRepository){
        $adminRepository -> purchaseUpdate($request);
        //$redirect = $adminService -> shipUpdate($request);
        //return $redirect;
    }

    public function situationUpdate(Request $request,AdminRepository $adminRepository){
        //$adminService -> situationUpdate($request);
        $adminRepository -> contactUpdate($request);
        //$redirect = $adminService -> situationUpdate($request);
        //return $redirect;
    }

    public function userOrderHistory(Request $request,AdminService $adminService){
        $redirect = $adminService -> userOrderHistory($request);
        return $redirect;
    }

    public function productRegistrationConfirmation(Request $request,AdminService $adminService){
        $products = $adminService -> productRegistrationConfirmation($request);
        return view('admin.productRegistrationConfirmation',$products);
    }

    public function products(AdminRepository $adminRepository){
        $products = $adminRepository ->productsSelect();
        return view('admin.products',['products' => $products]);
    }

    public function product(Request $request,AdminRepository $adminRepository){
        $product = $adminRepository -> productSelect($request);
        return $product;
    }

    public function userPurchases(Request $request,AdminRepository $adminRepository){
        $purchases = $adminRepository ->purchaseForEachUser($request);
        return $purchases;
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MainService;
use App\Repositories\MainRepositoryInterface as MainRepository;

class MainController extends Controller
{

    public function index(MainRepository $mainRepository)
    { 
        return $mainRepository -> productsSelect();
    }

    public function select(Request $request,MainRepository $mainRepository)
    {   
        return $mainRepository -> productSelect($request);
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

    public function confirm(Request $request,MainService $mainService)
    { 
        $mainService -> confirm($request,$mainService);

    }

    public function carts(MainRepository $mainRepository){
        $carts = $mainRepository -> cartSelect();
        return $carts;
    }

    public function purchases(MainRepository $mainRepository){
        $purchases = $mainRepository -> purchases();
        return $purchases;
     }

    public function cartDelete(Request $request,MainRepository $mainRepository){
        $mainRepository -> cartDelete($request);
    }

    public function cartDeletes(Request $request,MainRepository $mainRepository){
        $mainRepository -> cartDeletes($request);
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

    public function updateCart(Request $request,MainService $mainService){
        $mainService -> updateCart($request,$mainService);
    }

    public function sendContact(Request $request,MainService $mainService){
        $mainService -> sendContact($request,$mainService);
    }

    public function inquiryList(Request $request,MainRepository $mainRepository){
        $contacts = $mainRepository -> inquiryList();
        return $contacts;
    }
    
    public function inquiry(Request $request,MainRepository $mainRepository){
        $contact = $mainRepository -> inquiry($request);
        return $contact[0];
    }

    public function user(Request $request,MainRepository $mainRepository){
        $user = $mainRepository -> user();
        return view('user',['user' => $user[0]]);
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
        return view('userEdit',$user);
    }

    public function userUpdate(Request $request,MainRepository $mainRepository){
        $mainRepository -> userUpdate($request);
    }

    public function userDelete(Request $request,MainRepository $mainRepository){
        $mainRepository -> userDelete($request);
    }

}
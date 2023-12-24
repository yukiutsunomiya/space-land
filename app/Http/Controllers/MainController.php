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
        $redirect = $mainService -> confirm($request,$mainService);
        return $redirect;
    }

    public function carts(Request $request,MainRepository $mainRepository){
        $carts = $mainRepository -> cartSelect();
        return view('carts',['carts' => $carts]);
    }

    public function purchases(Request $request,MainRepository $mainRepository){
        $purchases = $mainRepository -> purchases();
        return view('purchases',['purchases' => $purchases]);
     }

    public function cartDeleate(Request $request,MainRepository $mainRepository){
        $mainRepository -> cartDeleate($request);
        return redirect('/carts');
    }

    public function cartDeleates(Request $request,MainRepository $mainRepository){
        $mainRepository -> cartDeleates();
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

    public function updateCart(Request $request,MainService $mainService){
        $redirect = $mainService -> updateCart($request,$mainService);
        return $redirect;
    }

    public function contactconfirm(Request $request){
        $contact= [
            'name' => $request -> name ,
            'email' => $request -> email ,
            'replyRequest' => $request -> replyRequest ,
            'subject' => $request -> subject ,
            'content' => $request -> content 
            ];
        return view('contactconfirm',$contact);
    }

    public function sendContact(Request $request,MainService $mainService){
        $redirect = $mainService -> sendContact($request,$mainService);
        return $redirect;
    }

    public function inquiryList(Request $request,MainRepository $mainRepository){
        $contacts = $mainRepository -> inquiryList();
        return view('inquiryList',['contacts' => $contacts]);
    }
    
    public function inquiry(Request $request,MainRepository $mainRepository){
        $contact = $mainRepository -> inquiry($request);
        return view('inquiry',['contact' => $contact[0]]);
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
        $user = $mainRepository -> user();
        return view('user',['user' => $user[0]]);
    }

}
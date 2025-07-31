<?php
namespace App\Repositories;
use Illuminate\Http\Request;

interface AdminRepositoryInterface
{
    public function users();
    public function user(Request $request);
    public function purchaseForEachUser(Request $request);
    public function purchaseSelectForShip(Request $request);
    public function purchaseForEachUserAndShip(Request $request);
    public function userUpdateContainsPassword(Request $request);
    public function userUpdate(Request $request);
    public function purchasesSelect();
    public function purchaseSelect(Request $request);
    public function contactsSelect();
    public function contactSelect(Request $request);
    public function contactUpdate(Request $request);
    public function purchaseUpdate(Request $request);
    public function userDelete(Request $request);
    public function cartSelect(Request $request);
    public function userInquiryList(Request $request);
    public function userInquiry(Request $request);
    public function productsSelect();
    public function attemptLogin(array $credentials);
    public function userCreate(Request $request);
}
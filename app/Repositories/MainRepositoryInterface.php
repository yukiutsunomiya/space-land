<?php
namespace App\Repositories;
use Illuminate\Http\Request;

interface MainRepositoryInterface
{
    public function productsSelect();
    public function productSelect(Request $request);
    public function cartInsert(Request $request);
    public function purchaseInsert(Request $request);
    public function cartSelect();
    public function purchases();
    public function cartDelete(Request $request);
    public function cartDeletes(Request $request);
    public function cartUpdate($request);
    public function inquiryList();
    public function inquiry(Request $request);
    public function contactInsertContainsUserId(Request $request);
    public function contactInsert(Request $request);
    public function user();
    public function userUpdate(Request $request);
    public function attemptLogin(array $credentials);
    public function userCreate($request);
    public function userDelete(Request $request);
}
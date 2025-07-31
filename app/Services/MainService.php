<?php

namespace App\Services;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Auth;
use App\Repositories\MainRepositoryInterface as MainRepository;

use App\Mail\sendMail;

class MainService
{
    public function confirm(Request $request)
    {
        $mainRepository = app() -> make("\App\Repositories\MainRepository");
        if($request->input('action') =='cart'){
            $mainRepository -> cartInsert($request);
            //return redirect('/carts');
        }elseif($request->input('action') =='purchase'){
            $mainRepository -> purchaseInsert($request);
            $mainRepository -> cartDelete($request);
            //メッセージ内容
            $user_name = auth()->user()->name;
            $commodity_name = $request -> name;
            $commodity_quantity = $request -> quantity;
            $message = '只今'.$user_name.'様が'.$commodity_name.'を'.$commodity_quantity.'個購入いたしました。';
            //LINEから取得したトークン
            $token = 'qr7Q7NggWBgvMBD4sC2VByc0dvQb4chd91aEtnuyUNP';
            //APIのURL
            $url = 'https://notify-api.line.me/api/notify';
            $query = array(
                'message' => $message, 
            );
            
            //URLエンコードされたクエリ文字列を生成
            $content = http_build_query($query, '', '&');
            
            //ヘッダ設定
            $header = array(
                'Content-Type: application/x-www-form-urlencoded', //form送信の際、クライアントがWebサーバーに送信するコンテンツタイプ
                'Content-Length: '.strlen($content), //メッセージ本文の長さ
                'Authorization: Bearer ' . $token,
            );
            
            //ストリームコンテキスト設定
            $context = array(
                'http' => array(
                    'ignore_errors' => true, //ステータスコードが失敗を意味する場合でもコンテンツを取得
                    'method' => 'POST', //メソッド。デフォルトはGET
                    'header' => implode("\r\n", $header), //ヘッダ設定
                    'content' => $content //送信したいデータ
                )
            );
            $res = file_get_contents($url, false, stream_context_create($context));
            var_dump($res); //string(29) "{"status":200,"message":"ok"}"
            //ここまでLINE通知

            //return redirect('/purchases');
        }                     
    }

    public function updateCart(Request $request){
        $mainRepository = app() -> make("\App\Repositories\MainRepository");
        if($request->input('action') =='cart'){
            $mainRepository -> cartUpdate($request);
            //return redirect('/carts');
        }elseif($request->input('action') =='purchase'){
            $mainRepository -> purchaseInsert($request);
            $mainRepository -> cartDelete($request);
            //メッセージ内容
            $user_name = auth()->user()->name;
            $commodity_name = $request -> name;
            $commodity_quantity = $request -> quantity;
            $message = '只今'.$user_name.'様が'.$commodity_name.'を'.$commodity_quantity.'個購入いたしました。';
            //LINEから取得したトークン
            $token = 'qr7Q7NggWBgvMBD4sC2VByc0dvQb4chd91aEtnuyUNP';
            //APIのURL
            $url = 'https://notify-api.line.me/api/notify';
            $query = array(
                'message' => $message, 
            );
            
            //URLエンコードされたクエリ文字列を生成
            $content = http_build_query($query, '', '&');
            
            //ヘッダ設定
            $header = array(
                'Content-Type: application/x-www-form-urlencoded', //form送信の際、クライアントがWebサーバーに送信するコンテンツタイプ
                'Content-Length: '.strlen($content), //メッセージ本文の長さ
                'Authorization: Bearer ' . $token,
            );
            
            //ストリームコンテキスト設定
            $context = array(
                'http' => array(
                    'ignore_errors' => true, //ステータスコードが失敗を意味する場合でもコンテンツを取得
                    'method' => 'POST', //メソッド。デフォルトはGET
                    'header' => implode("\r\n", $header), //ヘッダ設定
                    'content' => $content //送信したいデータ
                )
            );
            $res = file_get_contents($url, false, stream_context_create($context));
            var_dump($res); //string(29) "{"status":200,"message":"ok"}"
            //ここまでLINE通知

            //return redirect('/purchases');
        }
    }

    public function sendContact(Request $request){
        $mainRepository = app() -> make("\App\Repositories\MainRepository");
        // バリデーション
        $request->validate([
            'email' => 'required|email',
        ]);
        if ($request->user_id !== "") {
            $mainRepository -> contactInsertContainsUserId($request);
        }else{
            $mainRepository -> contactInsert($request);
        }

        // actionの値を取得
            
            /*
            // 送信ボタンの場合、送信処理
            // ユーザにメールを送信
            \Mail::to($request -> email)->send(new sendMail($request -> name,$request -> email));
            // 自分にメールを送信
            \Mail::to('k317708@gmail.com')->send(new sendMail($request -> name,$request -> email));
            // 二重送信対策のためトークンを再発行
            $request->session()->regenerateToken();
            // 送信完了ページのviewを表示
            */

            //LINEメッセージ内容
            $user_name = $request->name;
            $email = $request -> email ;
            $replyRequest = $request -> replyRequest;
            $subject = $request -> subject;
            $content = $request -> content;
            $message = '只今'.$user_name.'様が問い合わせをお送り致しました。返信希望は'.$replyRequest.'です。メールアドレスは'.$email.'です。件名は'.$subject.'です。問い合わせ内容は'.$content.'です。';
            //LINEから取得したトークン
            $token = 'qr7Q7NggWBgvMBD4sC2VByc0dvQb4chd91aEtnuyUNP';
            //APIのURL
            $url = 'https://notify-api.line.me/api/notify';
            $query = array(
                'message' => $message, 
            );
            
            //URLエンコードされたクエリ文字列を生成
            $content = http_build_query($query, '', '&');
            
            //ヘッダ設定
            $header = array(
                'Content-Type: application/x-www-form-urlencoded', //form送信の際、クライアントがWebサーバーに送信するコンテンツタイプ
                'Content-Length: '.strlen($content), //メッセージ本文の長さ
                'Authorization: Bearer ' . $token,
            );
            
            //ストリームコンテキスト設定
            $context = array(
                'http' => array(
                    'ignore_errors' => true, //ステータスコードが失敗を意味する場合でもコンテンツを取得
                    'method' => 'POST', //メソッド。デフォルトはGET
                    'header' => implode("\r\n", $header), //ヘッダ設定
                    'content' => $content //送信したいデータ
                )
            );
            $res = file_get_contents($url, false, stream_context_create($context));
            //var_dump($res); //string(29) "{"status":200,"message":"ok"}"
            //ここまでLINE通知
            /*
            if(Auth::check()){
                return redirect('/inquiryList');
            }else{
                return view('sendCompletely');
            }
            */
            
        
    }

}
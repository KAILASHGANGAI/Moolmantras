<?php

namespace App\Http\Controllers;

use App\Repositories\Payment\Khalti;
use Illuminate\Http\Request;

class KhaltiController extends Controller
{
    public function checkout(){
        return (new Khalti)->pay(
            1000,
            route('khalti.verification',['product' => 'product']),
            uniqid(),
            'Test'
        );
      }
      public function verification(Request $request){
            $khalti = new Khalti;
           $status = $request->status;
            $signature  = $request->signature;
            $transaction_code  = $request->transaction_code;
            $total_amount  = $request->total_amount;
            $transaction_uuid  = $request->transaction_uuid;
            $product_code  = $request->product_code;
            $success_url  = $request->success_url;
            $signed_field_names  = $request->signed_field_names;
            $inquiry= $khalti->inquiry($transaction_code, [
                'status' => $status,
                'signature' => $signature,
                'transaction_code' => $transaction_code,
                'total_amount' => $total_amount,
                'transaction_uuid' => $transaction_uuid,
                'product_code' => $product_code,
                'success_url' => $success_url,
                'signed_field_names' => $signed_field_names,
            ]);
         $pstatus =  $khalti->isSuccess($inquiry);

         if ($pstatus) {
            dd( 'sucess');
         }else{
            dd('fail');
         }
      }
}

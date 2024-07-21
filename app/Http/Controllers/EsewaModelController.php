<?php

namespace App\Http\Controllers;

use App\Models\EsewaModel;
use App\Models\Product;
use App\Repositories\Payment\Esewa;
use Illuminate\Http\Request;
// init composer autoloader.
require '../vendor/autoload.php';


use RemoteMerge\Esewa\Client as EsewaClient;
use RemoteMerge\Esewa\Config as EsewaConfig;

class EsewaModelController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(EsewaModel $esewaModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EsewaModel $esewaModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EsewaModel $esewaModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EsewaModel $esewaModel)
    {
        //
    }
    public function checkout()
    {
        return (new Esewa)->pay(
            1000,
            route('esewa.verification', ['product' => "test"]),
            125,
            'epayment test'
        );
    }

    public function verification(Product $product)
    {
        dd($product);
        $esewa = new Esewa;
        $decodedString = base64_decode($request->data);
        $data = json_decode($decodedString, true);
        $transaction_code = $data['transaction_code'] ?? null;
        $status = $data['status'] ?? null;
        $total_amount = $data['total_amount'] ?? null;
        $transaction_uuid = $data['transaction_uuid'] ?? null;
        $product_code = $data['product_code'] ?? null;
        $signed_field_names = $data['signed_field_names'] ?? null;
        $signature = $data['signature'] ?? null;
        $inquiry = $esewa->inquiry($transaction_uuid, [
            'transaction_code' => $transaction_code,
            'status' => $status,
            'total_amount' => $total_amount,
            'transaction_uuid' => $transaction_uuid,
            'product_code' => $product_code,
            'signed_field_names' => $signed_field_names,
            'signature' => $signature,
        ]);
        $status =  $esewa->isSuccess($inquiry);
        dd($status);
        if ($status) {
        }
    }



    //
    public function esewaPay(Request $request)
    {
        $pid = uniqid();
        $amount = $request->amount ?? 100;

        //    Order::insert([
        //        'user_id' => $request->user_id,
        //        'name' => $request->name,
        //        'email' => $request->email,
        //        'product_id' => $pid,
        //        'amount' => $request->amount,
        //        'esewa_status' => 'unverified',
        //        'created_at' => Carbon::now(),
        //    ]);



        // set success and failure callback urls
        $successUrl = url('/success');
        $failureUrl = url('/failure');

        // config for development
        $config = new EsewaConfig($successUrl, $failureUrl);


        // initialize eSewa client
        $esewa = new EsewaClient($config);

        $esewa->process($pid, $amount, 0, 0, 0);
    }


    public function esewaPaySuccess()
    {
        //do when pay success.
        $pid = $_GET['oid'];
        $refId = $_GET['refId'];
        $amount = $_GET['amt'];

        //    $order = Order::where('product_id', $pid)->first();
        //    //dd($order);
        //    $update_status = Order::find($order->id)->update([
        //        'esewa_status' => 'verified',
        //        'updated_at' => Carbon::now(),
        //    ]);
        //  if ($update_status) {
        //send mail,....
        //
        $msg = 'Success';
        $msg1 = 'Payment success. Thank you for making purchase with us.';
        dd($msg1);
        return view('thankyou', compact('msg', 'msg1'));
        //   }
    }

    public function esewaPayFailed()
    {
        //do when payment fails.
        $pid = $_GET['pid'];
        //    $order = Order::where('product_id', $pid)->first();
        //    //dd($order);
        //    $update_status = Order::find($order->id)->update([
        //        'esewa_status' => 'failed',
        //        'updated_at' => Carbon::now(),
        //    ]);
        //  if ($update_status) {
        //send mail,....
        //
        $msg = 'Failed';
        $msg1 = 'Payment is failed. Contact admin for support.';
        dd($msg1);
        return view('thankyou', compact('msg', 'msg1'));
        //  }
    }
}

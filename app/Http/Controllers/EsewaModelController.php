<?php

namespace App\Http\Controllers;

use App\Models\EsewaModel;
use App\Models\PaymentDetail;
use App\Models\Product;
use App\Repositories\BaseRepository;
use App\Repositories\Payment\Esewa;
use App\Traits\CommonTrait;
use Illuminate\Http\Request;
// init composer autoloader.
require '../vendor/autoload.php';


use RemoteMerge\Esewa\Client as EsewaClient;
use RemoteMerge\Esewa\Config as EsewaConfig;

class EsewaModelController extends Controller
{
    use CommonTrait;
    protected $repository;

    function __construct(BaseRepository $repository)
    {
        $this->repository = $repository;
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
    public function success(Request $request)
    {
        $oid = $_GET['oid'];
        $amt = $_GET['amt'];
        $refId = $_GET['refId'];
        $where = [
            'transectionCode' => $refId,
        ];

        $data = [
            'transectionCode' => $refId,

            'orderNumber' => null,
            'oid' => $oid,
            'status' => 'success',
            'paymentMethod' => 'ESEWA',
            'amount' => $amt
        ];

        $this->repository->createOrUpdate(
            PaymentDetail::query(),
            $where,
            $data
        );


        $data = [
            'menuCategories' => $this->maincategory()
        ];


        return view('payment.success', $data);
    }
    public function failure(Request $request)
    {

        $data = [
            'menuCategories' => $this->maincategory()
        ];


        return view('payment.failure', $data);
    }
}

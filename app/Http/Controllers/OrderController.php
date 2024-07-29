<?php

namespace App\Http\Controllers;

#require '../vendor/autoload.php';

use App\Models\Customer;
use App\Models\DelivaryLocation;
use App\Models\OrderProduct;
use App\Models\PaymentDetail;
use App\Repositories\BaseRepository;
use App\Repositories\Payment\Fonepay;
use App\Traits\CommonTrait;
use RemoteMerge\Esewa\Client as EsewaClient;
use RemoteMerge\Esewa\Config as EsewaConfig;
use Exception;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Return_;

class OrderController extends Controller
{
    use CommonTrait;
    private BaseRepository $repo;
    public function __construct(BaseRepository $repo)
    {
        $this->repo = $repo;
    }
    public function checkout(Request $request)
    {

        $request->validate([
            'name' => ['required', 'string', 'min:4'],
            'email' => ['required', 'email'],
            'provinces' => ['required', 'string'],
            'district' => ['required', 'string'],
            'wardno' => ['required', 'integer'],
            'address1' => ['required', 'string'],
        ]);

        try {

            $payentMethod = null;
            $delivary = [];
            DB::beginTransaction();

            // Login  if checked create Account
            if (@$request->createAccount) {
                $user =  $this->repo->register($request);
                if (@$user) {
                    Auth::login($user);
                }
            }

            //check payment method 
            if (@$request->homedelivary) {
                $payentMethod = 'COD';
            }
            if ($request->has('payment_method') && $request->payment_method == 'esewa') {
                $payentMethod = 'ESEWA';
            }
            if ($request->has('payment_method') && $request->payment_method == 'fonepay') {
                $payentMethod = 'FONEPAY';
            }

            if (is_null($payentMethod)) {
                DB::rollBack();
                return back()->withInput()->with('error', 'Please Select The Payment Method');
            }

            // create Order 
            $order =  $this->repo->order(
                120,
                $payentMethod,
                'pending',
                Auth::id() ?? @$user->id ?? 0
            );



            // if order failed
            if (!isset($order) || !@$order) {
                DB::rollBack();
                return back()->with('error', 'Order Not Created !! Please Try Again')->withInput();
            }
            // create order products 
            $this->orderProducts($order->id);

            // create customer 
            $customer = [
                'user_id' => Auth::id() ?? $user->id ?? null,
                'name' => $request->name,
                'phone' => $request->phone,
                'address' =>  $request->adddress1 ?? $request->address2,
                'billingAddress' => $request->address1 ?? $request->adddress2,
                'provinces' => $request->provinces,
                'district' => $request->district,
                'gaupalika' => $request->gaupalika,
                'ward_no' => $request->wardno
            ];
            $customerCondition = [
                'email' => $request->email
            ];

            $this->repo->createOrUpdate(
                Customer::query(),
                $customerCondition,
                $customer
            );
            unset($customer['address']);
            unset($customer['billingAddress']);
            // delivary Location
            $delivary = $customer;

            $delivary['user_id'] = Auth::id() ?? $user->id ?? null;
            $delivary['orderNumber'] = $order->id;
            $delivary['postcode'] = $request->postcode ?? null;
            $delivary['billingAddress1'] = $request->address1 ?? null;
            $delivary['billingAddress2'] = $request->address2 ?? null;
            $delivary['note'] = $request->note ?? null;
            $delivary['email'] = $request->email;


            $this->repo->create(
                DelivaryLocation::query(),
                $delivary
            );
            DB::commit();

            if ($request->has('payment_method')) {
                $this->paymentMethod($request->payment_method, $order);
            }

            #  Session::forget('cart');
            if (!$request->has('payment_method')) {

                return back()->with('success', "Order Created Successfully");
            }
        } catch (Exception $e) {
            DB::rollBack();
            info($e);
            return back()->with('errror', 'Some thing went wrong')->withInput();
        }
    }



    public function orderProducts($orderID)
    {
        $carts = session()->get('cart');

        foreach ($carts as $cart) {
            $product = [
                'orderNumber' => $orderID,
                'productCode' => $cart['sku'],
                'sku' => $cart['sku'],
                'barcode' => null,
                'color' => null,
                'size' => null,
                'quantity' => $cart['quantity'],
                'unitPrice' => $cart['price'],
                'subtotal' => number_format($cart['quantity'] * $cart['price'], 2),
            ];

            $this->repo->create(OrderProduct::query(), $product);
        }
    }
    public function paymentMethod($paymentMethod, $order)
    {
        if ($paymentMethod == 'esewa') {
            $pid = $order->id;
            // set success and failure callback urls
            $successUrl = url('/esewa-success');
            $failureUrl = url('/esewa-failure');
            // config for development
            $config = new EsewaConfig($successUrl, $failureUrl);

            // initialize eSewa client
            $esewa = new EsewaClient($config);

            $esewa->process(
                $pid,
                $order->subtotal ?? $order->nettotal,
                0,
                0,
                $order->delivaryCharge ?? 0
            );
        }

        if ($paymentMethod == 'fonepay') {
            return (new Fonepay)->pay(
                $order->nettotal,
                route('fonepay.verification', 'slug'),
                uniqid() . '-' . $order->id,
                'MOOL' . $order->id
            );
        }
    }
    public function verification(Request $request)
    {
        $fonepay = new Fonepay;
        $PRN = $request->PRN;
        $BID = $request->BID;
        $PID = $request->PID;
        $PS = $request->PS;
        $RC = $request->RC;
        $DV = $request->DV;
        $UID = $request->UID;
        $BC = $request->BC;
        $INI = $request->INI;
        $P_AMT = $request->P_AMT;
        $R_AMT = $request->R_AMT;
        $inquiry = $fonepay->inquiry($UID, [
            'PRN' => $PRN,
            'BID' => $BID,
            'PID' => $PID,
            'PS' => $PS,
            'RC' => $RC,
            'DV' => $DV,
            'UID' => $UID,
            'BC' => $BC,
            'INI' => $INI,
            'P_AMT' => $P_AMT,
            'R_AMT' => $R_AMT,
        ]);
        $Pstatus = $fonepay->isSuccess($inquiry);

        $data = [
            'menuCategories' => $this->maincategory()
        ];


        if ($Pstatus) {
            $payment = [
                'orderNumber' => null,
                'oid' => $_GET['UID'],
                'status' => $_GET['RC'],
                'paymentMethod' => 'FONEPAY',
                'amount' => $_GET['R_AMT'],
                'ini' => $_GET['INI'],
                'pid' => $_GET['PID']
            ];
            $where = [
                'transectionCode' => $_GET['PRN'],

            ];
            $this->repository->createOrUpdate(
                PaymentDetail::query(),
                $where,
                $payment
            );
            return view('payment.success', $data);
        } else {
            return view('payment.failure', $data);
        }
    }
}

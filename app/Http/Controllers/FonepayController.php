<?php

namespace App\Http\Controllers;

use App\Models\PaymentDetail;
use App\Models\Product;
use App\Repositories\BaseRepository;
use App\Repositories\Payment\Fonepay;
use App\Traits\CommonTrait;
use Illuminate\Http\Request;

class FonepayController extends Controller
{
  use CommonTrait;
  private BaseRepository $repo;
  public function __construct(BaseRepository $repo)
  {
    $this->repo = $repo;
  }
  public function checkout(Product $product)
  {
    return (new Fonepay)->pay(
      1000,
      route('fonepay.verification', 'slug'),
      uniqid(),
      'test'
    );
  }
  public function verification($product, Request $request)
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
      $this->repo->createOrUpdate(
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

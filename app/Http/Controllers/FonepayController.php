<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Repositories\Payment\Fonepay;
use Illuminate\Http\Request;

class FonepayController extends Controller
{
    public function checkout(Product $product){
        return (new Fonepay)->pay(
            1000,
            route('fonepay.verification','slug'),
          uniqid(),
            'test'
        );
      }
      public function verification($product, Request $request){
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
            $inquiry= $fonepay->inquiry($UID, [
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
          $Pstatus =$fonepay->isSuccess($inquiry);

          if ($Pstatus) {
            dd('success');
          }else{
            dd('failed');
          }
      }
}

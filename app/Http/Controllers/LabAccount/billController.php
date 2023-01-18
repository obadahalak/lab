<?php

namespace App\Http\Controllers\LabAccount;

use App\Http\Controllers\Controller;
use App\Http\Requests\BillRequest;
use App\Http\Requests\PaysRequest;
use App\Models\Bills;
use App\Models\Pay;
use App\Models\Supplier;
use Illuminate\Http\Request;

class billController extends Controller
{
    public function addBillToOffice(BillRequest $request)
    {
        $bill = $request->validated();
       // $bill['user_id'] = auth()->user()->id;


        $data = Bills::create($bill);

        return response()->json($data);
    }

    public function get_bills()
    {
        $bills = Supplier::with('bills')->where('account_id' , auth('lab')->user()->id)->wherehas('bills')->paginate(10);

        return response()->json($bills);
    }

    public function addPay(PaysRequest $request)
    {
        $pay = Pay::where('bills_id' , $request->bills_id)->exists();
      //  return response()->json($pay);
        if(!$pay)
        {
            $total_ID = Bills::where('id' , $request->bills_id)->first()->value('total_ID');
            $total_dolar = Bills::where('id' , $request->bills_id)->first()->value('total_dolar');
            if($request->Amount_ID <= $total_ID && $request->Amount_dolar <= $total_dolar )
            {
                $data['bills_id'] = $request->bills_id;
                $data['Amount_$_before_payment'] = $total_dolar;
                $data['Amount_ID_before_payment'] = $total_ID;
                $data['Amount_$_after_payment'] = $total_dolar - $request->Amount_dolar;
                $data['Amount_ID_after_payment'] = $total_ID - $request->Amount_ID;
                $stored = Pay::create($data);
                return response()->json($stored);
            }
            else
            {
                return response()->json('invalid operation' , 422);
            }

        }
        else{
            $last_pay = Pay::where('bills_id' , $request->bills_id)->latest()->first();
          //  return response()->json($last_pay);
            $last_dolar = Pay::where('id' , $last_pay->id)->latest()->value('Amount_$_after_payment');
            $last_ID = Pay::where('id' , $last_pay->id)->latest()->value('Amount_ID_after_payment');
            if($request->Amount_ID <= $last_ID && $request->Amount_dolar <= $last_dolar)
            {

                $data['bills_id'] = $request->bills_id;
                $data['Amount_$_before_payment'] = $last_dolar;
                $data['Amount_ID_before_payment'] = $last_ID;
                $data['Amount_$_after_payment'] = $last_dolar - $request->Amount_dolar;
                $data['Amount_ID_after_payment'] = $last_ID - $request->Amount_ID;
                $stored = Pay::create($data);
                return response()->json($stored);
            }
            else
            {
                return response()->json('invalid operation' , 422);
            }

        }


    }

    public function get_pays()
    {
        $bills =auth('lab')->user()->Supplier;

        return response()->json($bills);
    }




}

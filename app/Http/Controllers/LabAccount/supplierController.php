<?php

namespace App\Http\Controllers\LabAccount;

use App\Http\Controllers\Controller;
use App\Http\Requests\supplierRequest;
use App\Models\Supplier;
use Illuminate\Http\Request;

class supplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth('lab')->user()->id;
        $supplier = Supplier::where('account_id' , $user_id)->orderBy('id', 'desc')->paginate(10);

        return response()->json($supplier);
    }


    public function store(supplierRequest $request)
    {
        $supplier = $request->validated();

        auth('lab')->user()->suppliers()->create($supplier);

        return response()->json(['message' => 'Supplier created'], 201);
    }


    public function update(Request $request, $id)
    {
        $supplier = Supplier::where('id', $id)->first();

        $store['scientific_office_name'] = $request->scientific_office_name   ?? $supplier->scientific_office_name;
        $store['added_date']             = $request->added_date               ?? $supplier->added_date;
        $store['phone']                  = $request->phone                    ?? $supplier->phone;
        $store['maintain_phone']         = $request->maintain_phone           ?? $supplier->maintain_phone;
        $store['address']                = $request->address                  ?? $supplier->address;


        $data = $supplier->update($store);

        $response = [
            'status' => 'updated',
            'data'  => $data
        ];

        return response()->json($response);
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplier = Supplier::where('id', $id)->first();

        $supplier->delete();

        return response()->json('deleted');
    }
}

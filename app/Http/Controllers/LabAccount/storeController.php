<?php

namespace App\Http\Controllers\LabAccount;

use App\Http\Controllers\Controller;
use App\Http\Requests\storeRequest;
use App\Models\Store;
use Illuminate\Http\Request;

class storeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $store = Store::where('account_id' , $user_id)->orderBy('id', 'desc')->paginate(10);

        return response()->json($store);
    }


    public function store(storeRequest $request)
    {
        $store = $request->validated();
        $store['account_id'] = auth()->user()->id;

        if ($request->image)
        {
            $store['image'] = $request->image->store($request->product_name . '_product' , 'public');

        }

        $store_data = Store::create($store);

        return response()->json($store_data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_quantity(Request $request , $id)
    {
        $store = Store::where('id' , $id)->first();
        $quantity = Store::find($id)->value('quantity');

        if($quantity >= $request->quantity)
        {

            $new_quantity = $quantity - $request->quantity;

            $store->update([
                'quantity' => $new_quantity,
            ]);
            $response = [
                'status'    => 'quantity updated',
                'data'      => $new_quantity
            ];
            return response()->json($response);
        }
        else{
            return response()->json('the existed quantity is smaller then the requested quantity' , 422);
        }



    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(storeRequest $request, $id)
    {
        $store_data = Store::where('id' , $id)->first();

        $store['product_name']           = $request->product_name           ?? $store_data->product_name;
        $store['description']            = $request->description            ?? $store_data->description;
        $store['company']                = $request->company                ?? $store_data->company;
        $store['expire_date']            = $request->expire_date            ?? $store_data->expire_date ;
        $store['out_date']               = $request->out_date               ?? $store_data->out_date ;
        $store['model']                  = $request->model                  ?? $store_data->model ;
        $store['quantity']               = $request->quantity               ?? $store_data->quantity ;
        $store['test_unit_id']      = $request->test_unit_id      ?? $store_data->test_unit_id ;

        if ($request->image)
        {
            $store['image'] = $request->image->store($request->product_name . '_product' , 'public');

        }

        $store_data->update($store);
        $response = [
            'status'    => 'updated',
            'data'      => $store_data
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
        $store = Store::where('id' , $id)->first();

        $store->delete();

        return response()->json('deleted');
    }
}

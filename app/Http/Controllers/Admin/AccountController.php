<?php

namespace App\Http\Controllers\Admin;

use App\Models\Account;
use Illuminate\Http\Request;
use App\Http\Trait\UploadImages;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\AccountRequest;
use App\Http\Resources\AccountResource;
use Illuminate\Http\Response;

// use Illuminate\Support\Facades\Response;

class AccountController extends Controller
{


    public function create(AccountRequest $request)
    {

        $account = Account::create([

            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'lab_name' => $request->lab_name,
            'phone' => $request->phone,
            'address' => $request->address,

        ]);

        $path = $request->src->store('accountImages','public');

        $account->AccountImage()->create([
            'src' =>'public/'.$path,
        ]);

        return response()->json(['message' => 'created successfully'], Response::HTTP_CREATED);
    }

    public function accounts()
    {
        return AccountResource::collection(Account::latest()->paginate(10));
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AdminAuthRequest;
use Illuminate\Validation\ValidationException;

class AdminAuthController extends Controller
{
    public function auth(Request $request)
    {

        $admin = Admin::where('email', $request->email)->first();

        if (!$admin || !Hash::check($request->password, $admin->password)) {
            throw ValidationException::withMessages([
                'email' => ['email or password is incorrect'],
            ]);
        } else {
            $token = $admin->createToken($request->email);
            return response()->json(['token' => $token->accessToken]);
        }
    }

    public function profileAdmin(AdminAuthRequest  $request)
    {
        // $return=[];
return $request->all();
        if (!$request->old_password) {

            auth('admin')->user()->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
            // $return['profile updated'];
        } else {
            if (Hash::check($request->old_password, auth('admin')->user()->password)) {
                auth('admin')->user()->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->new_password),
                ]);
            }
        //    rety  $return['passsword updated'];

        }
    }
}

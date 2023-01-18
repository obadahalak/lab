<?php

namespace App\Http\Controllers\LabAccount;

use App\Models\Account;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Trait\UploadImages;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AccountRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\LabAccountRequest;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\LabProfileResource;
use Illuminate\Validation\ValidationException;

class LabAccountController extends Controller
{
    use UploadImages;
    public function accountAuth(Request $request)
    {

        $account = Account::where('email', $request->email)->first();

        if (!$account || !Hash::check($request->password, $account->password)) {
            throw ValidationException::withMessages([
                'email' => ['email or password is incorrect'],
            ]);
        } else {
            $token = $account->createToken($request->email);
            return response()->json(['token' => $token->accessToken]);
        }
    }

    public function account()
    {
        return new LabProfileResource(auth('lab')->user());
    }

    public function updateLab(LabAccountRequest $request)
    {

        $return = [];

        $authLab = auth('lab')->user();


        if ($request->old_password) {
            dd('UpdatePaswordLab');
        }
        if ($request->src) {
            return $this->UpdateAccountImage($authLab, $request->src);
        }

        $authLab->update([
            'lab_name' => $request->lab_name,
            'phone' => $request->phone,

        ]);
        // return $return;
    }
}

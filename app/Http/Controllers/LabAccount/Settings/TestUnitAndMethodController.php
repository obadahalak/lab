<?php

namespace  App\Http\Controllers\LabAccount\Settings;

use App\Models\TestUnit;
use App\Models\SendMethod;
use App\Models\TestMethod;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SendMethodRequest;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\SendMethodResource;

class TestUnitAndMethodController extends Controller

{


    //test units
    public function getTestUnits()
    {
        return response()->json(auth('lab')->user()->testUnit);
    }


    public function createTestUnit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'test_unit' => 'required|min:1|max:255',
        ]);

        if (!$validator->fails()) {
            auth('lab')->user()->testUnit()->create([
                'unit' => $request->test_unit,
            ]);
            return response()->json(['message' => 'test_unit created successfully'], 201);
        } else {
            return response()->json(['error' => $validator->errors()->all()], 422);
        }
    }
    public function updateTestUnit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'test_unit' => 'required|min:2|max:255',
            'test_unit_id' => ['required', function ($attribute, $value, $fail) {
                if (!auth()->user('lab')->testUnit > find($value)) {
                    $fail('The ' . $attribute . ' is invalid.');
                }
            },],
        ]);

        if (!$validator->fails()) {
            TestUnit::find($request->test_unit_id)->update([
                'unit' => $request->test_unit,
            ]);
            return response()->json(['message' => 'testUnit updated '], 200);
        } else {
            return response()->json(['error' => $validator->errors()->all()], 422);
        }
    }

    public function deleteTestUnit(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'test_unit_id' => ['required', function ($attribute, $value, $fail) {
                if (!auth()->user('lab')->testUnit->find($value)) {
                    $fail('The ' . $attribute . ' is invalid.');
                }
            },],
        ]);

        if (!$validator->fails()) {
            TestUnit::find($request->test_unit_id)->delete();
            return response()->json(['message' => 'testUnit deleted '], 200);
        } else {
            return response()->json(['error' => $validator->errors()->all()], 422);
        }
    }



    ///test Methods


    ////test methods
    public function testMethods()
    {
        return response()->json(auth('lab')->user()->testMethod);
    }

    public function createTestMethod(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'test_method' => 'required|min:2|max:255',
        ]);

        if (!$validator->fails()) {
            auth('lab')->user()->testMethod()->create([
                'test_method' => $request->test_method,
            ]);
            return response()->json(['message' => 'test_method created successfully'], 201);
        } else {
            return  response()->json($validator->errors(), 422);
        }
    }
    public function updateTestMethod(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'test_method' => 'required|min:2|max:255',
            'test_method_id' => ['required', function ($attribute, $value, $fail) {
                if (!auth('lab')->user()->testMethod->find($value)) {
                    $fail('The ' . $attribute . ' is invalid.');
                }
            },],
        ]);

        if (!$validator->fails()) {
            TestMethod::find($request->test_method_id)->update([
                'test_method' => $request->test_method,
            ]);
            return response()->json(['message' => 'testMethod updated '], 200);
        } else {
            return response()->json(['error' => $validator->errors()->all()], 422);
        }
    }

    public function deleteTestMethod(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'test_method_id' => ['required', function ($attribute, $value, $fail) {
                if (!auth('lab')->user()->testMethod->find($value)) {
                    $fail('The ' . $attribute . ' is invalid.');
                }
            },],
        ]);

        if (!$validator->fails()) {
            TestMethod::find($request->test_method_id)->delete();
            return response()->json(['message' => 'testMethod deleted '], 200);
        } else {
            return response()->json(['error' => $validator->errors()->all()], 422);
        }
    }
}

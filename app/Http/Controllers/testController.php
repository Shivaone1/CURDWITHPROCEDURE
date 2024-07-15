<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\{Test, Test2};

class testController extends Controller
{

    public function index()
    {
        try {
            // $list = Test::all();
            $list = DB::select('CALL GetAllRecords()');
            if (!empty($list)) {
                return response()->json(['status' => true, 'message' => 'List Fetched Successfully...', 'data' => $list]);
            } else {
                return response()->json(['status' => false, 'message' => 'Data Not Found!!!']);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Error fetching data: ' . $e->getMessage()], 404);
        }
    }


    public function store(Request $request)
    {
        try {
            // $test = new Test();
            // $test->name = $request->input('name');
            // $test->email = $request->input('email');
            // $test->mobile = $request->input('mobile');
            // $test->city = $request->input('city');
            // $test->pinCode = $request->input('pinCode');
            // $test->save();
            $name=$request->input('name');
            $email=$request->input('email');
            $mobile=$request->input('mobile');
            $city=$request->input('city');
            $pinCode=$request->input('pinCode');
            DB::statement('CALL CreateRecord()',[$name,$email,$mobile,$city,$pinCode]);
            // test2
            // $test2 = new Test2();
            // $test2->test_id = $test->id;
            // $test2->salary = $request->input('salary');
            // $test2->company = $request->input('company');
            // $test2->save();
            $salary=$request->input('salary');
            $company=$request->input('company');
            DB::statement('CALL CreateRecord()',[$salary,$company]);

            return response()->json(['status' => 'true', 'message' => 'Recrod Store Successfullly...'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'false', 'message' => 'Something Wrong!!!'], 402);
        }
    }


    public function show($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        try {
            $test = Test::findOrFail($id);
            $test->name = $request->input('name');
            $test->email = $request->input('email');
            $test->mobile = $request->input('mobile');
            $test->city = $request->input('city');
            $test->pinCode = $request->input('pinCode');
            $test->save();
            return response()->json(['status' => 'true', 'message' => 'Record Update Successfully...'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'false', 'message' => 'Something Wrong...' . $e], 402);
        }
    }


    public function destroy($id)
    {
        try {
            $test = Test::findOrFail($id);
            $test->delete();
            return response()->json(['status' => 'true', 'message' => 'Record Delete Successfully...'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'false', 'message' => 'Something Wrong...' . $e], 402);
        }
    }
}

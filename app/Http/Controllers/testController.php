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
            $name = $request->input('name');
            $email = $request->input('email');
            $mobile = $request->input('mobile');
            $city = $request->input('city');
            $pinCode = $request->input('pinCode');
            $salary = $request->input('salary');
            $company = $request->input('company');

            DB::statement('CALL CreateRecord(:name, :email, :mobile, :city, :pinCode, :salary, :company)', [
                'name' => $name,
                'email' => $email,
                'mobile' => $mobile,
                'city' => $city,
                'pinCode' => $pinCode,
                'salary' => $salary,
                'company' => $company,
            ]);

            return response()->json(['status' => 'true', 'message' => 'Record Stored Successfully...'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'false', 'message' => 'Something went wrong: ' . $e->getMessage()], 402);
        }
    }




    public function update(Request $request, $id)
    {
        try {
            $name = $request->input('name');
            $email = $request->input('email');
            $mobile = $request->input('mobile');
            $city = $request->input('city');
            $pinCode = $request->input('pinCode');
            $salary = $request->input('salary');
            $company = $request->input('company');
            DB::statement('CALL UpdateRecord(?,?,?,?,?,?,?,?)', [$id, $name, $email, $mobile, $city, $pinCode, $salary, $company]);
            return response()->json(['status' => 'true', 'message' => 'Record Update Successfully...'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'false', 'message' => 'Something Wrong...' . $e], 402);
        }
    }


    public function destroy($id)
    {
        try {
            DB::statement('CALL DeleteRecord(?)', [$id]);
            return response()->json(['status' => 'true', 'message' => 'Record Deleted Successfully...'], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => 'false', 'message' => 'Something Went Wrong... ' . $e->getMessage()], 402);
        }
    }
}

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


// DELIMITER $$
// CREATE DEFINER=`root`@`localhost` PROCEDURE `CreateRecord`(IN name VARCHAR(255), IN email VARCHAR(255), IN mobile VARCHAR(255), IN city VARCHAR(255), IN pinCode VARCHAR(255), IN salary DECIMAL(10, 2), IN company VARCHAR(255))
// BEGIN
//     DECLARE last_insert_id INT;

//     INSERT INTO tests (name, email, mobile, city, pinCode) VALUES (name, email, mobile, city, pinCode);
    
//     SET last_insert_id = LAST_INSERT_ID();

//     INSERT INTO test2s (test_id, salary, company) VALUES (last_insert_id, salary, company);
// END$$
// DELIMITER ;

// DELIMITER $$
// CREATE DEFINER=`root`@`localhost` PROCEDURE `DeleteRecord`(IN recordId INT)
// BEGIN
//     DELETE FROM test2s WHERE test_id = recordId;
//     DELETE FROM tests WHERE id = recordId;
// END$$
// DELIMITER ;

// DELIMITER $$
// CREATE DEFINER=`root`@`localhost` PROCEDURE `GetAllRecords`()
// BEGIN
//     SELECT name,email,city,salary,company
//     FROM tests
//     JOIN test2s ON tests.id =test2s.test_id;
// END$$
// DELIMITER ;

// DELIMITER $$
// CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateRecord`(IN `update_id` INT, IN `name` VARCHAR(255), IN `email` VARCHAR(255), IN `mobile` VARCHAR(255), IN `city` VARCHAR(255), IN `pinCode` VARCHAR(255), IN `salary` VARCHAR(255), IN `company` VARCHAR(255))
// BEGIN
//     UPDATE tests SET name = name, email = email,mobile=mobile,city=city,pinCode=pinCode WHERE id = update_id;
//     UPDATE test2s SET salary = salary,company=company WHERE test_id = update_id;
// END$$
// DELIMITER ;

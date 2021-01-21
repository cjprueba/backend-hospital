<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;
use App\Models\Consultation;
use App\Models\Exam;
use App\Models\AtributeDoctorModel;

class UserController extends Controller
{
    public function list_role(){

    	$data = Role::get();

    	$response['success'] = true;
    	$response['data'] = $data;

    	return $response;
    	
    }

    public function create(Request $request){

    	try {

    		$insert['name'] = $request['name'];
    		$insert['email'] = $request['email'];
    		$insert['password'] = $request['password'];
    		$insert['address'] = $request['address'];
    		$insert['phone'] = $request['phone'];
    		$insert['age'] = $request['age'];
    		$insert['cpf'] = $request['cpf'];
    		$insert['fk_rol'] = $request['type'];
    		$insert['gender'] = $request['gender'];
    		$insert['password'] = Hash::make($request['password']);

    		$id = User::insertGetId($insert);

            if ($request['type'] === "1") {
                $insertAttribute['fk_doctor'] = $id;
                $insertAttribute['crm'] = $request['crm'];
                AtributeDoctorModel::insert($insertAttribute);
            }

    		$response['message'] = "Guardado correctamente";
    		$response['response'] = true;

    	} catch (Exception $e) {

    		$response['message'] = $e->getMessage();
    		$response['response'] = false;

    	}

    }

    public function list_customer(){

        $data = User::
        where('fk_rol', '=', 2)
        ->get();

        $response['success'] = true;
        $response['data'] = $data;

        return $response;
        
    }

    public function historial(Request $request){

        $data_consulting = Consultation::
        where('fk_customer', '=', $request['customer'])
        ->get();

        $data_exam = Exam::
        where('fk_customer', '=', $request['customer'])
        ->get();

        $response['success'] = true;
        $response['data_consulting'] = $data_consulting;
        $response['data_exam'] = $data_exam;

        return $response;
        
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exam;
use Illuminate\Support\Facades\DB;

class ExamController extends Controller
{
    public function create(Request $request){

    	try {

    		$date = date('Y-m-d');

    		$insert['description'] = $request['description'];
    		$insert['fk_customer'] = $request['customer'];
    		$insert['fk_doctor'] = $request['doctor'];
    		$insert['created_at'] = $date;
    		$insert['updated_at'] = $date;

    		Exam::insert($insert);

    		$response['message'] = "Guardado correctamente";
    		$response['response'] = true;

    	} catch (Exception $e) {

    		$response['message'] = $e->getMessage();
    		$response['response'] = false;

    	}

    	return $response;

    }

    public function list_exam(Request $request){

        $data = Exam::select(DB::raw('exam.id, exam.description, users.name, exam.created_at'))
        ->leftjoin('users', 'fk_customer', '=', 'users.id')
        ->where('fk_doctor', '=', $request['doctor'])
        ->orderBy('exam.id', 'desc')
        ->get();

        $response['success'] = true;
        $response['data'] = $data;

        return $response;
        
    }
}

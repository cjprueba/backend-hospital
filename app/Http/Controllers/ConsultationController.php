<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consultation;
use Illuminate\Support\Facades\DB;

class ConsultationController extends Controller
{
    public function create(Request $request){

    	try {

    		$date = date('Y-m-d');

    		$insert['description'] = $request['description'];
    		$insert['fk_customer'] = $request['customer'];
    		$insert['fk_doctor'] = $request['doctor'];
    		$insert['created_at'] = $date;
    		$insert['updated_at'] = $date;

    		Consultation::insert($insert);

    		$response['message'] = "Guardado correctamente";
    		$response['response'] = true;

    	} catch (Exception $e) {

    		$response['message'] = $e->getMessage();
    		$response['response'] = false;

    	}

    	return $response;
    }

    public function list_consulting(Request $request){

        $data = Consultation::select(DB::raw('consultation.id, consultation.description, users.name, consultation.created_at'))
        ->leftjoin('users', 'fk_customer', '=', 'users.id')
        ->where('fk_doctor', '=', $request['doctor'])
        ->orderBy('consultation.id', 'desc')
        ->get();

        $response['success'] = true;
        $response['data'] = $data;

        return $response;
        
    }
}

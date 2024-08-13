<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Patient;

class PatientController extends Controller
{
    function webhook(Request $req){
        $patient = new Patient();
        
        $temp = json_decode($req->getcontent());

        $patient->data = json_encode($temp->data->fieldsExtracted);

        if($patient->save()){
            return response()->json([
                'message' => "Success"
            ]);
        }
        else{
            return response()->json([
                'message' => "Error"
            ]);
        }
    }
}

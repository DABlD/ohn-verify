<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Patient;

class PatientController extends Controller
{
    function webhook(Request $req){
        $patient = new Patient();
        
        $temp = json_decode($req->getcontent());

        $patient->code = $temp->code;
        $patient->data = json_encode($temp->data->fieldsExtracted);
        $patient->selfieImageUrl = json_encode($temp->data->selfieImageUrl);
        $patient->idImageUrl = json_encode($temp->data->idImageUrl);

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

    function storeFp(Request $req){
        $patient = Patient::where('code', $req->code)->first();
        $patient->fingerprint = $req->fp;
        $patient->save();
    }

    function checkNeedFP(Request $req){
        $patient = Patient::whereNull('fingerprint')->first();

        return json_encode($patient);
    }
}

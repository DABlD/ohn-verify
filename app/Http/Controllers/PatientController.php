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

    function list(){
        return view("list");
    }

    function getList(){
        $patients = Patient::all();
        $array = [];

        foreach($patients as $patient){
            $temp = [];
            $temp2 = (Array)json_decode($patient->data);

            $temp['code'] = $patient->code;
            $temp['name'] = $temp2['name'];
            $temp['gender'] = $temp2['gender'];
            $temp['birthday'] = $temp2['birthday'];
            $temp['actions'] = "test";

            array_push($array, $temp);
        }

        echo json_encode($array);
    }
}

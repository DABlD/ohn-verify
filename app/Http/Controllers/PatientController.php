<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;

use App\Models\Patient;

class PatientController extends Controller
{
    function webhook(Request $req){
        $patient = new Patient();
        
        $temp = json_decode($req->getcontent());

        $patient->code = $temp->code;
        $patient->data = json_encode($temp->data->fieldsExtracted);
        $patient->selfieImageUrl = 'uploads/' . $temp->code . '-' . 'selfie.jpg';
        $patient->idImageUrl = 'uploads/' . $temp->code . '-' . 'id.jpg';
        // $patient->selfieImageUrl = json_encode($temp->data->selfieImageUrl);
        // $patient->idImageUrl = json_encode($temp->data->idImageUrl);

        $imageContent = file_get_contents($temp->data->selfieImageUrl);
        Storage::put($patient->selfieImageUrl, $imageContent);

        $imageContent = file_get_contents($temp->data->idImageUrl);
        Storage::put($patient->idImageUrl, $imageContent);

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

    function testUpload(Request $req){
        $imageContent = file_get_contents("https://4.img-dpreview.com/files/p/E~TS590x0~articles/3925134721/0266554465.jpeg");
        Storage::disk('public')->put("uploads/" . base64_encode(random_bytes(10)) . '.jpg', $imageContent);
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

            $temp['id'] = sizeof($array) + 1;
            $temp['code'] = $patient->code;
            $temp['name'] = $temp2['fullName'];
            $temp['gender'] = $temp2['gender'];
            $temp['birthday'] = $temp2['dateOfBirth'];
            $temp['actions'] = "
                <a class='btn btn-success' data-toggle='tooltip' title='View' onClick='view(`$patient->code`)'>
                    <i class='fas fa-search'></i>
                </a>
            ";

            array_push($array, $temp);
        }

        echo json_encode($array);
    }

    function getPayload(Request $request){
        return Patient::where('code', $request->code)->first();
    }
}

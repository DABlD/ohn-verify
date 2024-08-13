<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Patient;

class PatientController extends Controller
{
    function webhook(Request $req){
        $patient = new Patient();

        $patient->idNumber = $req->idNumber;
        $patient->dateOfExpiry = $req->dateOfExpiry;
        $patient->fullName = $req->fullName;
        $patient->dateOfBirth = $req->dateOfBirth;
        $patient->address = $req->result;
        $patient->placeOfIssue = json_encode($req->result);
        $patient->yearOfBirth = $req['status'];
        $patient->nationality = $req->status;
        $patient->data = json_encode($req['status']);

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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Patient;

class PatientController extends Controller
{
    function webhook(Request $req){
        $patient = new Patient();

        $patient->idNumber = $req['idNumber'];
        $patient->dateOfExpiry = $req['dateOfExpiry'];
        $patient->fullName = $req['fullName'];
        $patient->dateOfBirth = $req['dateOfBirth'];
        $patient->address = $req['address'];
        $patient->placeOfIssue = $req['placeOfIssue'];
        $patient->yearOfBirth = $req['yearOfBirth'];
        $patient->nationality = $req['nationality'];
        $patient->data = json_encode($req->all());

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

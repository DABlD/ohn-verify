<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        "idNumber",
        "dateOfExpiry",
        "fullName",
        "dateOfBirth",
        "address",
        "placeOfIssue",
        "yearOfBirth",
        "nationality",
        "data"
    ];

    protected $dates = [
        "dateOfExpiry",
        "dateOfBirth"
    ];
}

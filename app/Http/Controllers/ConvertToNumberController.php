<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ConvertToNumberController extends Controller
{
    public function index($value){
        if(is_numeric($value)){
            return json_encode(['result' => '200', 'message' => 'Value supplied is a number']);
        }
        return json_encode(['result' => '400', 'error' => 'Value supplied is not a number']);
    }
}

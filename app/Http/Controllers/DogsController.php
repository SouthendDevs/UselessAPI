<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class DogsController extends Controller
{

    /**
     * @return Response
     */
    public function index(Request $request)
    {
        return Response::json([
            'who' => 'let the dogs out',
            'who_who' => 'http://omfgdogs.com/'
        ]);
    }

}

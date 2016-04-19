<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use League\Csv\Reader;

class EmptyStringController extends Controller
{
    public function index(Request $request)
    {
        if($request->has('string')) {
            $input_string = $request->input('string');

            return Response::json([
                'empty_string' => $this->emptyString($input_string)
            ]);
        }

        return Response::json([
            'empty_string' => null,
            'error' => 'string input required'
        ]);
    }

    private function emptyString()
    {
        return substr('test', 0, 0);
    }
}

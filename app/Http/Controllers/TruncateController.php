<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use League\Csv\Reader;

class TruncateController extends Controller
{
    public function index(Request $request)
    {
        return Response::json([
            'truncated_string' => $this->truncate($request->input('string'))
        ]);
    }

    private function truncate($string)
    {
        $new_length = rand(0, strlen($string)-1);
        return substr($string, 0, $new_length);
    }
}

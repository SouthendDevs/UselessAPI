<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redis;
use Response;

class RedisController extends Controller
{
    public function rset(Request $request)
    {
        if($request->has('string')) {
            Redis::set("hello", $request->input('string'));
            return "ok";
        } else {
            return "error: string input required";
        }
    }

    public function rget()
    {
        return "get(hello) == " . Redis::get("hello");
    }
}

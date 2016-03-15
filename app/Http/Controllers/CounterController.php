<?php

namespace App\Http\Controllers;


use Cache;
use Response;

class CounterController extends Controller
{
    public function index()
    {
        //return "Hello!";
        try {
            return Response('Value: '.$this->count()."<br>\n");
        } catch (\Exception $e) {
            var_dump($e->getMessage());
        }
    }

    private function count()
    {
        //echo "in count...";
        if (Cache::store('file')->has('counter_value')) {
            $value = Cache::store('file')->get('counter_value');
            Cache::store('file')->forever('counter_value', $value + 1);

            return $value + 1;
        } else {
            Cache::store('file')->forever('counter_value', 1);

            return 1;
        }
    }

    public static function reset()
    {
        Cache::store('file')->forget('counter_value');
    }
}

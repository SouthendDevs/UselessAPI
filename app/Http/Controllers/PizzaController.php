<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redis;
use Response;

class PizzaController extends Controller
{
    private $PIZZA_REDIS_PREFIX = "pizza_count_";
    private $hashes;
    
    private $reset_hash = '6862ddb362e160e47e6e059644587ec1';
    
    public function __construct() {
        $this->hashes = collect([
            'fa791d767f5651ef1e4f9e9fdda9acb3' => 'andy',
            '30224a30f34b96204504b02ac51f3968' => 'mike',
            '1069a106ed4e28fe3c620ba18d0a7986' => 'simon',
            '582e5e437447cbf5d0950aa17e5e2b6b' => 'stocker',
            'ab425bd5239e24eb33d75372bced154a' => 'ria',
            'ab7fa776f003b83b5e6e1f8b2a5a26cb' => 'john',
            '5999fb439f0c94cf4c6b7f2080d9d6a3' => 'laura',
            '75a822620eab3619ce5f5f1aca593d84' => 'becky',
            '55782e33af92b8c81587321a09536cb0' => 'niall',
            '5aabca96ed1e4713ef07d1284ae13079' => 'ingram',
            '004adeb9b9486c2318df00953ea5f656' => 'dfourn',
        ]);
    }
    
    public function index(Request $request)
    {
        if($request->has('token')) {
            $name = $this->getNameFromToken($request->input('token'));
            if($name == "RESET") {
                $name_to_reset = $request->input('name');
                $this->setPizzaCount($name_to_reset, 0);
                return response()->json(['status' => 'ok', 'message' => "$name_to_reset's pizza count has been reset!'"]);
            }
            if($name){
                if($request->has('increment')){
                    $this->incrementPizzaCount($name);
                    return response()->json(['status' => 'ok', 'message' => "Token accepted! Hi $name, your pizza count has been incremented"]);
                }
                if($this->getPizzaCount($name) === null) $this->setPizzaCount($name, 0);
                return response()->json(['status' => 'ok', 'message' => "Token accepted! Hi $name, add &increment=true parameter to this URL to increment your pizza count"]);
            }
            return response()->json(['status' => 'error', 'error' => "unknown token"]);
        }
        return response()->json($this->getPizzaCounts());
    }
    
    private function getPizzaCounts()
    {
        $pizza_counts = [];
        $this->hashes->each(function($name) use (&$pizza_counts) {
            $pizza_counts[$name] = $this->getPizzaCount($name);
        });
        arsort($pizza_counts);
        return ["slices" => $pizza_counts];
    }
    
    private function getNameFromToken($token)
    {
        $hash = md5($token);
        if($hash == $this->reset_hash) return "RESET";

        if($this->hashes->has($hash)) {
            $name = $this->hashes[$hash];

            $redis_key = $this->PIZZA_REDIS_PREFIX . $name;

            return $name;
        }
        
        return false;
    }
    
    private function getPizzaCount($name)
    {
        $redis_key = $this->PIZZA_REDIS_PREFIX . $name;
        $redis_value = Redis::get($redis_key);
        if($redis_value === null) return null;
        return intval($redis_value);
    }

    private function setPizzaCount($name, $slices)
    {
        $redis_key = $this->PIZZA_REDIS_PREFIX . $name;
        Redis::set($redis_key, $slices);
    }

    private function incrementPizzaCount($name)
    {
        $redis_key = $this->PIZZA_REDIS_PREFIX . $name;
        Redis::incr($redis_key);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redis;
use Response;

class PizzaController extends Controller
{
    private $PIZZA_REDIS_PREFIX = "pizza_count_";
    private $hashes;
    
    private $reset_key = '55782e33af92b8c81587321a09536cb0';
    
    public function __construct() {
        $this->hashes = collect([
            'fa791d767f5651ef1e4f9e9fdda9acb3' => 'andy',
            '30224a30f34b96204504b02ac51f3968' => 'greg',
        ]);
    }
    
    public function index(Request $request)
    {
        if($request->has('token')) {
            $name = $this->getNameFromToken($request->input('token'));
            if($name){
                return "hi " . $name;
            }
            return response()->json(['error' => "unknown token"]);
        }
        return response()->json($this->getPizzaCounts());
    }
    
    private function getPizzaCounts()
    {
        $pizza_counts = [];
        $this->hashes->each(function($name) use (&$pizza_counts) {
            $pizza_counts[$name] = $this->getPizzaCount($name);
        });
        return $pizza_counts;
    }
    
    private function getNameFromToken($token)
    {
        $hash = md5($token);
        if($this->hashes->has($hash)) {
            return $this->hashes[$hash];
        }
        
        return false;
    }
    
    private function getPizzaCount($name)
    {
        $redis_key = $this->PIZZA_REDIS_PREFIX . $name;
        $redis_value = Redis::get($redis_key);
        if($redis_value) return $redis_value;
        return 0;
    }
}

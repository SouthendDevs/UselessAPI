<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CounterTest extends TestCase
{
    public function testSetValue()
    {
        Cache::store('file')->forever('counter_value', 10);
    }
    
    public function testGetValue()
    {
        echo "Cache value is: " . Cache::store('file')->get('counter_value') . "\n";
    }
}

<?php

use App\Http\Controllers\CounterController;

class CounterTest extends TestCase
{
    public function testCounter()
    {
        CounterController::reset();
        $this->visit('/counter')
             ->see('1');
        $this->visit('/counter')
             ->see('2');
        $this->visit('/counter')
             ->see('3');
    }
}

<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use League\Csv\Reader;

class DecimalTimeController extends Controller
{
    public function index()
    {
        return Response::json([
            'decimal_time' => [
                'value' => $this->currentMillidays(),
                'unit' => 'milliday'
            ]
        ]);
    }

    public function currentMillidays()
    {
        $date_time = new DateTime();
        return intval($date_time->format('B'));
    }
}

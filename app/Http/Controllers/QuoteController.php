<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\File;
use League\Csv\Reader;

class QuoteController extends Controller
{
    const QUOTE_CHAR_L = '“';
    const QUOTE_CHAR_R = '”';
    const DASH_CHAR = ' — ';

    /**
     * @return Response
     */
    public function parse(Request $request)
    {

        return Response::json([
            'quote' => self::QUOTE_CHAR_L . 
                       htmlentities($request->input('text'), ENT_QUOTES, 'UTF-8', false) . 
                       self::QUOTE_CHAR_R . 
                       self::DASH_CHAR . 
                       $this->randomAttribution()]);

    }

    /**
     * @return String
     */
    public function randomAttribution()
    {

        if (!ini_get("auto_detect_line_endings")) {
            ini_set("auto_detect_line_endings", '1');
        }

        $famousPeople = Reader::createFromPath(storage_path() . '/app/famous-people.txt');

        $res = $famousPeople->fetchAssoc(['code', 'name']);
        $resToArray = iterator_to_array($res, false);

        return $resToArray[array_rand($resToArray, 1)]['name'];

    }
}

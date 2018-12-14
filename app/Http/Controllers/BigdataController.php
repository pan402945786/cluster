<?php
/**
 * Created by PhpStorm.
 * User: Hainan
 * Date: 2018/12/13
 * Time: 20:09
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BigdataController extends Controller
{
    public function index() {
        $pic = [
            '01.jpg','02.jpg','03.jpg','04.jpg','05.jpg','06.jpg','07.jpg','08.jpg'
        ];

        $except = ['02.jpg'];

        $url = [];
        foreach ($pic as $value) {
            if(in_array($value, $except)) continue;
            $url[] = "images/dress/" . $value;
        }

        return view("hello",compact("url"));
    }

    public function query(Request $request) {
        dd($request);
        return "hello world";
    }
}

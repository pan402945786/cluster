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
        return view("hello");
    }

    public function query(Request $request) {
        dd($request);
        return "hello world";
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    //
    public function create()
    {

    }

    public function update()
    {

    }

    public function sort(Request $request)
    {
        \Log::debug($request);
        return "Hello";
    }

    public function destory($sec_id) 
    {
        
    }
}

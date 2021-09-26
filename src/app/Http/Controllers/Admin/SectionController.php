<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Exception;
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
        try{
            Section::sort($request->sort_data);
            return true;    
        } catch(Exception $e) {
            return false;
        }
    }

    public function destory($sec_id) 
    {

    }
}

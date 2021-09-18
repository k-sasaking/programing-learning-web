<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.contents.admin.index');
    }

    public function create()
    {
        return view('admin.contents.admin.create');
    }

    public function edit()
    {
        return view('admin.contents.admin.edit');
    }

}

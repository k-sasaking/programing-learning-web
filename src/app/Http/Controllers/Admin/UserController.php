<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.contents.user.index');
    }

    public function edit()
    {
        return view('admin.contents.user.edit');
    }

}

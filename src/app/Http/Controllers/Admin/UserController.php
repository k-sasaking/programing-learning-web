<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::get();
        return view('admin.contents.user.index',[
            'users' => $users,
        ]);
    }

    public function edit($id)
    {
        $user = User::where('id', $id)->first();
        return view('admin.contents.user.edit',[
            'user' => $user,
        ]);
    }

}

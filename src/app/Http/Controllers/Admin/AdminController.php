<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;

class AdminController extends Controller
{
    public function index()
    {
        $admins = Admin::get();
        return view('admin.contents.admin.index', [
            'admins' => $admins
        ]);
    }

    public function create()
    {
        return view('admin.contents.admin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'admin_name'       => 'required',
            'email'       => 'required',
            'login_id'       => 'required',
            'password'       => 'required',
        ], [
            'admin_name.required'         => ':attributeは必ず入力してください',
            'email.required'         => ':attributeは必ず入力してください',
            'login_id.required'         => ':attributeは必ず入力してください',
            'password.required'         => ':attributeは必ず入力してください',
        ]);
        Admin::create($request->all());

        return redirect()->route('admin.admin.index');
    }

    public function edit()
    {
        return view('admin.contents.admin.edit');
    }

}

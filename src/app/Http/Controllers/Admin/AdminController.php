<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

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
        
        //psswordのハッシュ値をDBに入れたい
        $request['password'] = Hash::make($request['password']);

        Admin::create($request->all());

        return redirect()->route('admin.admin.index');
    }

    public function edit($id)
    {
        $admin = Admin::where('id', $id)->first();
        return view('admin.contents.admin.edit',[
            'admin' => $admin,
        ]);
    }

}    public function update(Request $request, $id)
    {
        $request->validate([
            'admin_name'       => 'required',
            'email'       => 'required',
            'login_id'       => 'required',
        ], [
            'admin_name.required'         => ':attributeは必ず入力してください',
            'email.required'         => ':attributeは必ず入力してください',
            'login_id.required'         => ':attributeは必ず入力してください',
        ]);

        $admin = Admin::where('id', $id)->first();
        $admin['admin_name'] = $request['admin_name'];
        $admin['email'] = $request['email'];
        $admin['login_id'] = $request['login_id'];

        if($request['password']) {
            $admin['password'] = Hash::make($request['password']);
        }
        $admin->save();

        return redirect()->route('admin.admin.index');
    }
}

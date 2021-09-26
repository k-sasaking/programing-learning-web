<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminFormRequest;
use App\Http\Requests\AdminUpdateFormRequest;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'search_name'       => 'max:100',
            'search_email'       => 'max:100',
        ], [
            'search_name.max'         => '名前は:max文字以内で入力して下さい',
            'search_email.max'         => '名前は:max文字以内で入力して下さい',
        ]);

        $query = Admin::query();
        if ($request->filled('search_name')) {
            $query = $query->where('admin_name', 'like', '%' . $request->search_name . '%');
        }
        if ($request->filled('search_email')) {
            $query = $query->where('email', 'like', '%' . $request->search_email . '%')  ;          
        }

        $admins = $query->paginate(3);

        return view('admin.contents.admin.index', [
            'admins' => $admins
        ]);
    }

    public function create()
    {
        return view('admin.contents.admin.create');
    }

    public function store(AdminFormRequest $request)
    {        
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

    public function update(AdminUpdateFormRequest $request, $id)
    {
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

    public function destroy($id)
    {
        $admin = Admin::where('id', $id)->first();
        $admin->delete();
        return redirect()->route('admin.admin.index');
    }
}

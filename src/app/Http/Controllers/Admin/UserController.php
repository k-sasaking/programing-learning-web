<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
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

        $query = User::query();
        if ($request->filled('search_name')) {
            $query = $query->where('username', 'like', '%' . $request->search_name . '%');
        }
        if ($request->filled('search_email')) {
            $query = $query->where('email', 'like', '%' . $request->search_email . '%')  ;          
        }
        if(isset($request->search_account_type)){
            $query = $query->whereIn('account_type', $request->search_account_type)  ;          
        }
        $users = $query->paginate(10);
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

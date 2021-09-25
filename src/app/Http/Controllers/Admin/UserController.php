<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

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

    public function csvdownload( Request $request )
    {
        $csvTitle = [['No', '名前', 'メールアドレス', 'メール承認日', 'アカウントタイプ', '有効フラグ', 'ラストログイン日時', '作成日', '更新日']];
        $csvList = User::get([
            'id', 
            'username', 
            'email', 
            'email_verified_at', 
            'account_type', 
            'is_enabled', 
            'last_login_at',
            'created_at',
            'updated_at'
        ])->toArray();
        $result = array_merge($csvTitle, $csvList);
        \Log::debug($result);

        $response = new StreamedResponse (function() use ($request, $result){
            $stream = fopen('php://output', 'w');

            // 文字化け回避
            stream_filter_prepend($stream,'convert.iconv.utf-8/cp932//TRANSLIT');

            // CSVデータ
            foreach($result as $key => $value) {
                fputcsv($stream, $value);
            }
            fclose($stream);
        });
        $response->headers->set('Content-Type', 'application/octet-stream');
        $response->headers->set('Content-Disposition', 'attachment; filename="sample.csv"');
 
        return $response;
    }

}

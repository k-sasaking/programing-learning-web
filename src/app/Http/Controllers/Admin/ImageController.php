<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lesson;
use Illuminate\Support\Facades\Storage;


class ImageController extends Controller
{
    public function edit(Request $request, $id) 
    {
        return view('admin.contents.lesson.img.edit', [
            'id' => $id,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'file' => [
                // 必須
                'required',
                // アップロードされたファイルであること
                'file',
                // 画像ファイルであること
                'image',
                // MIMEタイプを指定
                'mimes:jpeg,png',
            ]
        ], [
            'file.required'          => ':attributeは必ず入力してください',
            'file.image'            => '画像ファイルを選択してください',
            'file.mimes'  => ':attributeの画像を選択してください',
        ]);

        if ($request->file('file')->isValid()) {
            $path = Storage::put('public', $request->file('file'));
            $lesson = Lesson::where('id', $id)->first();
            $lesson['thumbnail_path'] = asset(Storage::url($path));
            $lesson->save();
        }

        return redirect()->route('admin.lesson.edit', [
            'id' => $id,
        ]);
    }
}

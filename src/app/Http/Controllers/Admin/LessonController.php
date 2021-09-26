<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lesson;
use App\Models\Category;
use App\Models\Section;

class LessonController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'search_name'       => 'max:100',
            'search_category'       => 'max:100',
        ], [
            'search_name.max'         => '名前は:max文字以内で入力して下さい',
            'search_category.max'         => '名前は:max文字以内で入力して下さい',
        ]);

        $query = Lesson::query();
        if ($request->filled('search_name')) {
            $query = $query->where('name', 'like', '%' . $request->search_name . '%');
        }

        $lessons = $query->paginate(10);

        return view('admin.contents.lesson.index', [
            'lessons' => $lessons,
        ]);
    }

    public function create()
    {
        $categorys = Category::get(['id', 'name']);
        return view('admin.contents.lesson.create', [
            'categorys' => $categorys,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'       => 'required',
            'description'       => 'required',
            'thumbnail_path'       => 'required',
            'category_id'       => 'required',
        ], [
            'name.required'         => ':attributeは必ず入力してください',
            'description.required'         => ':attributeは必ず入力してください',
            'thmbnail_path.required'         => ':attributeは必ず入力してください',
            'category_id.required'         => ':attributeは必ず入力してください',
        ]);

        Lesson::create($request->all());

        return redirect()->route('admin.admin.lesson.index');
    }

    public function edit($id)
    {
        $lesson = Lesson::where('id', $id)->first();
        $categorys = Category::get(['id','name',]);
        return view('admin.contents.lesson.edit', [
            'lesson' => $lesson,
            'categorys' => $categorys,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'       => 'required',
            'description'       => 'required',
            'thumbnail_path'       => 'required',
            'category_id'       => 'required',
        ], [
            'name.required'         => ':attributeは必ず入力してください',
            'description.required'         => ':attributeは必ず入力してください',
            'thmbnail_path.required'         => ':attributeは必ず入力してください',
            'category_id.required'         => ':attributeは必ず入力してください',
        ]);

        $lesson = Lesson::where('id', $id)->first();
        $lesson['name'] = $request['name'];
        $lesson['description'] = $request['description'];
        $lesson['thumbnail_path'] = $request['thumbnail_path'];
        $lesson['category_id'] = $request['category_id'];

        $lesson->save();

        return redirect()->route('admin.admin.lesson.index');
    }

     public function detail($id)
    {
        $lesson = Lesson::where('id', $id)->first();
        $categorys = Category::get(['id','name',]);
        $sections = Lesson::find($id)->sections;
        return view('admin.contents.lesson.detail', [
            'lesson' => $lesson,
            'categorys' => $categorys,
            'sections' => $sections,
        ]);
    }

    public function destroy($id)
    {
        $lesson = Lesson::where('id', $id)->first();
        $lesson->delete();
        return redirect()->route('admin.admin.lesson.index');
    }   
}

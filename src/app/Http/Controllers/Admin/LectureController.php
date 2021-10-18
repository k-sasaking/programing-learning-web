<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lecture;
use App\Models\Section;
use Exception;
use Illuminate\Http\Request;

class LectureController extends Controller
{
    public function detail($id)
    {
        $section = Section::where('id', $id)->with('lesson.category', 'lectures')->first();
        return view('admin.contents.section.detail', [
            'section' => $section,
        ]);
    }

    public function sort(Request $request)
    {
        try{
            Lecture::sort($request->sort_data);
            return true;    
        } catch(Exception $e) {
            return false;
        }
    }

    public function edit($id)
    {
        $lecture = Lecture::where('id', $id)->first();
        return view('admin.contents.lecture.edit', [
            'lecture' => $lecture,
        ]);
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'title'       => 'required',
        ], [
            'title.required'         => ':attributeは必ず入力してください',
        ]);
        $request['sort'] = Lecture::where('section_id', $id)->count() + 1;
        $request['text'] = '';
        Lecture::create($request->all());

        return redirect()->route('admin.lecture.detail', [ 'id' => $id ]);
    }

    public function update(Request $request, $id) 
    {
        $request->validate([
            'title'       => 'required',
        ], [
            'title.required'         => ':attributeは必ず入力してください',
        ]);

        $lecture = Lecture::find($id)->first();
        $lecture['title'] = $request['title'];
        $lecture['text'] = $request['text'];
        $lecture->save();

        return redirect()->route('admin.lecture.edit', [ 'id' =>  $lecture->id ]);
    }

    public function destroy($id) 
    {
        $lecture = Lecture::where('id', $id )->first();
        $lecture->delete();
        
        //レクチャーの順番を更新したい
        $lectures = Lecture::where('section_id', $lecture->section_id)->get();
        foreach ($lectures as $index => $lecture) {
            $lecture = Lecture::where('id', $lecture->id)->first();
            $lecture['sort'] =  $index;
            $lecture->save();
        }

        return redirect()->route('admin.lecture.detail', [ 'id' =>  $lecture->section_id ]);
    }
}

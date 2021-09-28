<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\Section;
use Exception;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    //
    public function store(Request $request, $id)
    {
        $request->validate([
            'search_name'       => 'max:100',
            'search_category'       => 'max:100',
        ], [
            'search_name.max'         => '名前は:max文字以内で入力して下さい',
            'search_category.max'         => '名前は:max文字以内で入力して下さい',
        ]);

        Section::create($request->all());

        return redirect()->route('admin.lesson.detail', [ 'id' => $id]);
    }

    public function update(Request $request, $id)
    {
        $section = Section::where('id', $request->id)->first();
        $section['name'] = $request->name;
        $section->save();
        return redirect()->route('admin.lesson.detail', [ 'id' => $id ]);
    }

    public function sort(Request $request)
    {
        try{
            Section::sort($request->sort_data);
            return true;    
        } catch(Exception $e) {
            return false;
        }
    }

    public function destroy(Request $request, $id) 
    {
        $section = Section::where('id', $request->id )->first();
        $section->delete();

        $sections = Lesson::find($id)->sections->sortBy('sort');
        
        //セクションの順番を更新したい
        $sort = 1;
        foreach ($sections as $s) {
            $section = Section::where('id', $s->id)->first();
            $section['sort'] =  $sort;
            $section->save();
            $sort++;
        }
        return redirect()->route('admin.lesson.detail', [ 'id' => $id ]);
    }
}

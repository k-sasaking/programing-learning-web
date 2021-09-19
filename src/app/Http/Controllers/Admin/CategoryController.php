<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::get();
        return view('admin.contents.category.index',[
            'categories' => $categories
        ]);
    }

    public function detail($id)
    {
        $category = Category::with('lessons')->where('id', $id)->first();
        return view('admin.contents.category.detail',[
            'category' => $category
        ]);
    }

    public function update()
    {
        return view('admin.contents.category.index');
    }

    public function destroy()
    {
        return view('admin.contents.category.index');
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Section extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'id',
        'sort',
        'lesson_id',
        'name',
        'created_at',
        'updated_at',
    ];

    static function sort($sort_data) {
        foreach ($sort_data as $key => $id) {
            $section = Section::where('id', $id)->first();
            $section['sort'] = $key + 1;
            $section->save();
        }
    }
}

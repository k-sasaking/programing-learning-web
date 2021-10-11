<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Lecture extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'section_id',
        'sort',
        'title',
        'text',
        'created_at',
        'updated_at',
    ];

    public function lectures ()
    {
        return $this->hasMany(Lecture::class);
    }

    static function sort($sort_data) {
        foreach ($sort_data as $key => $id) {
            $lecture = Lecture::where('id', $id)->first();
            $lecture['sort'] = $key + 1;
            $lecture->save();
        }
    }

}

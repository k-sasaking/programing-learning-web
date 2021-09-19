<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    public function lessons ()
    {
        return $this->hasMany(Lesson::class);
    }

    public function getPublishedStatus()
    {
        if($this->is_published)
            return '公開中';
        else
            return '非公開';
    }

}

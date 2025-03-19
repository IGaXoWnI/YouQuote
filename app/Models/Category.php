<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
    ];




    function citations()
    {
        return $this->belongsToMany(Citation::class, "citation_categories");
    }
}

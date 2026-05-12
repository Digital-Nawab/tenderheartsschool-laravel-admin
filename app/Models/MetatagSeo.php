<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MetatagSeo extends Model
{
    //

    protected $fillable = [
        'url',
        'title',
        'description',
        'keyword',
        'image',
        'is_active',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryCategory extends Model
{
    //
    protected $table = 'gallery_categories';
    protected $fillable = ['branch_id', 'title', 'image', 'url', 'description'];
}

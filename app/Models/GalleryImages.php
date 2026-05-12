<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GalleryImages extends Model
{
    //
    protected $table = 'gallery_images';
    protected $fillable = ['branch_id', 'category_id', 'title', 'image'];

}

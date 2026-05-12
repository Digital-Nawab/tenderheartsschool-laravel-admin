<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    //
    protected $table = 'branches';

    protected $fillable = [
        'title',
        'heading',
        'subheading',
        'slug_url',
        'image',
        'banner',
        'mobile_banner',
        'description',
        'about_title',
        'about_heading',
        'about_subheading',
        'about_description',
        'ths',
        'learn',
        'environment',
        'is_front',
        'is_active',
    ];
    public function categories() {
        return $this->hasMany(GalleryCategory::class, 'branch_id');
    }
    
}

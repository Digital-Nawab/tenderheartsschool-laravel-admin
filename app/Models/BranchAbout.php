<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BranchAbout extends Model
{
    //
    protected $table = 'branch_abouts';

    protected $fillable = [
        'branch_id',
        'title',
        'heading',
        'subheading',
        'image',
        'banner',
        'mobile_banner',
        'description',
        'long_description',
        'vision',
        'mission',
        'value',
    ];
}

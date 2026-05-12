<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    //

    protected $fillable = [
        'parent_name',
        'child_name',
        'phone',
        'dob',
        'message',
    ];
}

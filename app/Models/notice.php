<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class notice extends Model
{
    protected $table = 'notices';

    protected $fillable = [
        'title',
        'url',
        'date',
        'description',
        'status',
        'created_at',
        'updated_at',
    ];

}

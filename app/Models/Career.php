<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    protected $table = 'careers';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'subject',
        'resume',
        'message',
        'created_at',
        'updated_at',
    ];
}

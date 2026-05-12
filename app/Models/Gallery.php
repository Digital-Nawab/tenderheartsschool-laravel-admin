<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    //
    protected $table = 'galleries';
    protected $fillable= [
        'title',
        'is_front',
        'service_id',
        'image',
        'is_active',
    ];

    public function service(){
        return $this->belongsTo(Service::class, 'service_id', 'id');
    }
}

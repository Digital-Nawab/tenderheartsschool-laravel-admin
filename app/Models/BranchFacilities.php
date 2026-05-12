<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BranchFacilities extends Model
{
    //
    protected $table = 'branch_facilities';
    protected $fillable = ['branch_id', 'title', 'description', 'image'];
}

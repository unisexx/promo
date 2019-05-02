<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Emoji extends Model
{
    // use SoftDeletes;
    
    protected $fillable = array(
        'emoji_code',
        'category',
        'country',
        'title',
        'detail',
        'creator_name',
        'price',
        'slug',
        'threedays',
        'status',
        'user_id',
    );
    
    // protected $dates = ['deleted_at'];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sticker extends Model
{
    use SoftDeletes;
    
    protected $fillable = array('code','name','description','head_credit','foot_credit','user_id','status','version','hasanimation','hassound','stickerresourcetype');
    
    protected $dates = ['deleted_at'];
}

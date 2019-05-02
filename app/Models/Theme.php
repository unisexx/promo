<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Theme extends Model
{
    // use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'themes';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';
    
    protected $fillable = array('theme_code','name','description','price','head_credit','foot_credit','user_id','status','theme_path','slug');
    
    // protected $dates = ['deleted_at'];
}

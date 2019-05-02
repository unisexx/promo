<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Sticker extends Model
{
    // use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'stickers';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    protected $fillable = array('sticker_code', 'name', 'description', 'price', 'head_credit', 'foot_credit', 'user_id', 'status', 'version', 'hasanimation', 'hassound', 'stickerresourcetype', 'slug');
    
    // protected $dates = ['deleted_at'];

    public function stamp()
    {
        return $this->hasMany('App\Models\Stamp', 'sticker_id', 'id');
    }
}

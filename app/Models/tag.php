<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tag extends Model
{
    protected $fillable = array('sticker_id', 'sticker_code', 'stamp_code', 'name', 'version', 'url');
}

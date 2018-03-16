<?php
namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use DB;

class DeleteDuplicate extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * The number of minutes before cache expires.
     * False means no caching at all.
     *
     * @var int|float|bool
     */
    // public $cacheTime = 5;

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        DB::unprepared('delete n1 
        from
            stickers n1,
            stickers n2 
        where
            n1.id > n2.id 
            and n1.sticker_code = n2.sticker_code');
        return view('widgets.delete_duplicate');
    }
}

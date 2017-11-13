<?php

namespace App\Widgets;

use App\Models\Sticker;

use Arrilot\Widgets\AbstractWidget;

class OtherSticker extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        //
        $data['other'] = new Sticker;
		$data['other'] = $data['other']->inRandomOrder()->take(10)->get();

        return view('widgets.other_sticker', $data);
    }
}

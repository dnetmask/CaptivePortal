<?php

namespace App\Widgets;

use App\Models\WifiUser;
use Illuminate\Support\Str;
use TCG\Voyager\Widgets\BaseDimmer;

class ConnectionsDimmer extends BaseDimmer
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
        $count = WifiUser::count();
        $string = trans_choice('voyager::dimmer.wifi_connection', $count);

        return view('voyager::dimmer', array_merge($this->config, [
            'icon'   => 'voyager-wifi',
            'title'  => "{$count} {$string}",
            'text'   => __('voyager::dimmer.wifi_connection_text', ['count' => $count, 'string' => Str::lower($string)]),
            'button' => [
                'text' => __('voyager::dimmer.wifi_connection_link_text'),
                'link' => route('voyager.wifi-users.index'),
            ],
            'image' => voyager_asset('images/widget-backgrounds/02.jpg'),
        ]));
    }

    /**
     * Determine if the widget should be displayed.
     *
     * @return bool
     */
    public function shouldBeDisplayed()
    {
        return app('VoyagerAuth')->user()->can('browse', new WifiUser());
    }
}

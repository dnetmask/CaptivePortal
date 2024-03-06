<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WifiUser extends Model
{
    protected $table    = 'wifi_users';

    protected $fillable = [
        'name',
        'email',
    ];

    /**
     * WLC fields:
     * 'client_mac',
     * 'ap_mac',
     * 'wlan',
     * 'redirect'
     */

    /**
     * Meraki fields:
     * 'base_grant_url',
     * 'user_continue_url',
     * 'node_id',
     * 'node_mac',
     * 'gateway_id',
     * 'client_ip',
     * 'client_mac',
     */
}

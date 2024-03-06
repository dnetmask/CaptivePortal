<?php

namespace Netmask\CautivePortal\Controllers\Handlers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class Meraki extends Controller implements Handler
{
    public function index(Request $request)
    {
        $request->session()->put([
            'base_grant_url' => $request->get('base_grant_url'),
            'user_continue_url' => $request->get('user_continue_url'),
            'node_id' => $request->get('node_id'),
            'node_mac' => $request->get('node_mac'),
            'gateway_id' => $request->get('gateway_id'),
            'client_ip' => $request->get('client_ip'),
            'client_mac' => $request->get('client_mac'),
        ]);

        /*
         * ?base_grant_url=https://n30.network-auth.com/splash/grant
         * &user_continue_url=http://192.168.1.56:8000/success
         * &node_id=8363975
         * &node_mac=XX:XX
         * &gateway_id=8363975
         * &client_ip=10.119.158.7
         * &client_mac=XX:XX
         */
    }

    public function store(Request $request)
    {
        $data = array_merge($request->all(), [
            'base_grant_url' => $request->session()->get('base_grant_url'),
            'user_continue_url' => $request->session()->get('user_continue_url'),
            'node_id' => $request->session()->get('node_id'),
            'node_mac' => $request->session()->get('node_mac'),
            'gateway_id' => $request->session()->get('gateway_id'),
            'client_ip' => $request->session()->get('client_ip'),
            'client_mac' => $request->session()->get('client_mac'),
        ]);

        $savedWifiUser = \App\Models\WifiUser::create($data);

        if (!$savedWifiUser) {
            dd('Error al registrar usuario');
        }

        Session::put('user', $savedWifiUser);
        return Redirect::route('cautiveportal.validateotp');
    }

    public function afterStore(Request $request)
    {
        //$redirectUrl    = $request->session()->get('user_continue_url');
        $redirectUrl = setting('site.redirect_to');

        // IF THERE'S NO REDIRECT URL, GO TO /SUCCESS
        if (!$redirectUrl) {
            $redirectUrl = route('cautiveportal.success');
        }

        $base_grant_url = $request->session()->get('base_grant_url');

        // IF THE SESSION IS MAYBE LOST, REDIRECT DIRECTLY
        if (!$base_grant_url) {
            return redirect($redirectUrl);
        }

        if (strlen($redirectUrl) > 2048) {
            $redirectUrl = substr($redirectUrl, 0, 2048);
        }

        // GRANT INTERNET ACCESS AND REDIRECT?
        return redirect($base_grant_url . "?user_continue_url=" . urlencode($redirectUrl));
    }

    public function success()
    {
        return view('cautiveportal::success');
    }

    public function validateOtp(Request $request)
    {
        return view('cautiveportal::validateotp');
    }
}
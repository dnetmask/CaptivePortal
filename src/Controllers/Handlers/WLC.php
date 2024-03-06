<?php


namespace Netmask\CautivePortal\Controllers\Handlers;
use Netmask\CautivePortal\Models\WifiUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WLC extends Controller implements Handler
{
    public function index(Request $request)
    {
        $request->session()->put([
            'switch_url' => $request->get('switch_url'),
            'ap_mac' => $request->get('ap_mac'),
            'client_mac' => $request->get('client_mac'),
            'wlan' => $request->get('wlan'),
            'redirect' => $request->get('redirect'),
        ]);
    }

    public function store(Request $request)
    {
        $data = array_merge($request->all(), [
            'client_mac' => $request->session()->get('client_mac'),
            'ap_mac' => $request->session()->get('ap_mac'),
            'wlan' => $request->session()->get('wlan'),
            'redirect' => $request->session()->get('redirect'),
        ]);

        if (!\App\WifiUser::create($data)) {
            dd('Error al registrar usuario');
        }

        return redirect()->route('cautiveportal.afterstore');
    }

    public function afterStore(Request $request)
    {
        $switchUrl      = $request->session()->get('switch_url');
        $redirectUrl    = setting('site.redirect_to');

        if (!$redirectUrl) {
            $redirectUrl = route('cautiveportal.success');
        }

        if (strlen($redirectUrl) > 255) {
            $redirectUrl = substr($redirectUrl, 0,255);
        }

        if ($switchUrl) {
            $buttonClicked = 4;
            $errFlag = 0;

            return view('cautiveportal::wlc-afterstore', compact('switchUrl', 'redirectUrl', 'buttonClicked', 'errFlag'));
        } else {
            // IF SESSION IS LOST GETS HERE
            if ($redirectUrl) {
                return redirect($redirectUrl);
            } else {
                return redirect('/');
            }
        }
    }

    public function success() {
        return view('cautiveportal::success');
    }
}
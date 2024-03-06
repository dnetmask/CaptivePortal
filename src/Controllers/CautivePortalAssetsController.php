<?php

namespace Netmask\CautivePortal\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CautivePortalAssetsController extends Controller
{
    public function assets(Request $request)
    {
        $path = str_start(str_replace(['../', './'], '', urldecode($request->path)), '/');
        $path = base_path('vendor/netmask/cautiveportal/public/assets' . $path);
        if (File::exists($path)) {
            $mime = '';
            if (endsWith($path, '.js')) {
                $mime = 'text/javascript';
            } elseif (endsWith($path, '.css')) {
                $mime = 'text/css';
            } else {
                $mime = File::mimeType($path);
            }
            $response = response(File::get($path), 200, ['Content-Type' => $mime]);
            $response->setSharedMaxAge(31536000);
            $response->setMaxAge(31536000);
            $response->setExpires(new \DateTime('+1 year'));

            return $response;
        }

        return response('', 404);
    }
}

<?php

namespace App\Http\Controllers;

use Netmask\CautivePortal\Controllers\Handlers\WLC;
use Illuminate\Http\Request;

class CautivePortalController extends WLC
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        parent::index($request);

        return view('cautiveportal::index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //VALIDATE FORM DATA
        request()->validate([
            'name' => 'required',
            'email' => 'required|email',
        ], [
            'name.required' => 'Ingresa tu nombre',
            'email.required' => 'Ingresa tu email',
        ]);

        return parent::store($request);
    }

    /**
     * Redirection after the user has signed up
     * @param Request $request
     * @return Illuminate\Http\Response
     */
    public function afterStore(Request $request)
    {
        return parent::afterStore($request);
    }
}

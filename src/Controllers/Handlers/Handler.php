<?php


namespace Netmask\CautivePortal\Controllers\Handlers;

use Illuminate\Http\Request;

interface Handler
{
    /**
     * Display sign up form
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request);

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request);

    /**
     * Redirection after the user has signed up
     * @param Request $request
     * @return Illuminate\Http\Response
     */
    public function afterStore(Request $request);

    /**
     * Redirection after the user register to validate OTP
     * @param Request $request
     * @return Illuminate\Http\Response
     */
    public function generateOtp(Request $request);

}
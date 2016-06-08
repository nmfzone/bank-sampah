<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Awesome\Contracts\Controllers\HomeContract;

class HomeController extends Controller implements HomeContract
{
    /**
     * Display the application landing page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('landing');
    }

}

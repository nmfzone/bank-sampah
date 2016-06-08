<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Awesome\Contracts\Controllers\DashboardContract;

use App\User;
use App\Category;

class DashboardController extends Controller implements DashboardContract
{

    private $user;

    public function __construct()
    {
        $this->user = auth()->user();
    }

    /**
     * Display the dashboard welcome page to the Administrator.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin()
    {
        return view('dashboard.admin.index');
    }

    /**
     * Display the dashboard welcome page to the User.
     *
     * @return \Illuminate\Http\Response
     */
    public function user()
    {
        return view('dashboard.user.index');
    }


}

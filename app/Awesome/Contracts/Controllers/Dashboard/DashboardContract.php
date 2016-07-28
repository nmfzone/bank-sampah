<?php

namespace App\Awesome\Contracts\Controllers\Dashboard;

interface DashboardContract
{
    /**
     * Display the dashboard welcome page to the Administrator.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin();

    /**
     * Display the dashboard welcome page to the User.
     *
     * @return \Illuminate\Http\Response
     */
    public function user();

}

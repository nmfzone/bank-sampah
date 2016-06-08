<?php

namespace App\Awesome\Facades\UserManagement;

use Illuminate\Support\Facades\Facade;

class UserManagementFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'UserManagement';
    }
}

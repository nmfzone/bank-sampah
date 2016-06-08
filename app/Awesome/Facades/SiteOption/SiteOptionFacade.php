<?php

namespace App\Awesome\Facades\SiteOption;

use Illuminate\Support\Facades\Facade;

class SiteOptionFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'SiteOption';
    }
}

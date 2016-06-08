<?php

namespace App\Awesome\Contracts\Facades;

interface SiteOptionContract
{

    /**
	 * Get Site Options value by it's name.
	 *
	 * @return mixed
	 */
    public static function get($name);

    /**
	 * Display company logo.
	 *
	 * @return string
	 */
    public static function displayCompanyLogo($width, $height);

}

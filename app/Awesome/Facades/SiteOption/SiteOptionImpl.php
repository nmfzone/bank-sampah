<?php

namespace App\Awesome\Facades\SiteOption;

use Exception;

use App\SiteOption;
use App\Awesome\Contracts\Facades\SiteOptionContract;

class SiteOptionImpl implements SiteOptionContract
{
    /**
	 * Get Site Options value by it's name.
	 *
	 * @return mixed
	 */
    public static function get($name)
    {
        try {
            $optionValue = SiteOption::where('name', $name)->first()->value;
        } catch(Exception $e) {
            throw new Exception("SiteOption with name '" . $name . "' not found!");
        }

        return $optionValue;
    }

    /**
	 * Display company logo.
	 *
	 * @return string
	 */
    public static function displayCompanyLogo($width, $height)
    {
        try {
            $siteName = self::get('site_name');
            $img = self::get('site_logo');
        } catch(Exception $e) {
            $siteName = "Awesome";
            $img = "/assets/images/uii.png";
        }
        if ($width != 0) {
            $width = " width='" . $width . "px'";
        }
        if ($height != 0) {
            $height = " height='" . $height . "px'";
        }
        return "<img class='center-block' alt='" . $siteName .  "' src='" . asset($img) . "'" . $width . $height . " />";
    }
}

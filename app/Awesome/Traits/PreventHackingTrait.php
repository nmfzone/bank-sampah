<?php

namespace App\Awesome\Traits;

trait PreventHackingTrait
{

    /**
     * Prevent Directory Tranversal Attack
     * Remove slash(/) and backslash(\)
     *
     * @param  string  $string
     * @return string
     */
    public function preventDTA($string)
    {
        return preg_replace ("~/~", "", stripslashes($string));
    }

}

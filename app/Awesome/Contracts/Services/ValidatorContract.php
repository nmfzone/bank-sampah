<?php

namespace App\Awesome\Contracts\Services;

interface ValidatorContract
{
    /**
     * Setup any customizations.
     *
     * @return void
     */
    public function _set_custom_stuff();

    /**
     * Allow only alphabets, numbers and dashes (hyphens and underscores)
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function validateAlphaNumbDashOnly($attribute, $value);

    /**
     * Attribute must be in positive range.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function validatePositive($attribute, $value);
}

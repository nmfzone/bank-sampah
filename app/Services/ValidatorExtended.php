<?php

namespace App\Services;

use Illuminate\Validation\Validator as IlluminateValidator;
use App\Awesome\Contracts\Services\ValidatorContract;

class ValidatorExtended extends IlluminateValidator implements ValidatorContract
{

    private $_custom_messages = [
        "alpha_numb_dash_only" => "The :attribute may only contain letters, numbers, and dashes.",
        "positive" => ":attribute yang dimasukkan harus positif, tidak boleh negatif.",
    ];

    /**
     * The constructor.
     */
    public function __construct($translator, $data, $rules, $messages = [], $customAttributes = [])
    {
        parent::__construct($translator, $data, $rules, $messages, $customAttributes);

        $this->_set_custom_stuff();
    }

    /**
     * Setup any customizations.
     *
     * @return void
     */
    public function _set_custom_stuff()
    {
        $this->setCustomMessages($this->_custom_messages);
    }

    /**
     * Allow only alphabets, numbers and dashes (hyphens and underscores)
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function validateAlphaNumbDashOnly($attribute, $value)
    {
        return (bool) preg_match("/^[A-Za-z0-9-_]+$/", $value);
    }

    /**
     * Attribute must be in positive range.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function validatePositive($attribute, $value)
    {
        return ($value >= 0);
    }

}

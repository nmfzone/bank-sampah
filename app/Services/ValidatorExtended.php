<?php

namespace App\Http\Services;

use Illuminate\Validation\Validator as IlluminateValidator;
use App\Awesome\Contracts\Services\ValidatorContract;

class ValidatorExtended extends IlluminateValidator implements ValidatorContract
{

	private $_custom_messages = [
		"alpha_numb_dash_only" => "The :attribute may only contain letters, numbers, and dashes.",
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
	protected function _set_custom_stuff()
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
	protected function validateAlphaNumbDashOnly($attribute, $value)
	{
		return (bool) preg_match("/^[A-Za-z0-9-_]+$/", $value);
	}

}

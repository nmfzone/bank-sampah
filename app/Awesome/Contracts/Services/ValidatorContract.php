<?php

namespace App\Awesome\Contracts\Services;

interface ValidatorContract
{
    /**
	 * Setup any customizations.
	 *
	 * @return void
	 */
	protected function _set_custom_stuff();

	/**
	 * Allow only alphabets, numbers and dashes (hyphens and underscores)
	 *
	 * @param string $attribute
	 * @param mixed $value
	 * @return bool
	 */
	protected function validateAlphaNumbDashOnly($attribute, $value);
}

<?php

namespace App\Awesome\Contracts\Services;

interface MessagesTranslatorContract
{
    /**
     * Set the translator base key.
     *
     * @param  string  $base
     * @return $this
     */
    public function setBase($base);

    /**
     * Get the translation for a given key that concatenate with the base key.
     *
     * @param  string  $id
     * @param  array   $parameters
     * @param  string  $domain
     * @param  string  $locale
     * @return string
     */
    public function shout($id, array $parameters = [], $domain = 'messages', $locale = null);
}

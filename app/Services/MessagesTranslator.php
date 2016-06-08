<?php

namespace App\Services;

// use Illuminate\Translation\Translator as BaseTranslator;

use App\Awesome\Contracts\Services\MessagesTranslatorContract;

class MessagesTranslator implements MessagesTranslatorContract
{
    /**
     * The translator base key.
     *
     * @var string
     */
    protected $base;

    /**
     * Set the translator base key.
     *
     * @param  string  $base
     * @return $this
     */
    public function setBase($base)
    {
        $this->base = $base;

        return $this;
    }

    /**
     * Get the translation for a given key that concatenate with the base key.
     *
     * @param  string  $id
     * @param  array   $parameters
     * @param  string  $domain
     * @param  string  $locale
     * @return string
     */
    public function shout($id, array $parameters = [], $domain = 'messages', $locale = null)
    {
        $id = $this->base . '.' . $id;

        return trans($id, $parameters, $domain, $locale);
    }

}

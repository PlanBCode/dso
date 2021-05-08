<?php

namespace App\Classes\Form;

trait AttributesAwareTrait
{
    /** @var array */
    protected $attributes = [];

    public function setAttributes(array $attributes)
    {
        $this->attributes = $attributes;

        return $this;
    }

    public function addAttribute(string $value, string $key = null)
    {
        if (!$key) {
            $this->attributes[] = $value;
        } elseif (array_key_exists($key, $this->attributes)) {
            $this->attributes[$key] .= ' '. $value;
        } else {
            $this->attributes[$key] = $value;
        }

        return $this;
    }
}

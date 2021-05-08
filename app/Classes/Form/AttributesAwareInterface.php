<?php

namespace App\Classes\Form;

interface AttributesAwareInterface
{
    public function setAttributes(array $attributes);

    public function addAttribute(string $key, string $value);
}

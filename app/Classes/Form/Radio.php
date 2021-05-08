<?php

namespace App\Classes\Form;

class Radio extends AbstractFormField implements OptionsAwareInterface
{
    use OptionsAwareTrait;

    public function getType(): string
    {
        return 'radio';
    }
}

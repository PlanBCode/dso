<?php

namespace App\Classes\Form;

class Select extends AbstractFormField implements OptionsAwareInterface
{
    use OptionsAwareTrait;

    public function getType(): string
    {
        return 'select';
    }
}

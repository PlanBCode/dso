<?php

namespace App\Classes\Form;

class Textarea extends AbstractFormField
{
    public function getType(): string
    {
        return 'textarea';
    }
}

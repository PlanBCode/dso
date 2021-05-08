<?php

namespace App\Classes\Form;

interface OptionsAwareInterface extends FormFieldInterface
{
    public function addOption(Option $option): OptionsAwareInterface;

    public function getOptions(): array;

    public function getOptionLabel(Option $option): ?string;

    public function getOptionId(Option $option): string;

    public function isOptionSelected(Option $option): bool;
}

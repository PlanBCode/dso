<?php

namespace App\Classes\Form;

trait OptionsAwareTrait
{
    abstract function getValue();

    /** @var Option[] */
    protected $options = [];

    public function addOption(Option $option): OptionsAwareInterface
    {
        if ($this instanceof OptionsAwareInterface) {
            $option->setParent($this);
        }
        $this->options[$option->getValue()] = $option;

        return $this;
    }

    public function getOptions(): array
    {
        return $this->options;
    }

    public function getOptionLabel(Option $option): ?string
    {
        return $option->getLabel() ?? $option->getValue();
    }

    public function getOptionId(Option $option): string
    {
        return $this->getId().'_'.$option->getValue();
    }

    public function isOptionSelected(Option $option): bool
    {
        $value = $this->getValue();
        $optionValue = $option->getValue();

        return is_array($value) ? in_array($optionValue, $value) : $optionValue === $value;
    }
}

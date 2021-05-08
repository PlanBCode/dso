<?php

namespace App\Classes\Form;

class Checkbox extends AbstractFormField implements OptionsAwareInterface
{
    use OptionsAwareTrait;

    protected $multi = false;

    public function __construct(string $name, bool $multi = false)
    {
        parent::__construct($name);
        $this->multi = $multi;
        if (!$this->multi) {
            $this->setBooleanOption();
        }
    }

    public function getType(): string
    {
        return 'checkbox';
    }

    protected function setBooleanOption(): Checkbox
    {
        $this->options = [];
        $this->addOption(new Option(true));

        return $this;
    }

    protected function isBoolValue(): bool
    {
        $option = reset($this->options);

        return !$this->multi && count($this->options) === 1 && $option->getValue() === true;
    }

    public function getElementName(): string
    {
        return $this->name.($this->multi ? '[]' : '');
    }

    public function getOptionLabel(Option $option): ?string
    {
        return $option->getLabel() ?? $this->multi ? $option->getValue() : $option->getLabel();
    }

    public function getOptionId(Option $option): string
    {
        return $this->getId().($this->multi ? '_'.$option->getValue() : '');
    }

    public function getValue()
    {
        $value = parent::getValue();
        if ($this->isBoolValue()) {
            $value = (bool)$value;
        }

        return $value;
    }
}

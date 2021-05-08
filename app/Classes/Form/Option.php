<?php

namespace App\Classes\Form;

use Str;

class Option
{
    use AttributesAwareTrait;

    /** @var string */
    protected $label;

    /** @var null|mixed */
    protected $value;

    /** @var OptionsAwareInterface */
    protected $parent;

    /**
     * @param  null|mixed  $value
     */
    public function __construct($value = null)
    {
        $this->value = $value;
    }

    public function setLabel(string $label): Option
    {
        $this->label = $label;

        return $this;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setValue($value): Option
    {
        $this->value = $value;

        return $this;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setParent(OptionsAwareInterface $parent)
    {
        $this->parent = $parent;
    }

    public function getId(): string
    {
        return $this->parent->getOptionId($this);
    }

    public function getViewData(): array
    {
        return [
            'id' => $this->getId(),
            'label' => $this->parent->getOptionLabel($this),
            'value' => $this->value,
            'selected' => $this->parent->isOptionSelected($this),
            'attrs' => $this->attributes,
        ];
    }
}

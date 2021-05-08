<?php

namespace App\Classes\Form;

abstract class AbstractFormField implements AttributesAwareInterface, FormFieldInterface
{
    use AttributesAwareTrait;

    /** @var string */
    protected $name;

    /** @var string */
    protected $label;

    /** @var bool */
    protected $required = false;

    /** @var string */
    protected $regex;

    /** @var string */
    protected $idPrefix;

    /** @var mixed */
    protected $value;

    /** @var string */
    protected $addon;

    /** @var string */
    protected $comment;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getElementName(): string
    {
        return $this->name;
    }

    abstract public function getType(): string;

    public function setIdPrefix(string $idPrefix): FormFieldInterface
    {
        $this->idPrefix = $idPrefix;

        return $this;
    }

    public function getId(): string
    {
        return ($this->idPrefix ? $this->idPrefix.' ' : '').$this->name;
    }

    public function setLabel(string $label): FormFieldInterface
    {
        $this->label = $label;

        return $this;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setRequired(bool $required = true): FormFieldInterface
    {
        $this->required = $required;

        return $this;
    }

    public function setRegex(string $regex): FormFieldInterface
    {
        $this->regex = $regex;

        return $this;
    }

    public function setValue($value = null): FormFieldInterface
    {
        $this->value = $value;

        return $this;
    }

    public function getValue()
    {
        return old($this->getElementName(), $this->value);
    }

    public function getAddon(): string
    {
        return $this->addon;
    }

    public function setAddon(string $addon): AbstractFormField
    {
        $this->addon = $addon;

        return $this;
    }

    public function setComment(string $comment): FormFieldInterface
    {
        $this->comment = $comment;

        return $this;
    }

    public function getComment(): string
    {
        return $this->comment;
    }

    public function getViewData(): array
    {
        $viewData = [
            'id' => $this->getId(),
            'name' => $this->getElementName(),
            'label' => $this->label,
            'value' => $this->getValue(),
            'type' => $this->getType(),
            'regex' => $this->regex,
            'attrs' => $this->attributes,
            'required' => $this->required,
            'addon' => $this->addon,
            'comment' => $this->comment,
        ];

        if ($this instanceof OptionsAwareInterface) {
            $viewData['options'] = [];
            foreach ($this->getOptions() as $option) {
                $viewData['options'][] = $option->getViewData();
            }
        }

        return $viewData;
    }

    public function render(): string
    {
        $data = ['field' => $this->getViewData()];

        return view('partial.form.form-field', $data)->render();
    }
}

<?php

namespace App\Classes\Form;

class Form
{
    /** @var string */
    protected $name;

    /** @var string */
    protected $action;

    /** @var string */
    protected $method;

    /** @var null|string */
    protected $idPrefix;

    /** @var FormFieldInterface[] */
    protected $fields = [];

    public function __construct(string $name, string $action, string $method = 'POST')
    {
        $this->name = $name;
        $this->action = $action;
        $this->method = $method;
    }

    public function setIdPrefix(?string $idPrefix): Form
    {
        $this->idPrefix = $idPrefix;

        return $this;
    }

    public function addField(FormFieldInterface $field): Form
    {
        $this->fields[$field->getName()] = $field;

        return $this;
    }

    public function render(): string
    {
        $data = ['fields' => $this->fields, 'action' => $this->action, 'method' => $this->method];

        return view('partial.form.form', $data)->render();
    }
}

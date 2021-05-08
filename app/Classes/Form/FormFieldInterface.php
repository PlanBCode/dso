<?php

namespace App\Classes\Form;

interface FormFieldInterface extends AttributesAwareInterface
{
    public function getName(): string;

    public function getElementName(): string;

    public function getType(): string;

    public function setIdPrefix(string $idPrefix): FormFieldInterface;

    public function getId(): string;

    public function setLabel(string $label): FormFieldInterface;

    public function getLabel(): ?string;

    public function setRequired(bool $required = true): FormFieldInterface;

    public function setRegex(string $regex): FormFieldInterface;

    public function setValue($value = null): FormFieldInterface;

    public function getValue();

    public function getViewData(): array;

    public function render(): string;
}

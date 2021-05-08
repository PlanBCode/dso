<?php

namespace App\Classes\Form;

use Exception;

class Text extends AbstractFormField
{
    const SUB_TYPE_BUTTON = 'button';
    const SUB_TYPE_COLOR = 'color';
    const SUB_TYPE_DATE = 'date';
    const SUB_TYPE_DATETIME_LOCAL = 'datetime-local';
    const SUB_TYPE_EMAIL = 'email';
    const SUB_TYPE_FILE = 'file';
    const SUB_TYPE_HIDDEN = 'hidden';
    const SUB_TYPE_IMAGE = 'image';
    const SUB_TYPE_MONTH = 'month';
    const SUB_TYPE_NUMBER = 'number';
    const SUB_TYPE_PASSWORD = 'password';
    const SUB_TYPE_RANGE = 'range';
    const SUB_TYPE_RESET = 'reset';
    const SUB_TYPE_SEARCH = 'search';
    const SUB_TYPE_SUBMIT = 'submit';
    const SUB_TYPE_TEL = 'tel';
    const SUB_TYPE_TEXT = 'text';
    const SUB_TYPE_TIME = 'time';
    const SUB_TYPE_URL = 'url';
    const SUB_TYPE_WEEK = 'week';

    const SUB_TYPES = [
        self::SUB_TYPE_BUTTON,
        self::SUB_TYPE_COLOR,
        self::SUB_TYPE_DATE,
        self::SUB_TYPE_DATETIME_LOCAL,
        self::SUB_TYPE_EMAIL,
        self::SUB_TYPE_FILE,
        self::SUB_TYPE_HIDDEN,
        self::SUB_TYPE_IMAGE,
        self::SUB_TYPE_MONTH,
        self::SUB_TYPE_NUMBER,
        self::SUB_TYPE_PASSWORD,
        self::SUB_TYPE_RANGE,
        self::SUB_TYPE_RESET,
        self::SUB_TYPE_SEARCH,
        self::SUB_TYPE_SUBMIT,
        self::SUB_TYPE_TEL,
        self::SUB_TYPE_TEXT,
        self::SUB_TYPE_TIME,
        self::SUB_TYPE_URL,
        self::SUB_TYPE_WEEK,
    ];

    /** @var string */
    protected $subType;

    public function getType(): string
    {
        return 'text';
    }

    /**
     * @param  string  $subType
     *
     * @return $this|AbstractFormField
     * @throws Exception
     */
    public function setSubType(string $subType): AbstractFormField
    {
        if (!in_array($subType, self::SUB_TYPES)) {
            throw new Exception('invalid sub type given');
        }
        $this->subType = $subType;

        return $this;
    }

    public function getViewData(): array
    {
        $viewData = [];
        if ($this->subType && $this->subType !== $this->getType()) {
            $viewData['sub_type'] = $this->subType;
        }

        return $viewData + parent::getViewData();
    }
}

<?php


namespace App\Form;


class GeneratorViewForm extends BaseForm
{
    const ID_LENGTH_MIN = 32;
    const ID_REGEX      = '/^[a-zA-Z0-9]+$/';

    // Rules for validation
    const ARRAY_FIELDS_RULES =
    [
        'id' => 'required|min:' . self::ID_LENGTH_MIN . '|regex:' . self::ID_REGEX,
    ];
}
<?php


namespace App\Form;


class LoginForm extends BaseForm
{
    const PASSWORD_LENGTH_MIN = 6;
    const PASSWORD_REGEX      = '/^[a-zA-Z0-9]+$/';
    const NICKNAME_REGEX      = '/^[a-zA-Z]+$/';

    // Rules for validation
    const ARRAY_FIELDS_RULES =
    [
        'nickname'     => 'required|regex:' . self::NICKNAME_REGEX ,
        'password'     => 'required|min:' . self::PASSWORD_LENGTH_MIN . '|regex:' . self::PASSWORD_REGEX,
    ];
}
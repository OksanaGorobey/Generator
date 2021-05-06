<?php

declare(strict_types=1);
/**
 * @package     Form
 * @version     1.5
 */
namespace App\Form
{
    class BaseForm extends \Rakit\Validation\Validator
    {
        /** @var null|\Rakit\Validation\Validation */
        private $validator;

        /**
         * Create form for validate
         *
         * @param array $params
         */
        public function form(array $params ): void
        {
            $this->validator = $this->make(
                $params,
                static::ARRAY_FIELDS_RULES
            );
        }

        /**
         * Check if params is valid by rules
         *
         * @return bool
         */
        public function isValid(): bool
        {
            $this->validator->validate();

            return !$this->validator->fails();
        }

        /**
         * Get first error on validation
         *
         * @return string
         */
        public function getErrorMessage(): string
        {
            $array_errors = $this->validator->errors()->firstOfAll();

            return array_shift( $array_errors );
        }
    }
}

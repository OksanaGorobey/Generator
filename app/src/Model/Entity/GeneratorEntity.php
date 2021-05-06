<?php

/**
 * @package     model
 * @category    entity
 * @version     1.5
 */
namespace App\Model\Entity
{
    class GeneratorEntity extends BaseEntity
    {
        private $id;
        private $value;

        /**
         * @return int
         */
        public function getValue(): ?int
        {
            return $this->value;
        }

        /**
         * @param int|null $value
         */
        public function setValue( ?int $value ): void
        {
            $this->value = $value;
        }

        /**
         * @return string|null
         */
        public function getId(): ?string
        {
            return $this->id;
        }

        /**
         * @param string|null $id
         */
        public function setId( ?string $id ): void
        {
            $this->id = $id;
        }
    }
}
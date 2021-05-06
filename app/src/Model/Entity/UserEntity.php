<?php

/**
 * @package     model
 * @category    entity
 * @version     1.5
 */
namespace App\Model\Entity
{
    class UserEntity extends BaseEntity
    {
        private $id;
        private $nickname;
        private $password;
        private $created_date;

        /**
         * @return int
         */
        public function getId(): int
        {
            return $this->id;
        }

        /**
         * @param int $id
         */
        public function setId( int $id ): void
        {
            $this->id = $id;
        }

        /**
         * @return string
         */
        public function getNickname(): string
        {
            return $this->nickname;
        }

        /**
         * @param string $nickname
         */
        public function setNickname( string $nickname ): void
        {
            $this->nickname = $nickname;
        }

        /**
         * @return string|null
         */
        public function getPassword(): ?string
        {
            return $this->password;
        }

        /**
         * @param string|null $password
         */
        public function setPassword( ?string $password): void
        {
            $this->password = $password;
        }

        /**
         * @return string|null
         */
        public function getCreatedDate(): string
        {
            return $this->created_date;
        }

        /**
         * @param string|null $created_date
         */
        public function setCreatedDate( ?string $created_date ): void
        {
            $this->created_date = $created_date;
        }
    }
}
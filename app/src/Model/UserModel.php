<?php

/**
 * @package     model
 * @version     1.5
 */
namespace App\Model
{
    /**
     * Class UserModel
     */
    class UserModel extends BaseModel
    {
        /**
         * Get user for login
         *
         * @param string $nickname
         * @param string $password
         * @return Entity\BaseEntity
         * @throws \Exception
         */
        public function getOne(string $nickname, string $password ): \App\Model\Entity\BaseEntity
        {
            /* Run a query using the connection */
            $stmt = $this->db->prepare(
                'CALL generator.get_user_name( :nickname, :password );'
            );

            $stmt->execute(
                [
                    ':nickname' => $nickname,
                    ':password' => \App\lib\common::createHash( $password )
                ]
            );

            return $stmt->fetchAll(\PDO::FETCH_CLASS, \App\Model\Entity\UserEntity::class)[0];
        }
    }
}

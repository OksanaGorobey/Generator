<?php

/**
 * @package     model
 * @version     1.5
 */
namespace App\Model
{
    /**
     * Class GeneratorModel
     */
    class GeneratorModel extends BaseModel
    {
        /**
         * Get value by id
         *
         * @param string $id
         * @return Entity\BaseEntity
         * @throws \App\lib\exceptions\baseException
         */
        public function getOne( string $id ): \App\Model\Entity\BaseEntity
        {
            /* Run a query using the connection */
            $stmt = $this->db->prepare(
                'CALL generator.get_generator( :id );'
            );

            $stmt->execute(
                [
                    ':id' => $id,
                ]
            );

            $response = $stmt->fetchAll( \PDO::FETCH_CLASS, \App\Model\Entity\GeneratorEntity::class );

            if( empty( $response ) )
            {
                throw new \App\lib\exceptions\baseException(
                    'ID not found.',
                    \App\lib\consts::ERROR_CODE_ID_NOT_FOUND
                );
            }

            return $response[0];
        }

        /**
         * Generate new value, id or return old value by id
         *
         * @return Entity\BaseEntity
         * @throws \Exception
         */
        public function create(): \App\Model\Entity\BaseEntity
        {
            $value  = \random_int( \App\lib\consts::MIN_RANGE, \App\lib\consts::MAX_RANGE );
            $id     = md5( $value );

            /* Run a query using the connection */
            $stmt = $this->db->prepare(
                'CALL generator.create_generator( :id, :value );'
            );

            $stmt->execute(
                [
                    ':id'    => $id,
                    ':value' => $value
                ]
            );

            return $stmt->fetchAll( \PDO::FETCH_CLASS, \App\Model\Entity\GeneratorEntity::class )[0];
        }
    }
}

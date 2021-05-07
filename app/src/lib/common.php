<?php declare(strict_types=1);
/**
 * @package     lib
 * @version     1.5
 */
namespace App\lib
{
    /**
     * Class common
     */
    class common
    {
        ///////////////////////////////////////////////////////////////////////////

        protected const HASH_ALGORITHM = 'sha256';
        protected const HASH_SALT1     = 'hqdO03pNlJNAeMtl0BWHNLcQs4lMnpW6sOEhUmfTi0xSX8ghFApHGy0HMjtoGpf4pcbF3CBGIolJUa9GhGCACYUhdnvnJHVdLNr9xksBQFjItRpidX9i4jnefWN8rDgv';
        protected const HASH_SALT2     = 'RIpMX65413Tl3Q4hG7xzfPjhSsfrQIxf1GfAxoeC5YisBfSr3IEUhMhh9MctmfVAHpi9Ddmwjc9GWoUGMcDkdVKP4tDxRrSJno5fcpIc9FyEvTZeFJlYGwZsWY3vOmPD';

        /**
         * Створення хешу
         *
         * @param string $string
         *
         * @return string
         * @throws \Exception
         */
        public static function createHash(string $string): string
        {
            if( !in_array( self::HASH_ALGORITHM, hash_algos() ) )
            {
                throw new \Exception( \App\lib\consts::ERROR_HASH_ALGORITHM_NOT_FOUND );
            }

            $hash   = '//' . self::HASH_SALT1 . '//' . base64_encode( $string ) . '//';
            $pieces = str_split( self::HASH_SALT2, 10 );

            for( $i = 0; $i < 10000; ++$i )
            {
                $hash = hash( self::HASH_ALGORITHM, $pieces[ ( $i % 10 ) ] . '|' . $hash );
            }

            return $hash;
        }

        ///////////////////////////////////////////////////////////////////////////

    }
}
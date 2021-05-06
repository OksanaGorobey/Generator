<?php declare(strict_types=1);
/**
 * @package     lib
 * @category    exceptions
 * @version     1.5
 */
namespace App\lib\exceptions
{
    /**
     * baseException
     */
    class baseException extends \Exception
    {
        ///////////////////////////////////////////////////////////////////////

        /**
         *  Get format for response
         *
         * @return      array
         */
        public function getData() : array
        {
            $data =
            [
                'code'          => $this->getCode() ?? \App\lib\consts::APPLICATION_CODE_INTERNAL_SERVER_ERROR,
                'content'       => []
            ];


            if( !empty( $this->getMessage() ) )
            {
                $data['content']['message'] = $this->getMessage();
            }

            return $data;
        }

        ///////////////////////////////////////////////////////////////////////
    }
}
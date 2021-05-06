<?php declare(strict_types=1);
/**
 * @package     lib
 * @version     1.2
 */
namespace App\lib
{
    /**
     * consts Class
     */
    class consts
    {
        const JSON_UNESCAPED_UNICODE                                = 256;

        // HTTP CODES //////////////////////////////////////////////////////////

        const HTTP_CODE_OK                                          = 200;
        const HTTP_CODE_CREATED                                     = 201;
        const HTTP_CODE_FOUND                                       = 302;
        const HTTP_CODE_BAD_REQUEST                                 = 400;
        const HTTP_CODE_UNAUTHORIZED                                = 401;
        const HTTP_CODE_FORBIDDEN                                   = 403;
        const HTTP_CODE_NOT_FOUND                                   = 404;
        const HTTP_CODE_NOT_ALLOWED                                 = 405;
        const HTTP_CODE_INTERNAL_SERVER_ERROR                       = 500;

        // APPLICATION CODES ///////////////////////////////////////////////////

        const APPLICATION_CODE_OK                                   = 200;
        const APPLICATION_CODE_FOUND                                = 302;
        const APPLICATION_CODE_UNAUTHORIZED                         = 401;
        const APPLICATION_CODE_FORBIDDEN                            = 403;
        const APPLICATION_CODE_NOT_FOUND                            = 404;
        const APPLICATION_CODE_INTERNAL_SERVER_ERROR                = 500;

        /////// common //////////////////////////////////////////////////////////

        const ERROR_HASH_ALGORITHM_NOT_FOUND                        = 10001;

        /////// login //////////////////////////////////////////////////////////

        const ERROR_CODE_USER_LOGIN_FIELDS_INCORRECT                = 10101;
        const ERROR_CODE_USER_LOGIN_USER_NOT_FOUND                  = 10102;

         /////// list //////////////////////////////////////////////////////////

        const ERROR_CODE_GENERATE_ERROR                             = 10201;

        /////// view /////////////////////////////////////////////////////////

        const ERROR_CODE_ID_FIELDS_INCORRECT                        = 10301;
        const ERROR_CODE_ID_NOT_FOUND                               = 10302;

        ////// generate //////////////////////////////////////////////////////

        const MIN_RANGE                                             = 1;
        const MAX_RANGE                                             = 100000;

        ////////////////////////////////////////////////////////////////////////
    }
}
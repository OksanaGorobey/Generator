<?php declare(strict_types=1);
/**
 * @package     controller
 * @version     1.5
 */
namespace App\Controller 
{
    /**
     * Class BaseController
     */
    class BaseController
    {
        protected $response;
        protected $request;

        ///////////////////////////////////////////////////////////////////////

        public function __construct( \Psr\Http\Message\ServerRequestInterface $request )
        {
            /* Set request values in variable */
            $this->request = $request;
        }

        ///////////////////////////////////////////////////////////////////////

        /**
         * Base index
         *
         * @return \Psr\Http\Message\ResponseInterface
         */
        public function indexAction(): \Psr\Http\Message\ResponseInterface
        {
            return new \Laminas\Diactoros\Response\JsonResponse(
                [
                    'code'      => \App\lib\consts::HTTP_CODE_OK,
                    'content'   =>
                    [
                        'message' => 'General Page'
                    ]
                ]
            );
        }

        ///////////////////////////////////////////////////////////////////////

        /**
         * Check facility of access
         *
         * @return \Psr\Http\Message\ResponseInterface
         */
        public function pingAction(): \Psr\Http\Message\ResponseInterface
        {
            return new \Laminas\Diactoros\Response\JsonResponse(
                [
                    'code' => \App\lib\consts::HTTP_CODE_OK,
                    'content' =>
                    [
                        'message' => 'pong'
                    ]
                ]
            );
        }
        ///////////////////////////////////////////////////////////////////////

        /**
         * Error 400
         *
         * @return \Psr\Http\Message\ResponseInterface
         *
         */
        public function error400Action(): \Psr\Http\Message\ResponseInterface
        {
            return new \Laminas\Diactoros\Response\JsonResponse(
                [
                    'code'      => \App\lib\consts::HTTP_CODE_BAD_REQUEST,
                    'content'   =>
                    [
                        'message' => 'HTTP/1.0 400 Bad Request. Token not found in request.'
                    ]
                ]
            );
        }

        ///////////////////////////////////////////////////////////////////////

        /**
         * Error 401
         *
         * @return \Psr\Http\Message\ResponseInterface
         *
         */
        public function error401Action(): \Psr\Http\Message\ResponseInterface
        {
            return new \Laminas\Diactoros\Response\JsonResponse(
                [
                    'code'      => \App\lib\consts::HTTP_CODE_UNAUTHORIZED,
                    'content'   =>
                    [
                        'message' => 'HTTP/1.1 401 Unauthorized. Token not valid in request.'
                    ]
                ]
            );
        }

        ///////////////////////////////////////////////////////////////////////

        /**
         * Error 403
         *
         * @return \Psr\Http\Message\ResponseInterface
         *
         */
        public function error403Action(): \Psr\Http\Message\ResponseInterface
        {
            return new \Laminas\Diactoros\Response\JsonResponse(
                [
                    'code'      => \App\lib\consts::HTTP_CODE_FORBIDDEN,
                    'content'   =>
                    [
                        'message' => 'HTTP/1.1 403 Forbidden.'
                    ]
                ]
            );
        }

        ///////////////////////////////////////////////////////////////////////

        /**
         * Error 404
         *
         * @return \Psr\Http\Message\ResponseInterface
         *
         */
        public function error404Action(): \Psr\Http\Message\ResponseInterface
        {
            return new \Laminas\Diactoros\Response\JsonResponse(
                [
                    'code'      => \App\lib\consts::HTTP_CODE_NOT_FOUND,
                    'content'   =>
                    [
                        'message' => 'HTTP/1.1 404 Not Found. This method not found.'
                    ]
                ]
            );
        }

        ///////////////////////////////////////////////////////////////////////

        /**
         * Error 405
         *
         * @return \Psr\Http\Message\ResponseInterface
         *
         */
        public function error405Action(): \Psr\Http\Message\ResponseInterface
        {
            $methods = $this->request->getQueryParams()['method'] ?? 'GET';

            return new \Laminas\Diactoros\Response\JsonResponse(
                [
                    'code'      => \App\lib\consts::HTTP_CODE_NOT_ALLOWED,
                    'content'   =>
                    [
                        'message' => sprintf( 'HTTP/1.1 405 Not Found. This method not allowed. Allowed: %s', $methods )
                    ]
                ]
            );
        }

        ///////////////////////////////////////////////////////////////////////
    }
}
<?php declare(strict_types=1);
/**
 * @package     controller
 * @version     1.5
 */
namespace App\Controller
{
    class LoginController extends BaseController
    {
        /**
         * Login method return token value
         *
         * @return \Psr\Http\Message\ResponseInterface
         */
        public function loginAction(): \Psr\Http\Message\ResponseInterface
        {
            try
            {
                $params = \json_decode($this->request->getBody()->getContents(), true);

                $formLogin = new \App\Form\LoginForm();

                $formLogin->form($params);

                if( !$formLogin->isValid() )
                {
                    throw new \App\lib\exceptions\baseException(
                        $formLogin->getErrorMessage(),
                        \App\lib\consts::ERROR_CODE_USER_LOGIN_FIELDS_INCORRECT
                    );
                }

                $user  = ( new \App\Model\UserModel() )->getOne( $params['nickname'], $params['password'] );

                if( empty( $user ) )
                {
                    throw new \App\lib\exceptions\baseException(
                        'Nickname or password incorrect.',
                        \App\lib\consts::ERROR_CODE_USER_LOGIN_USER_NOT_FOUND
                    );
                }

                $this->response =
                [
                    'code' => \App\lib\consts::APPLICATION_CODE_OK,
                    'content' =>
                    [
                        'token' => \App\lib\JwtAuthenticator::generateToken( $user->getNickname() )
                    ]
                ];
            }
            catch (\App\lib\exceptions\baseException $e)
            {
                $this->response = $e->getData();
            }
            finally
            {
                return new \Laminas\Diactoros\Response\JsonResponse( $this->response );
            }
        }
    }
}
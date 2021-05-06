<?php declare(strict_types=1);
/**
 * @package     controller
 * @version     1.5
 */
namespace App\Controller
{
    class GeneratorController extends BaseController
    {
        /**
         * Generate method return id and value
         *
         * @return \Psr\Http\Message\ResponseInterface
         */
        public function generateAction(): \Psr\Http\Message\ResponseInterface
        {
            try
            {
                $generated  = ( new \App\Model\GeneratorModel() )->create();

                if( empty( $generated ) )
                {
                    throw new \App\lib\exceptions\baseException(
                        'Sooooorrrryyyyy .',
                        \App\lib\consts::ERROR_CODE_GENERATE_ERROR
                    );
                }

                $this->response =
                [
                    'code' => \App\lib\consts::APPLICATION_CODE_OK,
                    'content' =>
                    [
                        'value' => $generated->getValue(),
                        'id'    => $generated->getId()
                    ]
                ];
            }
            catch (\App\lib\exceptions\baseException|\Exception $e)
            {
                $this->response = $e->getData();
            }
            finally
            {
                return new \Laminas\Diactoros\Response\JsonResponse( $this->response );
            }
        }

        /**
         * Generate method return id and value
         *
         * @return \Psr\Http\Message\ResponseInterface
         */
        public function viewAction(): \Psr\Http\Message\ResponseInterface
        {
            try
            {
                $id = $this->request->getQueryParams()['id'];

                $formLogin = new \App\Form\GeneratorViewForm();

                $formLogin->form( $this->request->getQueryParams() );

                if( !$formLogin->isValid() )
                {
                    throw new \App\lib\exceptions\baseException(
                        $formLogin->getErrorMessage(),
                        \App\lib\consts::ERROR_CODE_ID_FIELDS_INCORRECT
                    );
                }

                $generated  = ( new \App\Model\GeneratorModel() )->getOne( $id );

                $this->response =
                [
                    'code' => \App\lib\consts::APPLICATION_CODE_OK,
                    'content' =>
                    [
                        'value' => $generated->getValue(),
                    ]
                ];
            }
            catch (\App\lib\exceptions\baseException|\Exception $e)
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
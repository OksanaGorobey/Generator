<?php declare(strict_types=1);
/**
 * @package     lib
 * @version     1.5
 */
namespace App\lib
{
    class JwtAuthenticator
    {
        private const SECRET_KEY            = 'bGS6lzFqvvSQ8ALbOxatm7/Vk7mLQyzqaS34Q4oR1ew=';
        private const SERVER_NAME           = 'localhost.generator';
        private const EXPIRE_TIME           = '+45 seconds';
        private const TOKEN_ID_LENGTH       = 16;
        private const HEADER_VALUE_PATTERN  = '/Bearer\s(\S+)/';
        private const JWT_SALT              = 'HS512';

        /** @var string|null */
        private $params;
        /** @var array|null */
        private $token;

        /**
         * JwtAuthenticator constructor.
         */
        public function __construct()
        {
            $this->params = $_SERVER['HTTP_AUTHORIZATION'];
        }

        /**
         * Generate Token for auth expire time 45 sec
         *
         * @param string $username
         * @return string
         * @throws \Exception
         */
        public static function generateToken( string $username = 'test' ): string
        {
            $issuedAt = new \DateTimeImmutable();

            // Encode the array to a JWT string.
            return \Firebase\JWT\JWT::encode(
                [
                    'iat' => $issuedAt->getTimestamp(),    // Issued at: time when the token was generated
                    'jti' => base64_encode( random_bytes( self::TOKEN_ID_LENGTH ) ), // token_id                    // Json Token Id: an unique identifier for the token
                    'iss' => self::SERVER_NAME,                  // Issuer
                    'nbf' => $issuedAt->getTimestamp(),    // Not before
                    'exp' => $issuedAt->modify( self::EXPIRE_TIME )->getTimestamp(), // Expire
                    'data' =>
                    [                             // Data related to the signer user
                        'userName' => $username,            // User name
                    ]
                ],      //Data to be encoded in the JWT
                self::SECRET_KEY, // The signing key
                self::JWT_SALT     // Algorithm used to sign the token, see https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40#section-3
            );
        }

        /**
         *
         * Validation header
         *
         * @return bool
         */
        public function validateHeader(): bool
        {
            $array_params = [];

            if( empty( $this->params ) )
            {
                return false;
            }

            // Attempt to extract the token from the Bearer header
            if( !preg_match( self::HEADER_VALUE_PATTERN, $this->params, $array_params ) )
            {
                return false;
            }

            $this->token = $array_params[1];

            // No token was able to be extracted from the authorization header
            if( !$this->token )
            {
                return false;
            }

            return true;
        }

        /**
         * Validation expired time end value
         *
         * @return bool
         */
        public function validateToken(): bool
        {
            try
            {
                \Firebase\JWT\JWT::$leeway += 300;

                $token = \Firebase\JWT\JWT::decode( ( string )$this->token, self::SECRET_KEY, [ self::JWT_SALT ] );

                $now   = new \DateTimeImmutable();

                if( $token->iss !== self::SERVER_NAME ||
                    $token->nbf > $now->getTimestamp() ||
                    $token->exp < $now->getTimestamp() )
                {
                    return false;
                }

                return true;
            }
            catch ( \Exception $e )
            {
                return false;
            }
        }
    }
}
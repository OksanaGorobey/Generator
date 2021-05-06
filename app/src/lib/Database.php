<?php declare(strict_types=1);
/**
 * @package     lib
 * @version     1.5
 */
namespace App\lib
{
    class Database
    {
        /**  @var string */
        private $host = 'mysql8-generator-container';
        /** @var int */
        private $port = 3306;
        /** @var string */
        private $db = 'generator';
        /** @var string */
        private $user = 'root';
        /** @var string */
        private $pass = 'secret';
        /** @var null|array */
        private $opt = NULL;
        /** @var string|null */
        private $dsn = NULL;
        /** @var \PDO|null */
        private $connection = NULL;
        /** @var null|Database */
        private static $database = NULL;

        /**
         * Private construct that can only be accessed from within this class
         */
        private function __construct()
        {
            $this->createConnection();
        }

        /**
         * A  private method handling setting up params and creating a connection
         */
        private function createConnection(): void
        {
            $this->dsn = "mysql:host=$this->host;dbname=$this->db;port=$this->port";
            $this->opt =
            [
                \PDO::ATTR_ERRMODE              => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_DEFAULT_FETCH_MODE   => \PDO::FETCH_ASSOC,
                \PDO::ATTR_EMULATE_PREPARES     => false,
            ];
            $this->connection = new \PDO( $this->dsn, $this->user, $this->pass, $this->opt );
        }

        /**
         * A static method that will create an object instance once
         * and after that it will reuse the same instance for all other requests
         *
         * @return Database
         */
        static function getInstance(): Database
        {
            if( NULL == self::$database )
            {
                self::$database = new Database();
            }

            return self::$database;
        }

        /**
         * A little getter function to access the connection object
         *
         * @return \PDO
         */
        public function getConnection(): \PDO
        {
            return $this->connection;
        }
    }
}
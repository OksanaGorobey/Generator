<?php declare(strict_types=1);
/**
 * @package     model
 * @version     1.5
 */
namespace App\Model
{
    /**
     * Class BaseModel
     */
    class BaseModel
    {
        protected $db;

        ///////////////////////////////////////////////////////////////////////

        public function __construct()
        {

            /* Get an object instance of the database */
            $database_object = \App\lib\Database::getInstance();
            /* Get a connection from the database object */
            $this->db = $database_object->getConnection();
        }

        ///////////////////////////////////////////////////////////////////////
    }

}
<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 26/05/16
 * Time: 16:16
 */

namespace Ozyris\Model;

use Exception;

abstract class AbstractModel
{

    const DBNAME = 'test';
    const HOST = 'localhost';
    const USER = 'david';
    const PASSWORD = '0000';

    public $bdd;

    /**
     * ConnectionPDO constructor.
     * @param string $dbname
     * @param string $host
     * @param string $user
     * @param string $password
     * @throws Exception
     */
    public function __construct($dbname = '', $host = '' , $user = '', $password = '')
    {
        // Connexion à une base ODBC
        if (empty($user) || !is_string($user)) {
            $dbname = self::DBNAME;
        }

        if (empty($password) || !is_string($password)) {
            $host = self::HOST;
        }

        if (empty($user) || !is_string($user)) {
            $user = self::USER;
        }

        if (empty($password) || !is_string($password)) {
            $password = self::PASSWORD;
        }

        $dsn = 'mysql:dbname=' . $dbname . ';host=' . $host;

        $this->bdd = new \PDO($dsn, $user, $password);

        if (!$this->bdd) {
            throw new Exception('Connexion à la base de données impossible.');
        }
    }
}

<?php

//On importe PDO
use PDO;

class Db extends PDO
{
    // Instance unique de la classe 
    private static $instance;

    //Information de connexion a la BDD
    private const DBHOST = 'localhost';
    private const DBUSER = 'root';
    private const DBPASS = '';
    private const DBNAME = 'autocompletion';


    private function __construct()
    {
        // DSN de connexion
        $dsn = 'mysql:dbname=' . self::DBNAME . ';host=' . self::DBHOST.';charset=utf8';

        //On appelle le constructeur de la classe PDO
        try {
            parent::__construct($dsn, self::DBUSER, self::DBPASS,);

            $this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {

            die($e->getMessage());
        }
    }


    public static function getInstance():self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}

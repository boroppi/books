<?php
class Database
{
    //connection variables
    private static $dbName = 'books' ;
    private static $dbHost = 'localhost' ;
    private static $dbUsername = 'root';
    private static $dbUserPassword = '';

    private static $cont  = null; // will need this while validating if we are already connected or not.
     
    public function __construct() {
        die('Init function is not allowed');
    }
     
    public static function connect() //connect function returns the connection.
    {
       // One connection through whole application
       if ( null == self::$cont )
       {     
        try
        {
          self::$cont =  new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, 
          self::$dbUsername, self::$dbUserPassword); 
        }
        catch(PDOException $e)
        {
          die($e->getMessage()); 
        }
       }
       return self::$cont;
    }
     
    public static function disconnect() // disconnect function
    {
        self::$cont = null; // sets connection state to null
    }
}
?>
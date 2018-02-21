<?php
namespace App;
use MongoDB;


// require_once 'vendor/autoload.php';

class DBConnection
{
	 const HOST = 'localhost';
	 const PORT = 27017;
	 const DBNAME = 'MongoLaravel';
	 private static $instance;
	 public $connection;
	 public $database;


    private function __construct()
	 {
	 	$connectionString = sprintf('mongodb://%s:%d',
		 DBConnection::HOST,
		 DBConnection::PORT
		);
	 try 
	 {
		 $this->connection = new MongoDB\Client($connectionString);
		 $this->database = $this->connection->selectDatabase(DBConnection::DBNAME);
	 } 
	 catch (MongoConnectionException $e)
	 {
	 	throw $e;
	 }
	}

	static public function instantiate()
	 {

	 if (!isset(self::$instance)) 
	 	{
		 $class = __CLASS__;
		 self::$instance = new $class;
	 	}
	 return self::$instance;
	 
	 }


	 public function getCollection($name)
	 {
	 	return $this->database->selectCollection($name);
	 }
 }
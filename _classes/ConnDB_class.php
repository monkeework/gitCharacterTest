<?php #ConnDB_classC4.php

#Class_Name Curly brackets
/**
 * MySQLi db connect
 * Only one connection allowed at a time
 */
class ConnDB{ #setup is more like CSS
	private $_connection;
	private static $_instance;


 /**
	* Get instnace of the Database Class
	* @return Databse
	*/
	public static function getInstance(){
		if (!self::$_instance) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}


	/**
	 * Constructor
	 */
	public function __construct(){
		$this->_connection = new mysqli(
			# Order of Credentials
			'not-my-host-name',     #host
			'not-my-user-name',			     #user
			'not-my-password',			 		 #pass
			'not-my-database-name' #dbName
		);

		if(mysqli_connect_error()){
			trigger_error('Failed to connect to MySQL: ' . mysqli_connect_error(), E_USER_ERROR);

		}
	}


	/**
	 * Empty clone magic method to prevent
	 * duplication of database connection
	 */
	private function __clone(){

	}

	/**
	 * Get the mysqli connection
	 */
	public function getConnection() {
		return $this->_connection;
	}

}

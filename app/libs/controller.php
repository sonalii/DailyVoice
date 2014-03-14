<?php

/**
 * base controller
 */
class Controller
{

	public $db = null;

    function __construct()
    {
        $this->openDatabaseConnection();
    }

    private function openDatabaseConnection()
    {
        $options = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING);
        $this->db = new PDO(DB_TYPE . ':host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME, DB_USER, DB_PASS, $options);
		//$this->db = $db = new PDO('mysql:host=localhost;dbname=daily_voice', 'DV_USER', 'password');
    }

    public function loadModel($model_name)
    {
        require 'app/models/' . strtolower($model_name) . '.php';

		// return new model (and pass the database connection to the model)
        return new $model_name($this->db);
    }

	public function getUserIP()
	{
		 $ipaddress = '';
		 if (isset($_SERVER['HTTP_CLIENT_IP']))
			 $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
		 else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
			 $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
		 else if(isset($_SERVER['HTTP_X_FORWARDED']))
			 $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
		 else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
			 $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
		 else if(isset($_SERVER['HTTP_FORWARDED']))
			 $ipaddress = $_SERVER['HTTP_FORWARDED'];
		 else if(isset($_SERVER['REMOTE_ADDR']))
			 $ipaddress = $_SERVER['REMOTE_ADDR'];
		 else
			 $ipaddress = 'UNKNOWN';

		 return $ipaddress; 
	}
}

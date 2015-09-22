<?php

namespace model;

//Initialize session
session_set_cookie_params(0);
session_start();
class Login {

	private $listOfUsers;
	private static $loggedIn = 'LoginModel::LoggedIn';

	private $message = 0;

	public function __construct(\model\ListOfUsers $listOfUsers) {
		if(!isset($_SESSION[self::$loggedIn]))
            $_SESSION[self::$loggedIn] = false;
        $this->listOfUsers = $listOfUsers;

    }
	
    
    public function validateLogin($username, $password)
    {

   		if (empty($username)) {
   			$this->message = 3;
   			return false;
   		}

        else if(empty($password)) {
            $this->message = 4;
        	return false;
        }

        else{
        	
        		foreach($this->listOfUsers->getUserList() as $n => $p) {

  					if($n == $username && $p == $password) {
  	  				// Username and password are correct		
					$this->message = 2;
					$_SESSION[self::$loggedIn] = true;
					return true;
					}
					else{
						$this->message = 5;
					}	
				}
       		}
    }

 
    //User loggedin , set session = true
    
    public function isLoggedIn() {
        if(isset($_SESSION[self::$loggedIn])){
            if($_SESSION[self::$loggedIn]){
                return true;
            }
        }
        else if (isset($_SESSION['EXPIRES'])){
        	session_destroy();
        }
        return false;
    }
    public function logout() {
        if(isset($_SESSION[self::$loggedIn])){
            if($_SESSION[self::$loggedIn]){
                $_SESSION[self::$loggedIn] = false;
                $this->message = 1;
                session_destroy();
            }
        }
        
    }

    public function getMessage(){
		return $this->message;
	}
   
}
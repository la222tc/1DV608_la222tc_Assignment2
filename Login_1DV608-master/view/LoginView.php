<?php

class LoginView {
	private static $login = 'LoginView::Login';
	private static $logout = 'LoginView::Logout';
	private static $name = 'LoginView::UserName';
	private static $password = 'LoginView::Password';
	private static $cookieName = 'LoginView::CookieName';
	private static $cookiePassword = 'LoginView::CookiePassword';
	private static $keep = 'LoginView::KeepMeLoggedIn';
	private static $messageId = 'LoginView::Message';

	private $l;
	private $message = "";
	private $rememberUserName = "";
	
	public function __construct(model\Login $login) {
		$this->l = $login;
	}

	/**
	 * Create HTTP response
	 *
	 * Should be called after a login attempt has been determined
	 *
	 * @return  void BUT writes to standard output and cookies!
	 */
	public function response() {
		
		if ($this->l->isLoggedIn()) {
			$response = $this->generateLogoutButtonHTML($this->message);
		}
		else{
		$response = $this->generateLoginFormHTML($this->message);
		}
		return $response;
	}

	/**
	* Generate HTML code on the output buffer for the logout button
	* @param $message, String output message
	* @return  void, BUT writes to standard output!
	*/
	private function generateLogoutButtonHTML($message) {
		return '
			<form  method="post" >
				<p id="' . self::$messageId . '">' . $message .'</p>
				<input type="submit" name="' . self::$logout . '" value="logout"/>
			</form>
		';
	}
	
	/**
	* Generate HTML code on the output buffer for the logout button
	* @param $message, String output message
	* @return  void, BUT writes to standard output!
	*/
	private function generateLoginFormHTML($message) {
		return '
			<form method="post" > 
				<fieldset>
					<legend>Login - enter Username and password</legend>
					<p id="' . self::$messageId . '">' . $message . '</p>
					
					<label for="' . self::$name . '">Username :</label>
					<input type="text" id="' . self::$name . '" name="' . self::$name . '" value="' . $this->rememberUserName . '" />

					<label for="' . self::$password . '">Password :</label>
					<input type="password" id="' . self::$password . '" name="' . self::$password . '" />

					<label for="' . self::$keep . '">Keep me logged in  :</label>
					<input type="checkbox" id="' . self::$keep . '" name="' . self::$keep . '" />
					
					<input type="submit" name="' . self::$login . '" value="login" />
				</fieldset>
			</form>
		';
	}
	

	public function userWantsToLogin(){
		//Find out if user clicked the login-button
		if (isset($_POST[self::$login])){
			$this->rememberUserName = $_POST[self::$name];
			return true;
		}
		//If login button is not clicked return false.
		return false;
	}


	public function userWantsToLogout(){
		
		if (isset($_POST[self::$logout])){
			return true;
		}
		
		return false;
	}

	/**
	* @return String
	*/
	public function getUsername() {
		return $_POST[self::$name];
	}
	/**
	* @return String
	*/
	public function getPassword() {
		return $_POST[self::$password];
	}

	public function setMessage($message){
		switch ($message) {
			case 0:
				$this->message = "";
				break;
			
			case 1:
				$this->message = 'Bye bye!';
				break;

			case 2:
				$this->message = "Welcome";
				break;
			
			case 3:
				$this->message = "Username is missing";
				break;
			
			case 4:
				$this->message = "Password is missing";
				break;

			case 5:
				$this->message = "Username or password is wrong";
				break;
			
		}
	}
	
}
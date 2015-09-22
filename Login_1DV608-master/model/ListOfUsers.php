<?php

namespace model;

class ListOfUsers {
   

	private $users = array(
		'username1' => 'password1',
		'username2' => 'password2',
		'username3' => 'password3',
	);

	public function getUserList(){
		return $this->users;
	}
}
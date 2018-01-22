<?php
namespace pw\Models;

class User{
	protected $login;
	protected $password;
	protected $club;

	function __construct($_login, $_password, $_club){
		$this->login = $_login;
		$this->password = $_password;
		$this->club = $_club;
	}

	function getLogin(){
		return $this->login;
	}

	function getPassword(){
		return $this->password;
	}

	function getClub(){
		return $this->club;
	}
}
?>
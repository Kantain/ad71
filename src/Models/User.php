<?php
namespace pw\Models;

class User{
	protected $login;
	protected $password;
	protected $club;

    private $clubToLetter = {'A' => 'SAINT VALLIER', 'B' => 'MONTCHANIN', 'C' => 'SANVIGNES LES MINES', 'D' => 'D', 'E' => 'E', 'F' => 'CLUNY'};
    private $letterToClub = {'SAINT VALLIER'=> 'A', 'MONTCHANIN' => 'B', 'SANVIGNES LES MINES' => 'C', 'D' => 'D', 'E' => 'E', 'CLUNY' => 'F'};

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
		if (!is_null($clubToLetter[$this->club])) {
			return $clubToLetter[$this->club];
		}
		if (!is_null($letterToClub[$this->club])) {
			return $letterToClub[$this->club];
		}
	}

	function setLogin($_login){
		$this->login = $_login;
	}

	function setPassword($_password){
		$this->password = $_password;
	}

	function setClub($_club){
		$this->club = $_club;
	}
}
?>
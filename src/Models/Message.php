<?php
namespace pw\Models;

class Message{
	protected $id;
	protected $president;
	protected $contenu;
	protected $date;
	protected $lu;

	function __construct($_president, $_contenu){
		$this->president = $_president;
		$this->contenu = $_contenu;
		$this->date = date("Y-m-d H:i:s");
		$this->lu = false;
	}

	function getPresident(){
		return $this->login;
	}

	function getContenu(){
		return $this->password;
	}

	function getDate(){
		return $this->club;
	}
}
?>
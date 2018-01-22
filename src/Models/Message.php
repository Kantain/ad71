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
		return $this->president;
	}

	function getContenu(){
		return $this->contenu;
	}

	function getDate(){
		return $this->date;
	}
}
?>
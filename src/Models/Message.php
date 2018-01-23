<?php
namespace pw\Models;

class Message{
	protected $id;
	protected $president;
	protected $contenu;
	protected $date;
	protected $lu;

	public function __construct($_president, $_contenu){
		$this->president = $_president;
		$this->contenu = $_contenu;
		$this->date = date("Y-m-d H:i:s");
		$this->lu = false;
	}

	public function getId(){
		return $this->id;
	}

	public function getPresident(){
		return $this->president;
	}

	public function getContenu(){
		return $this->contenu;
	}

	public function getDate(){
		return $this->date;
	}
}
?>
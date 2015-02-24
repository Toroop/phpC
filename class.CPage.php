<?php
class CPage{
	 private $type = 'page';
	 private $title;
	 private $space;
	 private $body;
	
	public function setType($var){
		$this->type = $var;
	}
	public function getType(){
		return $this->type;
	}

	public function setTitle($var){
		$this->title = $var;
	}
	
	public function setSpace($var){
		$this->space = $var;
	}
	
	public function setBody($var){
		$this->body = $var;
	}
	
	public function getTitle(){
		return $this->title;
	}
	
	public function getSpace(){
		return $this->space;
	}
	
	public function getBody(){
		return $this->body;
	}
	
	public function updateTitle($var){
		$this->setTitle();
	}
	
	public function updateSpace($var){
		$this->setSpace();
	}
	
	public function updateBody($var){
		$this->setSpace();
	}
}
?>
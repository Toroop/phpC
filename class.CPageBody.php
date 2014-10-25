<?php
require_once('class.CStorage.php');

class CPageBody{
	 private $bodyHead;
	 private  $bodyContent;
	 private $bodyFoter;
	 private $table;
	 private $storage;

public function initStorage($var){
	$this->storage =$var;
}
public function setBodyHead(){
	$storage =  new CStorage();
	$this->initStorage($storage);
	$this->bodyHead =$this->storage->init();
}

public function setBodyFooter(){
	$this->bodyFoter =$this->storage->finish();

}
	
public function addContent($type,$content){
	$this->bodyContent =  $this->bodyContent . " ".$this->storage->addToContent($type,$content);
}
public function getContent(){
	return $this->bodyContent;
}

public function getBodyHead(){
	return $this->bodyHead;
}

public function getBodyFoter(){
	return $this->bodyFoter;
}


}

?>

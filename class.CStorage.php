<?php
class CStorage{
	private $init;
	private $finish;

	public function init(){
		$this->init = array('storage' =>array("value"=>""));
		return   $this->init;
	} 
	public function finish(){
		$arr = array();
		$arr['storage']['representation'] ='storage';
		$this->finish = $arr;
	return $arr;
	}

	public function addToContent($type,$content){
		switch ($type) {
			case 'paragraf':
				$arr= $content;
				break;	
		}
		return $arr;
	}
	function getInitStatus(){
		return $this->init;
	}
	
	function getFinishStatus(){
		return $this->init;
	}
}

?>
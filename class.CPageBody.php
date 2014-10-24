<?php
class CPageBody{
	 private  $paragraf;
	 // private $table;



	public function addParagraf($var){
		$arr =array();
		$endof['representation'] ='storage';
		$arr['storage']['value'] = $var;
		$arr['storage']['representation'] ='storage';
		$this->paragraf = $arr;

	}

	public function getParagraf(){
		return $this->paragraf;
	}

}

?>

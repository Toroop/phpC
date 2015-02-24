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
			case 'table':
			 $arr = "<table>";
			 $arr .="<th>".$content."</th>";
			 $arr .="<th>".$content."</th>";
			 $arr .="<tr> <td>".$content."col1"."</td><td>".$content."col2"."</td></tr>"; 
			 $arr .= "</table>";
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
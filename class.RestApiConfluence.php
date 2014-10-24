<?php
require_once("class.CPage.php");
require_once("class.CPageBody.php");
define("APICUSER", "admin");
define("APICPASS", "admin");
define("APICHOST", "http://127.0.0.1:1990/confluence/rest/api/content");
define("CONTENT_TYPE", "Content-Type: application/json");
define("POST_PAGE","POST_PAGE");
define("GET_PAGE","GET_PAGE");




class RestApiConfluence {

	private $page;
	private $curl;


	public function setPage($type,$pageTitle,$space,$body){
		$Page = new CPage();
		$Page ->setType($type);
		$Page->setTitle($pageTitle);
		$Page->setSpace($space);
		$Page->setBody($body);
		 // print_r($this->ParsheObjPageToArray($Page)); die;
		$thePage =json_encode($this->ParsheObjPageToArray($Page));
	    $this->page =$thePage;
	}
	public function getPage(){
	  return $this->page;
	}
	public  function setCurl($var){
		$this->curl = $var;
	}
	public function getCurl(){
		return $this->curl;
	}

	//pharser of object to array;
	public function ParsheObjPageToArray($Page){
		$arrOfObj = array();
		if ($Page instanceof Cpage){
			$arrOfObj['type'] =$Page->getType();
			$arrOfObj['title'] =$Page->getTitle();
			$arrOfObj['space']['key'] =$Page->getSpace();
			$arrOfObj['body']=$Page->getBody()->getParagraf();
		return $arrOfObj;

		}else{
			$error = 'The page is not a valid object!!';
    		throw new Exception($error);
		}

	}
	// send full content  to  Confluance
	public function  sendContent($var){
		$ch = $this->setUpAction("POST_PAGE");
		$resp = $this->startAction($this->curl);
		$this->stopAction($this->curl);
   		//debug
		 // print_r("$output". $resp);
		}




		public function  getPageIdByTitleAndSpace($title,$spacekey){
			$ch = $this->setUpAction('GET_PAGE',$title,$spacekey);
			$resp = $this->startAction($this->curl);
			$this->stopAction($this->curl);
			return json_decode($resp);
		}






//INIT CURL DEPEND OF ACTION
		public function setUpAction($action,$title = NULL , $spacekey = NULL){
			switch ($action) {
				case 'POST_PAGE':
						$ch = curl_init(APICHOST);
						curl_setopt($ch, CURLOPT_USERPWD, APICUSER.":".APICPASS);
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
						curl_setopt($ch, CURLOPT_POST, 1);
						curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
						curl_setopt($ch, CURLOPT_POSTFIELDS,
						            $this->getPage());
						return $this->setCurl($ch);
				break;

				case 'GET_PAGE':
						$ch = curl_init(APICHOST.'?title='.$title.'&spaceKey='.$spacekey);
						curl_setopt($ch, CURLOPT_USERPWD, APICUSER.":".APICPASS);
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
						curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
						return $this->setCurl($ch);
				break;
				case 'UPDATE_PAGE':


				break;

				case 'DELETE_PAGE':

				break;

			}

		}

//start Action
		public function startAction($ch)
		{
			return curl_exec($ch);
		}

//stop action
		public function stopAction($ch){
			curl_close($ch);
		}


}


?>

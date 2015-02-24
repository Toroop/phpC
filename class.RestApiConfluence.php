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
				$head = $Page->getBody()->getBodyHead();
				$footer = $Page->getBody()->getBodyFoter();
				$arrOfObj['body'][key($head)]['value']=$Page->getBody()->getContent();
				$arrOfObj['body'][key($head)]['representation']=$footer[key($footer)]['representation'];
				 // print_r($arrOfObj);
				return $arrOfObj;
			}else{
				$error = 'The page is not a valid object!!';
				throw new Exception($error);
			}

		}

		// send full content  to  Confluance
		public function  sendContent($var,$action,$contentId=NULL){
			$ch = $this->setUpAction($action,$contentId);
			$resp = $this->startAction($this->curl);
			$this->stopAction($this->curl);
				//debug
			  // print_r("output". $resp);
		}

		public function  getPageIdByTitleAndSpace($title,$spacekey){
			$ch = $this->setUpAction('GET_PAGE',$title,$spacekey);
			$resp = $this->startAction($this->curl);
			$this->stopAction($this->curl);
			return json_decode($resp);
		}

		//INIT CURL DEPEND OF ACTION
		public function setUpAction($action,$title = NULL , $spacekey = NULL, $contentId =NULL){
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
						if ($contentId != NULL){ 
							$ch = curl_init(APICHOST.'/$contentId');
							curl_setopt($ch, CURLOPT_USERPWD, APICUSER.":".APICPASS);
							curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
							curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
							curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
							curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
							curl_setopt($ch, CURLOPT_POSTFIELDS,$this->getPage());
							return $this->setCurl($ch);
						}
				break;

				case 'DELETE_PAGE':
					//NEED TO BE IMPLEMENTED
				break;
			}
		}

		//start Action
		public function startAction($ch)
		{
			$output =curl_exec($ch);
			$result = json_decode($output,true);
			if (!empty($result) && array_key_exists("statusCode",$result) && $result ['statusCode'] == 400){
				throw new Exception(PHP_EOL.$result["message"].PHP_EOL. "!!!!!!!!!!!Process will be stop!!!!!!!!!!!!!!!!!!!!!!!!");
				exit;
			}
			return $output;
		}
		
		//stop action
		public function stopAction($ch){
			curl_close($ch);
		}
}
?>

<?php

require_once "class.RestApiConfluence.php";
require_once("class.CPageBody.php");


// define("APICUSER", "admin");
// define("APICPASS", "admin");
// define("APICHOST", " http://luci-OptiPlex-790:1990/confluence/rest/api/content");
// define("CONTENT_TYPE", "Content-Type: application/json");

$api =  new  RestApiConfluence();

	$testpage = array("type" => "page",
				  "title" => "TestCurl",
				  "space" => array('key' => 'TL'),
				  "body" =>array('storage'=> array("value"=> "<p> This is my new poge from the api created by luci criste</p>",
				  									"representation" => "storage",
				  								),
							  	),
	);

  // print_r($testpage);
 // print_r(PHP_EOL);

 $type = "page";
 $searchTitle = "TestCurl";
 $pageTitle = "TestCurl by luci 24.10.2014".time()."  _____ luci ssssS";
$spaceKey= "TL"; // this is the spacekey
 $body = new CPageBody();
 $body->addParagraf('<p> This is my new poge from the api created by luci criste at 21.01.2010'. time().'</p>');
 $api->setPage($type,$pageTitle,$spaceKey,$body);
     // print_r($api->getPage());
//    // die("stop");
     $api->sendContent($api->getPage());

print_r($api); die;
/*
 this are action for get id of page
*/
// $response = new stdClass();
//     $response = $api->getPageIdByTitleAndSpace($searchTitle,$spaceKey);
// $pageId = $response->results[0]->id;
// print_r($pageId);;


?>
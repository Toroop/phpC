<?php

require_once "class.RestApiConfluence.php";
require_once("class.CPageBody.php");

$api =  new  RestApiConfluence();
 $type = "page";
 $searchTitle = "Table";
 $pageTitle = "Testjadshdkjashdkjahkds";
 $spaceKey= "REP"; // this is the spacekey
 $body = new CPageBody();

 $body->setBodyHead();
 $body->setBodyFooter();
  $body->addContent("paragraf","<h1> Test  header </h1>");
 $body->addContent("paragraf","<p> Test paragraff </p>");
 $body->addContent("paragraf","<p> Test paragraff </p>");
 $body->addContent("paragraf","<h1> Test  header 2 </h1>");
 $body->addContent("paragraf","<p> Test paragraff </p>");
 $body->addContent("paragraf","<p> Test paragraff </p>");
 $body->addContent("table","<p> Test paragraff </p>");
  $api->setPage($type,$pageTitle,$spaceKey,$body);

   //  send content to confluence
      $api->sendContent($api->getPage(),"POST_PAGE");

/*
 this are action for get id of page
*/
//  $response = new stdClass();
//  $response = $api->getPageIdByTitleAndSpace($searchTitle,$spaceKey);
//  $pageId = $response->results[0]->id;
// print_r( $response); die;
// if (isset($pageId)){
// 	$api->setPage($type,$editpageTitle,$spaceKey,$body);
//  	$api->sendContent($api->getPage(),"GET_PAGE",$pageId);
// }


?>
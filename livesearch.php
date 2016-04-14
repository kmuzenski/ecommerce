<?php
$xmlDoc= new DOMDocument();
$xmlDoc->load("links.xml");

$x=$xmlDoc->getElementsByTagName('link');

//get q param from URL

$q = $_GET["q"];


//lookup links from xml file

if (strlen($q) > 0){
	$hint="";


	for($i=0; $i<($x->length); $i++) {

	$y=$x->item($i)->getElementsByTagName('title');


	$z = $x->item($i)->getElementsByTagName('url');

	if ($y->item(0)->nodeType==1) {

	//find a link matching search

	if (stristr($y->item(0)->childNodes->item(0)->nodeValue, $q)) {

		if ($hint =="") {
		$hint = "<a href='" . 
		$z->item(0)->childNodes->item(0)->nodeValue . "' target='_blank'>" . $y->item(0)->childNodes->item(0)->nodeValue . "</a>";
		} else {
			$hint = $hint . "<br><a href='" . $z->item(0)->childNodes->item(0)->nodeValue . "' target='_blank'>" . $y->item(0)->childNodes->item(0)->nodeValue . "</a>";

		}
	}
	}

	}
}

//set output to no suggestion or to correct value

if ($hint =="") {
	$response ="no suggestion";

} else {
	$response = $hint;
}

echo $response;

?>
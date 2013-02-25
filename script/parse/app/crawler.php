<?php
error_reporting(E_ALL);
include_once('../simple_html_dom.php');

//$html = file_get_html('google.htm');
$html = file_get_html('http://www.yelp.com/biz/providence-los-angeles-2?start=280');
//$html = file_get_html('Product.ibatis.xml');

$xml = new DOMDocument();
$xml->formatOutput = true;


$xml_doc = $xml->createElement("doc");

$counter = 0;
 foreach($html->find('.media-block-no-margin') as $element){
	    $counter++; 
	    if($counter>1)break;
        
		$doc_attr = $xml->createAttribute("id");
		$doc_attr->value = $counter;
		$xml_doc->appendChild( $doc_attr );

		$xml_star = $xml->createElement("star");
		$xml_star->nodeValue = $element->children(1)->children(0)->children(0)->children(0)->children(1)->content; // media-story->review-meta->rating-container->rating
		$xml_doc->appendChild( $xml_star );

		$xml_url = $xml->createElement("url");
		$xml_doc->appendChild( $xml_url );

		$xml_date = $xml->createElement("date");
		$xml_date->nodeValue = $element->children(1)->children(0)->children(1)->content; // media-story->review-meta
		$xml_doc->appendChild( $xml_date );

		$xml_review = $xml->createElement("review");
		$xml_review->nodeValue = $element->children(1)->children(1)->plaintext;// media-story->review-meta		
		$xml_doc->appendChild( $xml_review );

		$xml_polarity = $xml->createElement("polarity");
		$xml_doc->appendChild( $xml_polarity );

		$xml_confidence = $xml->createElement("confidence");
		$xml_doc->appendChild( $xml_confidence );

		$xml->appendChild( $xml_doc );
 }

$xml->save("test.xml");

?>

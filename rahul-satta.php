<?php
# wikipedia.php
error_reporting(0);

function get_string_between($string, $start, $end){
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
}



$html = file_get_contents('https://www.black-satta.com/sattaking-gali-desawar-satta-result-guessing.php');


$dom = new DOMDocument();


$dom->loadHTML($html);

$xpath = new DOMXPath($dom);
$div = $xpath->query('//table[@id="customers"]');

$div = $div->item(0);
$html = $dom->saveXML($div);
// echo $html;
$doc = new DOMDocument();
$doc->loadHTML($html);
$liList = $doc->getElementsByTagName('td');

$liValues = array();
foreach ($liList as $li) {
   
	$str = $li->nodeValue;
	
	$name = explode("(", $str)[0];
	$time = get_string_between($str, "(", ")");
	$value = get_string_between($str, "{", "}");
	$betValue = get_string_between($str, "[", "]");
	
	$liValues[] = array( 
        "name" => $name,
		"time" => $time,
		"value" => $value,
		"betValue" => $betValue,		
    );
	
}

echo json_encode( $liValues );

?>
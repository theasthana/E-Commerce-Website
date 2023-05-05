<?php
function pr($arr){
	echo '<pre>';
	print_r($arr);
}

function prx($arr){
	echo '<pre>';
	print_r($arr);
	die();
}

function get_safe_value($con,$str){
	if($str!=''){
		$str=trim($str);
		return mysqli_real_escape_string($con,$str);
	}
}

function trimWords($text, $numWords) {
    $words = explode(' ', $text);
    if (count($words) > $numWords) {
        $words = array_slice($words, 0, $numWords);
        $text = implode(' ', $words) . '...';
    }
    return $text;
}

function showError(){
	ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

}
showError();

?>
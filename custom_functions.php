<?php

function simplequeryrun($query_simplequeryrun,$conn) {
	$result_simplequeryrun = mysqli_query($conn, $query_simplequeryrun);
    $row_simplequeryrun = mysqli_fetch_array($result_simplequeryrun, MYSQL_ASSOC);
    return $row_simplequeryrun;
}

function queryrunloop($query_queryrunloop,$conn) {
	$result_queryrunloop = mysqli_query($conn, $query_queryrunloop);
    return $result_queryrunloop;
}

function adminloggedin(){
	if(isset($_SESSION['adminid']))
	    return true;
	else
		return false;
}

function userloggedin(){
	if(isset($_SESSION['userid']))
	    return true;
	else
		return false;
}



function slugify($text)
{
  $text = preg_replace('~[^\pL\d]+~u', '-', $text);
  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
  $text = preg_replace('~[^-\w]+~', '', $text);
  $text = trim($text, '-');
  $text = preg_replace('~-+~', '-', $text);
  $text = strtolower($text);
  return $text;
}

function forminputsecure($input_forminputsecure){
	return strip_tags(trim(htmlspecialchars($input_forminputsecure)));
}

function urlencodefunc($tag_urlencodefunc){
	return urlencode(base64_encode($tag_urlencodefunc));
}

function urlencodefuncforerrors($tag_urlencodefuncforerrors){
	return base64_encode(urlencode($tag_urlencodefuncforerrors));
}

function urldecodefunc($tag_urldecodefunc){
	return base64_decode(urldecode($tag_urldecodefunc));
}
?>
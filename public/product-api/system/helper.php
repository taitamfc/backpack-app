<?php
function pr($arr){
	echo '<pre>';
	print_r($arr);
	echo '</pre>';
}
function sanitize_title($text, string $divider = '-'){
	// replace non letter or digits by divider
	$text = preg_replace('~[^\pL\d]+~u', $divider, $text);

	// transliterate
	$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

	// remove unwanted characters
	$text = preg_replace('~[^-\w]+~', '', $text);

	// trim
	$text = trim($text, $divider);

	// remove duplicate divider
	$text = preg_replace('~-+~', $divider, $text);

	// lowercase
	$text = strtolower($text);

	if (empty($text)) {
	return 'n-a';
	}

	return $text;
}

function write_to_log($type,$msg){
	$root_domain = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';
	$data_string = [
		'type' => $type,
		'msg' => $msg,
	];
	$url = $root_domain.'api/logs';
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.95 Safari/537.36');
	curl_setopt($ch, CURLOPT_TIMEOUT, 30);
	if( $data_string != "" ){
		$data_string = json_encode($data_string);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			'Content-Length: ' . strlen($data_string))
		);
	}
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, 0); 
	curl_setopt($ch,CURLOPT_CAINFO, NULL); 
	curl_setopt($ch,CURLOPT_CAPATH, NULL); 
	$return = curl_exec($ch);
	curl_close($ch);
}
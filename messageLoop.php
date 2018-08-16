<?php 

	$options = array(
		CURLOPT_URL => "https://api.whispir.com/messages?apikey=".$api,
		CURLOPT_RETURNTRANSFER => true,   // return web page
		CURLOPT_HTTPHEADER => array(
			"accept: application/vnd.whispir.message-v1+json",
			"authorization: Basic bHVrZS53ZWxsczpoM3JkSDB1c2U=",
			"content-type: application/vnd.whispir.message-v1+json"
		), 
		CURLOPT_FOLLOWLOCATION => true,   // follow redirects
		CURLOPT_MAXREDIRS      => 10,     // stop after 10 redirects
		CURLOPT_ENCODING       => "",     // handle compressed
		CURLOPT_AUTOREFERER    => true,   // set referrer on redirect
		CURLOPT_CONNECTTIMEOUT => 120,    // time-out on connect
		CURLOPT_TIMEOUT        => 120,    // time-out on response
	); 

	$curl = curl_init();
	curl_setopt_array($curl, $options);

	$content  = curl_exec($curl);
	$errors = curl_error($curl);
	$response = curl_getinfo($curl, CURLINFO_HTTP_CODE);

	curl_close($curl);

	/*var_dump($errors);*/

	$content = json_decode($content, true);
			
	$messageloop = $content['messages'];
	$messageArray = array();

	foreach((array)$messageloop as $contents) {
		$responseCount = $contents['responseCount'];

		if($responseCount > 0) {
			$contents = substr($contents['link'][0]['uri'], 33, -32);
			$messageArray[] = $contents;
		}
	}

	$resArr = array();
	$resArr = json_decode($response);
	/*echo "<pre>"; print_r($resArr); echo "</pre>";*/

?>
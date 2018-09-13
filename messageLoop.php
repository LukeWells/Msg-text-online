<?php 
	
	$date = date('d/m/Y');
	$time = date('H:i');

	$fromDate = "&criteriaFromDate=01/01/2018&criteriaFromTime=00:00";
	$toDate = "&criteriaToDate=".$date."&criteriaToTime=".$time;

	$options = array(
		CURLOPT_URL => "https://api.whispir.com/messages?apikey=".$api.$fromDate.$toDate,
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

	$content = json_decode($content, true);

	$messageloop = $content['messages'];
	$messageArray = array();
	$endPointArray = array();
 	$responsesId = array(); //storing messages with responses here in addition, in order for this to be called when needed.
	
	if(isset($messageloop)) {	
		foreach((array)$messageloop as $contents) {
			//$responseCount = $contents['responseCount'];
		
			$uri = $contents['link'][0]['uri'];
			$contents = substr($uri, 33, -142);
		
			$endPointArray = $uri;
			$messageArray[] = $contents;
		
			/* no longer required
			if($responseCount > 0) {
				$responsesId[] = $contents;
			} */
		} 
	} else {
		echo "No messages found";
	}

	$resArr = array();
	$resArr = json_decode($response);
	//echo "<pre>"; print_r($resArr); echo "</pre>";

?>
<?php 
	/* loop */
	$messageId = "";
	$whispirMessage = array('messageIDplaceholder');

	foreach ($whispirMessage as list($messageId)) {

		curl_setopt($curl,CURLOPT_URL,"https://api.whispir.com/messages/".$messageId."/messageresponses?view=detailed&filter=default&apikey=".$api);

		curl_setopt_array($curl, array(
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => "",
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 30,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_HTTPHEADER => array(
					"accept: application/vnd.whispir.message-v1+json",
					"authorization: Basic bHVrZS53ZWxsczpoM3JkSDB1c2U=",
					"content-type: application/vnd.whispir.message-v1+json"
				),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);
		return $response;
		curl_close($curl);
	}
?>
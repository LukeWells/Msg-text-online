<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/bootstrap.css">
    <title>Lang's online texting</title>
</head>
<body>
	<?php

		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);
	
		$to = $_POST['phoneNumber'];
		$subject = $_POST['messageText'];
		$message = " - Lang's Building Supplies";

		session_start();

		$apikey = $_SESSION['apikey'];

		$curl = curl_init();

		curl_setopt($curl,CURLOPT_POSTFIELDS,"{\"to\":\"".$to."\",\"subject\":\"".$subject."\",\"body\":\"".$message."\"}");
		curl_setopt($curl,CURLOPT_URL, "https://api.whispir.com/messages?apikey=".$apikey);

		curl_setopt_array($curl, array(
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_HTTPHEADER => array(
				"accept: application/vnd.whispir.message-v1+json",
				"authorization: Basic bHVrZS53ZWxsczpoM3JkSDB1c2U=",
				"content-type: application/vnd.whispir.message-v1+json"
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			echo "cURL Error #:" . $err;
		} else {
			echo $response;
		}
		
	?>
	<div class="container">
		<h3>Mobile phone messaging service</h3>
		<p>Message sent.</p>
		<a href="index.php" class="btn btn-primary">Send another message</a>
	</div>
</body>
<script>
</script>
</html>
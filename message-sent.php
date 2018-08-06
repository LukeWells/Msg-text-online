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

		$client = new http\Client;
		$request = new http\Client\Request;

		$body = new http\Message\Body;
		$to = $_POST['phoneNumber'];
		$subject = $_POST['subject'];
		$message = $_POST['messageText'];

		$body->append('{"to":"","subject":"","body":""}');

		$body->to = $to;
		$body->subject = $subject;
		$body->body = $messageText;

		$request->setRequestUrl('https://api.whispir.com/messages');
		$request->setRequestMethod('POST');
		$request->setBody($body);

		$request->setQuery(new http\QueryString(array('apikey' => 'vaduqqatayakcjh6t9v5mnhf')));

		$request->setHeaders(array(
		  'content-type' => 'application/vnd.whispir.message-v1+json',
		  'accept' => 'application/vnd.whispir.message-v1+json',
		  'authorization' => 'Basic bHVrZS53ZWxsczpoM3JkSDB1c2U='
		));

		$client->enqueue($request)->send();
		$response = $client->getResponse();

		echo $response->getBody();
	?>
	<div class="container">
		<h3>Mobile phone messaging service</h3>
		<p>Message sent.</p>
	</div>
</body>
<script>
</script>
</html>
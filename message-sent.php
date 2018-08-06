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

		$request = new HttpRequest();
		$request->setUrl('https://api.whispir.com/messages');
		$request->setMethod(HTTP_METH_POST);

		$request->setQueryData(array(
		  'apikey' => 'vaduqqatayakcjh6t9v5mnhf'
		));

		$request->setHeaders(array(
		  'content-type' => 'application/vnd.whispir.message-v1+json',
		  'accept' => 'application/vnd.whispir.message-v1+json',
		  'authorization' => 'Basic bHVrZS53ZWxsczpoM3JkSDB1c2U='
		));

		$to = $_POST['phoneNumber'];
		$subject = $_POST['subject'];
		$message = $_POST['messageText'];

		$request->setBody('{"to":"","subject":"","body":""}');

		$request->to = $to;
		$request->subject = $subject;
		$request->body = $messageText;

		try {
		  $response = $request->send();

		  echo $response->getBody();
		} catch (HttpException $ex) {
		  echo $ex;
		}
	?>
	<div class="container">
		<h3>Mobile phone messaging service</h3>
		<p>Message sent.</p>
	</div>
</body>
<script>
</script>
</html>
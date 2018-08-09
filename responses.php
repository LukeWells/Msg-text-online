<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.css">
    <title>Lang's online texting</title>
</head>
<body>
	<?php 
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);
	
		$messageId = null;

		$curl = curl_init();
		curl_setopt($curl,CURLOPT_GET, "{\"to\":\"\",\"subject\":\"\",\"body\":\"\"}");
		curl_setopt_array($curl, array(/*
			CURLOPT_URL => "https://api.whispir.com/messages/messageresponses?view=detailed&filter=default&apikey=vaduqqatayakcjh6t9v5mnhf",*/
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_HTTPGET => "TRUE",
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
		<h4>All responses:</h4>
		<Script>
			var response = "<?php echo $response ?>";

		</script>
		<a href="index.php" class="btn btn-secondary">Back</a>
	</div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
</body>
</html>
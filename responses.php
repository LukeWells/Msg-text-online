<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.css">
    <title>Lang's online texting</title>
</head>
<body>
	<div class="container">
		<h3>Mobile phone messaging service</h3>
		<h4>All responses:</h4>
		<?php 
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);
		
		include ('api.php'); 
		/*
		include("messageLoop.php");
		*/

		$response = get_web_page("https://api.whispir.com/messages?apikey=".$api);
		$resArr = array();
		$resArr = json_decode($response);
		echo "<pre>"; print_r($resArr); echo "</pre>";

		function get_web_page($url) {
			$options = array(
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

			$ch = curl_init($url);
			curl_setopt_array($ch, $options);

			$content  = curl_exec($ch);
			$errors = curl_error($ch);
			$response = curl_getinfo($ch, CURLINFO_HTTP_CODE);

			curl_close($ch);

			var_dump($errors);

			return $content;
		}
		?>
		<a href="index.php" class="btn btn-secondary">Back</a>
	</div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
</body>
</html>
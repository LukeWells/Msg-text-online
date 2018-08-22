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
		
		include ('api.php'); /* calls api key */
		include ('messageLoop.php');
		
		$curl = curl_init();
		$responseArray = array();

		$cache = __DIR__."/json.cache";
		$force_refresh = false;
		$refresh = 60*60;

		if ($force_refresh || ((time() - filemtime($cache)) > ($refresh) || 0 == filesize($cache))) {
			curl_setopt_array($curl, array(
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_ENCODING => "",
					CURLOPT_MAXREDIRS => 5,
					CURLOPT_TIMEOUT => 10,
					CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					CURLOPT_HTTPHEADER => array(
						"accept: application/vnd.whispir.messageresponse-v1+json",
						"authorization: Basic bHVrZS53ZWxsczpoM3JkSDB1c2U=",
					),
				));

			foreach((array)$responsesId as $val) {
				curl_setopt($curl,CURLOPT_URL,"https://api.whispir.com/messages/".$val."/messageresponses?view=detailed&filter=default&apikey=".$api);
				$content = curl_exec($curl);
				$content = json_decode($content,true);
				$responseArray[] = $content;
				$err = curl_error($curl);	
				sleep(1);
			}		

			curl_close($curl); 
			file_put_contents($cache, serialize($responseArray));

		} else {
			$responseArray = unserialize(file_get_contents($cache));
		}
		
		foreach($responseArray as $key=>$msg) {	
			echo "<b>From:</b> ".$msg['messageresponses'][0]['from']['mobile'];
			echo "<br/>";
			echo $msg['messageresponses'][0]['responseMessage']['content'];
			echo "<br/><br/>---------------------------<br/>";
		} 
		
		?>
		<a href="index.php" class="btn btn-secondary">Back</a>
	</div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
</body>
</html>
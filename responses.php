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
		<h4>Responses:</h4>
		<?php 
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);
		
		include ('api.php'); /* calls api key */
		include ('messageLoop.php');
		
		function is_not_null($val){
			 return !is_null($val);
		}

		$curl = curl_init();
		$responseArray = array();

		$cache = __DIR__."\json.cache";
		$force_refresh = true;
		$refresh = 60*15;

		if ($force_refresh || ((time() - filemtime($cache)) > ($refresh) || 0 == filesize($cache))) {
			curl_setopt_array($curl, array(
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => "",
				CURLOPT_MAXREDIRS => 5,
				CURLOPT_TIMEOUT => 10,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_HTTPHEADER => array(
					"accept: application/vnd.whispir.messageresponse-v1+json",
					"authorization: Basic bHVrZS53ZWxsczpoM3JkSDB1c2U="
				),
			));

			$responsesId = $_GET['mId'];

			//if() cache message ID values don't already exist.

			if(isset($responsesId)) {
				//foreach((array)$responsesId as $val) {
				curl_setopt($curl,CURLOPT_URL,"https://api.whispir.com/messages/".$responsesId."/messageresponses?view=detailed&filter=default&apikey=".$api);
				$content = curl_exec($curl);
				$content = json_decode($content,true);
				$responseArray[] = $content;
				$err = curl_error($curl);	
				//}
			

				$responseArray = array_filter($responseArray, 'is_not_null'); 
				curl_close($curl); 

				if(0 == filesize($cache)) {
					file_put_contents($cache, serialize($responseArray));
				} else {
					file_put_contents($cache, serialize($responseArray), FILE_APPEND | LOCK_EX);
				}
			} else {
				echo "No responses received from this message";
			}

		} else {
			$responseArray = unserialize(file_get_contents($cache));
		}
		
		foreach($responseArray as $key=>$msg) {	
			$indM = $msg['messageresponses'];

			//response
			echo "<b>From:</b> ".$indM[0]['from']['mobile'];
			echo "<br/>";

			foreach((array)$indM as $ind) {
				if($ind['responseMessage']['content'] === "N/A") {
					echo "No responses received";
				} else {
					echo "<b>";
					echo $ind['responseMessage']['acknowledged'];
					echo ": </b>";
					echo $ind['responseMessage']['content'];
				}
				echo "<br/>";
			}
			echo "<br/>---------------------------<br/>";
		} 
		?>
		<input type="button" VALUE="Back" onClick="history.go(-1);" class="btn btn-secondary">
	</div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
</body>
</html>
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
		<h4>All sent:</h4>
		<?php 
		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);
		
		include ('api.php');
		include ('messageLoop.php');
		
		$curl = curl_init();
		$responseArray = array();

		$cache = __DIR__."\sent.cache";
		$force_refresh = true;
		$refresh = 60*15;
		$tempArray = array();

		if ($force_refresh || ((time() - filemtime($cache)) > ($refresh) || 0 == filesize($cache))) {	
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

			foreach((array)$messageArray as $val) {
				curl_setopt($curl,CURLOPT_URL,$endPointArray);
				curl_setopt_array($curl, $options);
				$content  = curl_exec($curl);
				$errors = curl_error($curl);
				$response = curl_getinfo($curl, CURLINFO_HTTP_CODE);
				$content = json_decode($content, true);
				$tempArray[] = $content;
			}

			curl_close($curl);
/*
			if(0 == filesize($cache)) {
				file_put_contents($cache, serialize($tempArray));
			} else {
				file_put_contents($cache, serialize($tempArray), FILE_APPEND | LOCK_EX);
			}

		} else {
			$tempArray = unserialize(file_get_contents($cache)); */
		}

		foreach((array)$messageloop as $val) {
			$mId = substr($val['link'][0]['uri'], 33, -130); //updated from 148 to 130, don't know why yet.
			//echo "<b>To: </b><br/>";
			/*echo ($val['to']);*/
			echo "<b>Time sent: </b>";
			$epoch = $val['createdTime'];
			$epoch = substr($epoch, 0, -3);
			$date = date('r', $epoch);				
			echo $date;
			echo "<br/><b>Message: </b>";
			echo $val['subject'];
			echo "<br/>";
			echo "<a href='responses.php?mId=".$mId."' class='btn btn-link'>View responses</a>";
			echo "<br/>--------------------------------<br/>";
		}	
		?>
		<a href="index.php" class="btn btn-secondary">Back</a>
	</div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
</body>
</html>
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
		
		include ('api.php'); /* calls api key */
		include ('messageLoop.php');
		
		$curl = curl_init();
		$responseArray = array();

		$cache = __DIR__."/sent.cache";
		$force_refresh = true;
		$refresh = 60*60;

		print_r($messageArray);

		if ($force_refresh || ((time() - filemtime($cache)) > ($refresh) || 0 == filesize($cache))) {
		
			foreach((array)$messageloop as $contents) {
				echo $val[''];
			}		

			clearstatcache();
			if(filesize($cache) > 0) {
				file_put_contents($cache, serialize($responseArray), FILE_APPEND | LOCK_EX);
			} else {
				file_put_contents($cache, serialize($responseArray));
			}

		} else {
			$responseArray = unserialize(file_get_contents($cache));
		}
		
		?>
		<a href="index.php" class="btn btn-secondary">Back</a>
	</div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
</body>
</html>
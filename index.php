<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.css">
    <title>Despatch Ticket Lookup</title>
</head>
<body>
	<div class="container">
		<h3>Mobile phone messaging service</h3>
			<form method="get" name="homeNav">
				<div class"form-group">
					<label for="phoneNumber">Phone Number</label>
					<input type="tel" class="form-control" name="phoneNumber" id="phoneNumber" placeholder="0412 345 678" pattern="[0-9]{4}[0-9]{3}[0-9]{3}" style="width:140px;"/required /><br>
					<label for="subject">Subject</label>
					<input type="text" class="form-control" rows="4" id="messageText" name="messageText"></textarea>
					<label for="messageText">Message</label>
					<textarea class="form-control" rows="4" id="messageText" name="messageText"></textarea>
				</div>
			<br/>
			<button type="submit" class="btn btn-primary">Submit</button>
		</form>
	</div>
	<?php
		$to = "https://api.au.whispir.com";
		$phoneNumber = $_GET['phoneNumber'];
		$message = $_GET['messageText'];
		$from = "Lang's Building Supplies";
		$headers = "From: $from\n";

		mail($to, '', $message, $headers);

	?>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
</body>
</html>
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
		<form method="post" name="homeNav" action="message-sent.php">
			<div class"form-group">
				<label for="phoneNumber">Phone Number</label>
				<input type="tel" class="form-control" name="phoneNumber" id="phoneNumber" placeholder="0412 345 678" pattern="[0-9]{4}[0-9]{3}[0-9]{3}" style="width:140px;" required /><br>
				<!--<label for="subject">Subject</label>
				<input type="text" class="form-control" id="subject" name="subject"></textarea>-->
				<label for="messageText">Message</label>
				<textarea class="form-control" rows="4" id="messageText" name="messageText" required></textarea>
			</div>
			<br/>
			<!--<p><i>Check that all details are correct</i></p>-->
			<button type="submit" name="submit" id="submit" class="btn btn-primary">Send</button>
			<a href="sent.php" class="btn btn-secondary my-2">View all sent</a>
		</form>
	</div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js" integrity="sha384-o+RDsa0aLu++PJvFqy8fFScvbHFLtbvScb8AjopnFD+iEQ7wo/CG0xlczd+2O/em" crossorigin="anonymous"></script>
</body>
</html>
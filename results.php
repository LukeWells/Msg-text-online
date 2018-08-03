<!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/bootstrap.css">
    <title>Despatch Ticket Results</title>
</head>
<body>
	<div class="container">
		<h3>Despatch Ticket Lookup</h3> 
		<p>Results:</p>
		<?php session_start(); $_SESSION['SalesOrderNumber'] = $_GET['SalesOrderNumber'];?>
		<iframe src="query-result.php" id="printFrame" width="500px" height="400px" name="printFrame">Browser doesn't support iframes - contact IT.</iframe>
		<br/>
		<a class="btn btn-primary" href="index.php" role="button">Back to search</a>
		<button class="btn btn-secondary" onclick="printTicket()">Print</button>
		<!--Copies <input type="number" name="printCopies" id="printCopies" value="1">-->
	</div>
</body>
<script>
	function printTicket() {
		window.frames["printFrame"].focus();
		window.frames["printFrame"].print();
	}
</script>
</html>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="css/bootstrap.css" media="screen">
	<link rel="stylesheet" href="css/print.css" media="print">
</head>
<body>
<?php
	
	session_start();
	
	/* Error display */
	ini_set('display_startup_errors', true);
	error_reporting(E_ALL);
	ini_set('display_errors', true);
	
	$salesId = $_SESSION['SalesOrderNumber']; /* parameter */

	$sql = "SELECT TOP 1 SALESPICKINGLISTJOURNALTABLE.DELIVERYNAME, 
			SALESPICKINGLISTJOURNALTABLE.SALESID, 
			SALESPICKINGLISTJOURNALTABLE.DELIVERYDATE, 
			SALESPICKINGLISTJOURNALTABLE.PICKINGLISTID, 
			SALESPICKINGLISTJOURNALTABLE.DELIVERYADDRESS, 
			SALESPICKINGLISTJOURNALLINE.ITEMID, 
			SALESPICKINGLISTJOURNALLINE.NAME
			FROM SALESPICKINGLISTJOURNALTABLE 
			INNER JOIN SALESPICKINGLISTJOURNALLINE 
			ON SALESPICKINGLISTJOURNALTABLE.SALESID = SALESPICKINGLISTJOURNALLINE.SALESID
			WHERE SALESPICKINGLISTJOURNALTABLE.SALESID LIKE ?"; /* tested, it works */
	
	$params = array("%".$salesId."%");

	include ('connect-mssql.php');

	$result = sqlsrv_query($conn, $sql, $params);
	if (!$result) die( print_r( sqlsrv_errors(), true));

	$found = 0;

	while($row = sqlsrv_fetch_array( $result, SQLSRV_FETCH_BOTH)) {

		echo "<div class='container printFrame'><b>";
		echo $row['DELIVERYNAME']; 
		echo "</b>";
		echo "<span class='right'>";
		echo $row['PICKINGLISTID'];
		echo "</span>";
		
		/*
		echo "<table cellpadding='2px'><tr><th>Order No.:</th><th>Delivery Date:</th><th>Pick List No.:</th></tr>"; 
		echo "<tr><td>";
		echo $row['SALESID'];
		echo "</td><td>";
		echo date_format($row['DELIVERYDATE'], 'd/m/Y');
		echo "</td><td>";
		echo $row['PICKINGLISTID'];
		echo "</td></tr></table><br/>";				
		*/

		/* new format */
		echo "<table class='font-down'>";
		echo "<tr><th>Order No."; 
		echo $row['SALESID'];
		echo "</th>";
		echo "<th class='right'>";
		echo date_format($row['DELIVERYDATE'], 'd/m/Y');
		echo "</th></tr></table>";	
		/* end new format */

		echo "<p id='address'>";
		echo $row['DELIVERYADDRESS'];
		echo "</p>";
		echo "<p id='orderSum'><b>Order Summary</b></p>";
		echo "<div class='font-down'>";
		echo $row['ITEMID'];
		echo "<br/>";
		echo $row['NAME'];
		echo "</div><br/>";
		echo "<div id='customPrint'>";
		echo "_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _<br/><br/>_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _ _<br/><br/>";
		echo "<p>___________________/___________________</p></div>"; 
		echo "</div>";

		$found = 1;
	}

	if($found == 1) {
		sqlsrv_free_stmt($result);
	} else {
		echo "No results found";
	}
?>
</body>
</html>
<?php
	/* Error display */
	ini_set('display_startup_errors', true);
	error_reporting(E_ALL);
	ini_set('display_errors', true);
	

	$serverName = "(local)"; /* LANGS\luke.wells */

	$connectionInfo = array("Database"=>"newDB"); /* same goes for newDB */

	static $conn;
	$conn = sqlsrv_connect($serverName, $connectionInfo);

	if( !$conn ) {
		echo "Connection could not be established.<br />";
		die( print_r( sqlsrv_errors(), true));
	}
?>
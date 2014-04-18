<?php
	function getDBH() {
		$dbUSER = "Username";
		$dbPASS = "Password";
		$dbh = new PDO('mysql:host=localhost;dbname=myDatabaseName', $dbUSER, $dbPASS);
		return $dbh;
	}
?>

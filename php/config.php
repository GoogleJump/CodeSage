<?php
	session_start();
	function getDBH() {
		$dbID = "***********";
		$dbPASS = "**********";
		$dbh = new PDO('mysql:host=localhost;dbname=******', $dbID, $dbPASS);
		return $dbh;
	}
?>

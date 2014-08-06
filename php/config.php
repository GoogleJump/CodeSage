<?php
	session_start();
	function getDBH() {
		$dbID = "Devon";
		$dbPASS = "MASTER_haxing713";
		$dbh = new PDO('mysql:host=localhost;dbname=codeSage', $dbID, $dbPASS);
		return $dbh;
	}
?>
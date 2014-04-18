<?php
	session_start();
	require('./connect.php');
	
	function createAccount($facebookID){
		$dbh = getDBH();
		$fetchAccounts = $dbh->prepare("SELECT accountID FROM accounts WHERE facebookID=:facebookID");
		$fetchAccounts->bindParam(":facebookID", $facebookID);
		$fetchAccounts->execute();
		if($fetchAccounts->rowCount() == 0){
			$createAccount = $dbh->prepare("INSERT INTO accounts (facebookID, rating, joinedAt) VALUES(:facebookID, 1000, :joinedAt)"); 
			$createAccount->bindParam(":facebookID", $facebookID);
			$createAccount->bindParam(":joinedAt", date("Y-m-d H:i:s"));
			$createAccount->execute();
		}
	}
	function fetchAccount($facebookID){
		$dbh = getDBH();
		
		$fetchAccount = $dbh->prepare("SELECT accountID, facebookID, rating, totalPoints, battleCount, victoryCount FROM accounts WHERE facebookID=:facebookID");
		$fetchAccount->bindParam(":facebookID", $facebookID);
		$fetchAccount->execute();
		if($row = $fetchAccount->fetch(PDO::FETCH_ASSOC)){
			return $row;
		}else{
			return false;
		}
	}
?>

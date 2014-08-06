<?php
	require_once('./config.php');
	$response = array();
	if($_POST['playerID'] && $_POST['battleID']){
		$dbh = getDBH();
		$attackQuery = $dbh->prepare("SELECT * FROM powerDowns WHERE battleID=:battleID AND playerID=:playerID");
		$attackQuery->bindParam(":battleID", $_POST['battleID']);
     		$attackQuery->bindParam(":playerID", $_POST['playerID']);
     		$attackQuery->execute();
     		
     		$attack = $attackQuery->fetch(PDO::FETCH_ASSOC);
     		
     		$response['success'] = true;
     		$response['powerDown'] = $attack['type'];
     		
     		$deleteQuery = $dbh->prepare("DELETE FROM powerDowns WHERE id=:id");
		$deleteQuery->bindParam(":id", $attack['id']);
     		$deleteQuery->execute();
	}else{
		$response['success'] = false;
	}
	echo json_encode($response);
?>
<?php
	require_once('./config.php');
	$response = array();
	if($_POST['playerID'] && $_POST['opponentID'] && $_POST['battleID'] && $_POST['type']){
		$dbh = getDBH();
		
		$playerQuery = $dbh->prepare("Select * FROM players WHERE facebookID=:playerID AND battleID=:battleID LIMIT 1");
                $playerQuery->bindParam(":playerID", $_POST['playerID']);
                $playerQuery->bindParam(":battleID", $_POST['battleID']);
                $playerQuery->execute();
                $player = $playerQuery->fetch(PDO::FETCH_ASSOC);
                $response['player'] = $player;
                if($player['points'] > 0){
                                
			$attackQuery = $dbh->prepare("INSERT INTO powerDowns (playerID, battleID, type) VALUES (:playerID, :battleID, :type)");
			$attackQuery->bindParam(":playerID", $_POST['opponentID']);
			$attackQuery->bindParam(":battleID", $_POST['battleID']);
			$attackQuery->bindParam(":type", $_POST['type']);     		
     			$attackQuery->execute();
     			
     			$points = $player['points'] - 1;
     			$playerQuery = $dbh->prepare("UPDATE players SET points=:points WHERE playerID=:playerID");
			$playerQuery->bindParam(":points", $points);
     			$playerQuery->bindParam(":playerID", $player['playerID']);
     			$playerQuery->execute();
     		
     			$response['success'] = true;
     			$response['points'] = $points;
     		}else{
     			$response['errors'][] = "Not enough points";
     		}
	}else{
		$response['errors'][] = "Missing parameters";
		$response['success'] = false;
	}
	echo json_encode($response);
?>
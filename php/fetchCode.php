<?php
	require_once('./config.php');
	$response = array();
	if($_POST['playerID'] && $_POST['battleID']){
		$dbh = getDBH();
		$playerQuery = $dbh->prepare("SELECT * FROM players WHERE battleID=:battleID AND facebookID=:facebookID");
		$playerQuery->bindParam(":battleID", $_POST['battleID']);
     		$playerQuery->bindParam(":facebookID", $_POST['playerID']);
     		$playerQuery->execute();
     		
     		$player = $playerQuery->fetch(PDO::FETCH_ASSOC);
     		
     		 $questionQuery = $dbh->prepare("SELECT * FROM questions WHERE id=:questionID LIMIT 1");
                 $questionQuery->bindParam(":questionID", $player['questionNumber']);
                 $questionQuery->execute();
                 $question = $questionQuery->fetch(PDO::FETCH_ASSOC);
                 
                $battleQuery = $dbh->prepare("SELECT * FROM battles WHERE battleKey=:battleKey");
        	$battleQuery->bindParam(":battleKey",  $_POST['battleID']);
        	$battleQuery->execute();        	
             	$battle = $battleQuery->fetch(PDO::FETCH_ASSOC);
     		
     		$response['success'] = true;
     		$response['code'] = $player['code'];
     		$response['opponentDescription'] = $question['Description'];
     		$response['opponentExample'] = $question['Example'];
     		$response['opponentCount'] = $player['questionCount'];
     		if($player['questionCount'] > $battle['questionCount']){
     			date_default_timezone_set('America/New_York'); 
      				$finishedAt = date("Y-m-d H:i:s");
                        	$updateBattle = $dbh->prepare("UPDATE battles SET finishedAt=:finishedAt WHERE battleKey=:battleKey ");
                        	$updateBattle->bindParam(":finishedAt", $finishedAt);
                        	$updateBattle->bindParam(":battleKey", $battle['battleKey']);
                        	$updateBattle->execute();
                        	
                        	$updatePlayer = $dbh->prepare("UPDATE players SET winner=1 WHERE playerID=:playerID ");
                        	$updatePlayer->bindParam(":playerID", $player['playerID']);
                        	$updatePlayer->execute();  
                        	
                       	$response['battleOver'] = true;
                }
     		//error_log("Using (".$_POST['playerID'].", ".$_POST['battleID']. ") Code Fetched: ".$_POST['code']);
	}else{
		$response['success'] = false;
	}
	echo json_encode($response);
?>
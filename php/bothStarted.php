<?php
	require_once('./config.php');
	$response = array("playerID" => $_POST['playerID'], "battleKey" => $_POST['battleID']);
	$response['errors'] = array();
	if($_POST['playerID'] && $_POST['battleID']){
		$dbh = getDBH();
		$battleQuery = $dbh->prepare("SELECT * FROM battles WHERE battleKey=:battleKey");
        	$battleQuery->bindParam(":battleKey",  $response['battleKey']);
        	$battleQuery->execute();        	
             	$battle = $battleQuery->fetch(PDO::FETCH_ASSOC);
             	
             	if($battle['player1ID'] && $battle['player2ID']){
             	
             		$playerQuery = $dbh->prepare("Select * FROM players WHERE facebookID=:playerID AND battleID=:battleID LIMIT 1");
                        $playerQuery->bindParam(":playerID", $battle['player1ID']);
                        $playerQuery->bindParam(":battleID", $response['battleKey']);
                        $playerQuery->execute();
                        $player1 = $playerQuery->fetch(PDO::FETCH_ASSOC);
                        
                        $playerQuery = $dbh->prepare("Select * FROM players WHERE facebookID=:playerID AND battleID=:battleID LIMIT 1");
                        $playerQuery->bindParam(":playerID", $battle['player2ID']);
                        $playerQuery->bindParam(":battleID", $response['battleKey']);
                        $playerQuery->execute();
                        $player2 = $playerQuery->fetch(PDO::FETCH_ASSOC);
                                
                        $questionQuery = $dbh->prepare("SELECT * FROM questions WHERE id=:questionID LIMIT 1");
                        $questionQuery->bindParam(":questionID", $player1['questionNumber']);
                        $questionQuery->execute();
                        $question1 = $questionQuery->fetch(PDO::FETCH_ASSOC);
                        
                        $questionQuery = $dbh->prepare("SELECT * FROM questions WHERE id=:questionID LIMIT 1");
                        $questionQuery->bindParam(":questionID", $player2['questionNumber']);
                        $questionQuery->execute();
                        $question2 = $questionQuery->fetch(PDO::FETCH_ASSOC);
                        
                        $AccountQuery = $dbh->prepare("Select * FROM accounts WHERE facebookID=:playerID LIMIT 1");
                        if($battle['player1ID'] == $_POST['playerID']) {
                        	$response['ownCount'] = $player1['questionCount'];
      				$response['ownDescription'] = $question1['Description'];
      				$response['ownExamples'] = $question1['Example'];
      				$response['opponentCount'] = $player2['questionCount'];
      				$response['opponentDescription'] = $question2['Description'];
      				$response['opponentExamples'] = $question2['Example'];
      				
          			$AccountQuery->bindParam(":playerID", $battle['player2ID']);
           			$AccountQuery->execute();
            			$account = $AccountQuery->fetch(PDO::FETCH_ASSOC);
            			$response['opponentName'] = $account['facebookName'];
            
      			}else{
      				$response['ownCount'] = $player2['questionCount'];
      				$response['ownDescription'] = $question2['Description'];
      				$response['ownExamples'] = $question2['Example'];
      				$response['opponentName'] = $player1['facebookName'];
      				$response['opponentCount'] = $player1['questionCount'];
      				$response['opponentDescription'] = $question1['Description'];
      				$response['opponentExamples'] = $question1['Example'];
      				
      				$AccountQuery->bindParam(":playerID", $battle['player1ID']);
           			$AccountQuery->execute();
            			$account = $AccountQuery->fetch(PDO::FETCH_ASSOC);
            			$response['opponentName'] = $account['facebookName'];
      			}
      			$response['success'] = true;
             	}else{
             		$response['success'] = false;
             	}
	}else{
  		$response['success'] = false;
 	}
 	echo json_encode($response);
?>
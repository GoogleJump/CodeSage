<?php
	//require_once("./config.php");
	function JoinBattle($battleKey, $facebookID){
		$dbh = getDBH();
		$errors = array();
		if(!$battleKey){
			$errors[] = "No battle ID found";
		}
		if(!$_SESSION['id']){
			$errors[] = "Session expired";
		}
		if($_SESSION['id'] != $facebookID){
			$errors[] = "Invalid sessionID";
		}


		$battleQuery = $dbh->prepare("SELECT * FROM battles WHERE battleKey=:battleKey");
        $battleQuery->bindParam(":battleKey", $battleKey);
        $battleQuery->execute();
        if($battleQuery->rowCount() == 0){
            $errors[] = "Invalid battle identification number";
        }else{
            $battle = $battleQuery->fetch(PDO::FETCH_ASSOC);
            if($_SESSION['id'] == $battle['player1ID'] || $_SESSION['id'] == $battle['player2ID']){
            	header("Location: ./battle.php?id=".$battleKey);
            }else{
              	if($battle['player1ID'] && $battle['player2ID']){
               		$errors[] = "Both competitors have already been taken";
               	}else{
               		if(empty($errors)){
               			$battleQuery = $dbh->prepare("UPDATE battles SET player2ID=:player2ID WHERE battleKey=:battleKey");
      					$battleQuery->bindParam(":player2ID", $_SESSION['id']);
      					$battleQuery->bindParam(":battleKey", $battleKey);
     					$battleQuery->execute();

     					$questionQuery = $dbh->prepare("SELECT * FROM `questions` WHERE id >= (SELECT FLOOR( MAX(id) * RAND()) FROM `questions` ) ORDER BY id LIMIT 1");
      $questionQuery->execute();
      $question = $questionQuery->fetch(PDO::FETCH_ASSOC);

      $createPlayer = $dbh->prepare("INSERT INTO players (facebookID, battleID, questionNumber, questionCount, points) VALUES (:facebookID, :battleID, :questionNumber, 1, 2) ");
      
      $createPlayer->bindParam(":facebookID", $_SESSION['id']);
      $createPlayer->bindParam(":battleID", $battleKey);
      $createPlayer->bindParam(":questionNumber", $question['id']);
      $createPlayer->execute();
               			
               			header("Location: ./battle.php?id=".$battleKey);
      				}
               	}
            }
        }
	}
?>
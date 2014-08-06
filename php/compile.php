<?php
	require_once('./config.php');
	 /*$data = $_POST['data'];
	 error_log("Data: ".$data);
   	 $data_array = get_object_vars($data);
   	  error_log("Data Array: ".$data);
    	 $language = $data_array["language"];
    	 error_log("Lang: ".$language);*/
    	 $language = $_POST['language'];
   	 $code = urldecode($_POST['code']);
    	 $playerID = $_POST["playerID"];
    	 $battleID = $_POST["battleID"];
	
	
	$response = array("playerID" => $playerID, "battleKey" => $battleID, "language" => $language);
	$response['errors'] = array();
	if($code && $playerID && $battleID){
		$dbh = getDBH();
		
		//error_log("PID: ".$_GET['playerID'].", BID: ".$_GET['battleID'].", CODE: ".$_GET['code']);
		$playerQuery = $dbh->prepare("UPDATE players SET code=:code WHERE battleID=:battleID AND facebookID=:facebookID");
		$playerQuery->bindParam(":code", $code);
		$playerQuery->bindParam(":battleID", $response['battleKey']);
     		$playerQuery->bindParam(":facebookID", $response['playerID']);
     		$playerQuery->execute();
     		
     		$battleQuery = $dbh->prepare("SELECT * FROM battles WHERE battleKey=:battleKey");
        	$battleQuery->bindParam(":battleKey",  $response['battleKey']);
        	$battleQuery->execute();        	
             	$battle = $battleQuery->fetch(PDO::FETCH_ASSOC);
             	
             	$response['language'] = $battle['language'];
		
		
		
		 //Your username and password for using the API
  $user = '**********';
  $pass = '**********';


  /* Get the language name and convert it to its
   * corresponding code that will be used as a parameter
   */


  if($language === "c++") {
    $lang = 1; // C++
  } elseif($language === "java") {
    $lang = 10;
  } elseif($language === "python") {
    $lang = 4;
  } elseif($language === "c") {
    $lang = 11;
  } elseif($language === "php") {
    $lang = 29;
  } else {
    $response['errors'][] = "error selecting language <br/>";
  }
  				$playerQuery = $dbh->prepare("Select * FROM players WHERE facebookID=:player1ID AND battleID=:battleID LIMIT 1");
                                $playerQuery->bindParam(":player1ID", $response['playerID']);
                                $playerQuery->bindParam(":battleID", $response['battleKey']);
                                $playerQuery->execute();
                                $player = $playerQuery->fetch(PDO::FETCH_ASSOC);
                                
                                $questionQuery = $dbh->prepare("SELECT * FROM questions WHERE id=:questionID LIMIT 1");
                                $questionQuery->bindParam(":questionID", $player['questionNumber']);
                                $questionQuery->execute();
                                $question = $questionQuery->fetch(PDO::FETCH_ASSOC);
  
  $inputs = explode(",", $question['testCases']);
  $outputs = explode(",", $question['acceptedOutput']);
  // Input string passed as stdin
  $input = $inputs[0];
  $response['input'] = $input;


  $run = true;
  $private = false;

  // Create client to use the API
  $client = new SoapClient('http://ideone.com/api/1/service.wsdl');

  $result = $client->createSubmission($user, $pass, $code, $lang, $input, $run, $private);

  // Check if the submission did not produce any error
  if ($result['error'] == 'OK') {
    $params = array(
          'user' => $user,
          'pass' => $pass,
          'link' => $result['link']
        );
    $status = $client->getSubmissionStatus($user, $pass, $result['link']);

    if ($status['error'] == 'OK') {
      // The program is finished running only when the status code is 0
      while ($status['status'] != 0) {
        $status = $client->getSubmissionStatus($user, $pass, $result['link']);
      }

      //finally get the submission results with output and other info
      $details = $client->getSubmissionDetails( $user, $pass, $result['link'], true, true, true, true, true);
      
      // You can now get the output with execution and compilation info
      if ( $details['error'] == 'OK' ) {
          $response['stderr'] = $details["stderr"];
          $response['output'] = $details["output"];
          $response['cmpinfo'] = $details['cmpinfo'];
          if($response['cmpinfo'] == ""){
          	$response['success'] = true;
         	 $response['correctOutput'] = trim($outputs[0]);
          	if(trim($response['output'] == trim($outputs[0]))){
          		$questionQuery = $dbh->prepare("SELECT * FROM `questions` WHERE id >= (SELECT FLOOR( MAX(id) * RAND()) FROM `questions` ) ORDER BY id LIMIT 1");
     			$questionQuery->execute();
      			$question = $questionQuery->fetch(PDO::FETCH_ASSOC);

      			$updatePlayer = $dbh->prepare("UPDATE players SET questionNumber=:questionNumber, questionCount=:questionCount, points=:points WHERE playerID=:playerID ");
      			$response['questionCount'] = $player['questionCount']+1;
      			$response['questionDescription'] = $question['Description'];
      			$response['questionExamples'] = $question['Example'];
      			$response['points'] = $player['points']+10;
     			$updatePlayer->bindParam(":questionNumber", $question['id']);
     			$updatePlayer->bindParam(":questionCount", $response['questionCount']);
     			$updatePlayer->bindParam(":points", $response['points']);
     			$updatePlayer->bindParam(":playerID", $player['playerID']);
      			$updatePlayer->execute();
                        if($response['questionCount'] > $battle['questionCount']){
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
                        
          		$response['correct'] = true;
          	}
          }else{
          	// Compiler/Syntax Failure
          	$response['success'] = false;
          }
      } else {
        //we got some error
       $response['errors'][] = $status;
      }
    } else {
        //we got some error
        $response['errors'][] = $status;
    }
  } else {
    //we got some error
    $response['errors'][] = $result;
  } 
  
  
  
  	}else{
  		$response['success'] = false;
 	}
  	echo json_encode($response);
?>

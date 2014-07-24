<?php
  ini_set('display_errors', 1);

  $user = 'rezanayebi';
  $pass = 'yugiho';

  $language = $_GET["language"];

  if($language === "cpp") {
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
    echo "error selecting language <br/>";
  }
  

  //$code = '';
  $code = $_GET['code'];
  $input = '';


  $run = true;
  $private = false;

  $client = new SoapClient('http://ideone.com/api/1/service.wsdl');

  $result = $client->createSubmission($user, $pass, $code, $lang, $input, $run, $private);

  /*$params = array(
        'user' => $user,
        'pass' => $pass,
        'sourceCode' => $code,
        'language' => $lang,
        'input' => $input,
        'run' => $run,
        'private' => $private
        );*/

  //$result= $client->call('createSubmission', $params);

  if ($result['error'] == 'OK') {
    $params = array(
          'user' => $user,
          'pass' => $pass,
          'link' => $result['link']
        );
    $status = $client->getSubmissionStatus($user, $pass, $result['link']);

    if ($status['error'] == 'OK') {
      while ($status['status'] != 0) {
        //sleep(3);
        //$status = $client->call('getSubmissionStatus', $params);
        $status = $client->getSubmissionStatus($user, $pass, $result['link']);
      }

      //finally get the submission results
      while(!($details = $client->getSubmissionDetails( $user, $pass, $result['link'], true, true, true, true, true)))
        echo "hi";
      //$details = $client->getSubmissionDetails( $user, $pass, $result['link'], true, true, true, true, true);
      if ( $details['error'] == 'OK' ) {
          echo $details["stderr"];
          echo $details["output"];
      } else {
        //we got some error
        var_dump( $details );
      }
    } else {
        //we got some error
        var_dump( $status );
    }
  } else {
    //we got some error
    var_dump( $result );
  } 

    
?>

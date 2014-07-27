<?php
  /*
   * Used to compile code with IDEone and get the results back
   * Takes the code, the language and the optional input 
   * as parameters (from GET request)
   */

  ini_set('display_errors', 1);


  //My username and password for using the API
  $user = 'rezanayebi';
  $pass = 'yugiho';


  /* Get the language name and convert it to its
   * corresponding code that will be used as a parameter
   */
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
  
  $code = $_GET['code'];

  // Input string passed as stdin
  $input = '';


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

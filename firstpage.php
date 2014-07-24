<?php
	session_start();
?>


<!DOCTYPE html>
<html lang="en">
	<head>
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <title>CodeWars</title>
	    <link href="assets/bootstrap-3.1.1-dist/css/bootstrap.min.css" rel="stylesheet">
	    <link href="firstpage.css" rel="stylesheet">
	    <link href="assets/bootstrap-social.css" rel="stylesheet">
	    <link href="assets/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet">
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	    <script type="text/javascript" src="firstscript.js"></script>
	</head>
	<body>
	<!-- Facebook login script -->
		<div id="fb-root"></div>

		<script>
			// This is called with the results from FB.getLoginStatus().
			function statusChangeCallback(response) {
			    console.log('statusChangeCallback');
			    console.log(response);
			    // The response object is returned with a status field that lets the
			    // app know the current login status of the person.
			    // Full docs on the response object can be found in the documentation
			    // for FB.getLoginStatus().
			    if (response.status === 'connected') {
			        $('#buttons').show();
			        $(".btn-facebook").hide();
			 		console.log(response.authResponse.userID);
			 		FB.api(
			    		response.authResponse.userID + "/picture",
			    		function (response) {
				      		if (response && !response.error) {
				        		//$('#profpic').attr("value", (response.data.url));
				        	}
				      			
			    		}
					);
			    } else if (response.status === 'not_authorized') {
			      // The person is logged into Facebook, but not your app.
			      document.getElementById('status').innerHTML = 'Please log ' +
			        'into this app.';
			    } else {
			      // The person is not logged into Facebook, so we're not sure if
			      // they are logged into this app or not

			      $('#buttons').hide();
			    }
			}

			  // This function is called when someone finishes with the Login
			  // Button.  See the onlogin handler attached to it in the sample
			  // code below.
			function checkLoginState() {
			  FB.getLoginStatus(function(response) {
			      statusChangeCallback(response);
			  });
			}

      		window.fbAsyncInit = function() {
	        	FB.init({
	          	appId      : '775332532487208',
          		xfbml      : true,
          		status     : true, 
    			cookie     : true,
    			version    : 'v2.0'

        		});
      		};

			(function(d, s, id) {
				  var js, fjs = d.getElementsByTagName(s)[0];
				  if (d.getElementById(id)) return;
				  js = d.createElement(s); js.id = id;
				  js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&appId=775332532487208&version=v2.0";
				  fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));

     		function FBLogin(){
    			FB.login(function(response){
        			if(response.authResponse){
            			//$('#buttons').show();
            			checkLoginState();
        			}
    			}, {scope: 'email'});
			}
			
    	</script>

	    <div class="background-image"></div>

	    <p class="logo">
	    	CodeWars_
	    </p>

	    <div class="container" id="buttons">
	    	<center>
	    		<a id= "play" class="btn btn-default btn-lg" href="#pg" data-toggle="modal">Play!</a>
	    		<a id= "join" class="btn btn-default btn-lg" href="#jg" data-toggle="modal">Join!</a>
	    	</center>	
	    </div>

	    <?php

	    	require_once('assets/Facebook/FacebookSession.php');
			require_once('assets/Facebook/FacebookRedirectLoginHelper.php' );
			require_once('assets/Facebook/FacebookRequest.php' );
			require_once('assets/Facebook/FacebookResponse.php' );
			require_once('assets/Facebook/FacebookSDKException.php' );
			require_once('assets/Facebook/FacebookRequestException.php' );
			require_once('assets/Facebook/FacebookAuthorizationException.php' );
			require_once('assets/Facebook/FacebookCurl.php');
			require_once('assets/Facebook/FacebookHttpable.php');
			require_once('assets/Facebook/FacebookCurlHttpClient.php' );
			require_once('assets/Facebook/GraphObject.php' );
			require_once('assets/Facebook/GraphUser.php' );
	    	require_once('assets/Facebook/FacebookJavaScriptLoginHelper.php');

	    	use assets\Facebook\FacebookSession;
			use assets\Facebook\FacebookRedirectLoginHelper;
			use assets\Facebook\FacebookRequest;
			use assets\Facebook\FacebookResponse;
			use assets\Facebook\FacebookSDKException;
			use assets\Facebook\FacebookRequestException;
			use assets\Facebook\FacebookAuthorizationException;
			use assets\Facebook\GraphObject;
			use assets\Facebook\GraphUser;

	    	Facebook\FacebookSession::setDefaultApplication('775332532487208', '16f219896ce52c30b1f2da140c4af606');
	    	$helper = new Facebook\FacebookJavaScriptLoginHelper();
	    	try {
			  $session = $helper->getSession();
			} catch(Facebook\FacebookRequestException $ex) {
			  // When Facebook returns an error
			} catch(\Exception $ex) {
			  // When validation fails or other local issues
			}
			if (isset($session) && $session) {
				try {

				    $user_profile = (new Facebook\FacebookRequest(
				      $session, 'GET', '/me'
				    ))->execute()->getGraphObject(Facebook\GraphUser::className());

				    $uid = $user_profile->getId();
				    //echo $uid;
				    $_SESSION["profpic"] = $uid;
				    //echo "Name: " . $user_profile->getName();

				} catch(Facebook\FacebookRequestException $e) {

				    echo "Exception occured, code: " . $e->getCode();
				    echo " with message: " . $e->getMessage();

				}   

			}

	    ?>

	    <center>
		    <button class="btn btn-social btn-facebook" onclick="FBLogin()">
				<i class="fa fa-facebook"></i>
				Sign in with Facebook
			</button>
		</center>

		<div class="modal fade" id="pg" role="dialog">
	    	<div class="modal-dialog">
	    		<div class="modal-content">
	    		<form action="playpage.php" method="post">
	    			<div class="modal-body">
		    				Select Language: 
		    				<select name="language">
		    					<option value="cpp">C++</option>
		    					<option value="c">C</option>
		    					<option value="java">Java</option>
		    					<option value="python">Python</option>
		    					<option value="php">PHP</option>
		    				</select>
		    				<br/>
		    				Number of games: 
		    				<select name="nb">
		    					<option value="1">1</option>
		    					<option value="2">2</option>
		    					<option value="3">3</option>
		    				</select>
		    				<br/>

		    			
					</div>
					<div class="modal-footer">
						<a href="" data-dismiss="modal" class="btn btn-default">Close</a>
						<input id ="sub" type="submit" name="submit" value="Submit"  class="btn btn-default"/>
	    			</div>
	    		</form>
	    		</div>
	    	</div>
	    </div>

	    <div class="modal fade" id="jg" role="dialog">
	    	<div class="modal-dialog">
	    		<div class="modal-content">
	    			<form action="" class="form-search" role="search">
		    			<div class="modal-body">
		    				<div class="col-md-4">
			    				 		
								<div class="input-group">
									<input type="text" class="form-control" id="search" placeholder="Search">
									<div class="input-group-btn">
		        						<a class="btn btn-default" type="submit" href="#"><span class="glyphicon glyphicon-search"></span></a>
		   							</div>
								</div>
		    				</div>
						</div>
						<div class="modal-footer">
							<a href="" data-dismiss="modal" class="btn btn-default">Close</a>
		    			</div>
	    			</form>
	    		</div>
	    	</div>
	    </div>
	   



		
    	<!-- Include all compiled plugins (below), or include individual files as needed -->
    	<script src="assets/bootstrap-3.1.1-dist/js/bootstrap.min.js"> </script>

    </body>

</html>




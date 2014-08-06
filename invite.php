<?php
  require_once("./php/config.php");
  $dbh = getDBH();
  $errors = array('spectate' => array(), 'compete' => array());


  if($_POST['fbID'] && $_POST['fbName']){
    $facebookID = $_POST['fbID'];
    $facebookName = $_POST['fbName'];   
    
    $userQuery = $dbh->prepare("SELECT * FROM accounts WHERE facebookID=:facebookID");
    $userQuery->bindParam(":facebookID", $facebookID);
    $userQuery->execute();
    if($userQuery->rowCount() == 0){
      date_default_timezone_set('America/New_York'); 
      $joinedAt = date("Y-m-d H:i:s");
      $createUser = $dbh->prepare("INSERT INTO accounts (facebookID, facebookName, rating, joinedAt) VALUES (:facebookID, :facebookName, 1000, :joinedAt) ");
      $createUser->bindParam(":facebookID", $facebookID);
      $createUser->bindParam(":facebookName", $facebookName);
      $createUser->bindParam(":joinedAt", $joinedAt);
      $createUser->execute();
      $_SESSION['id'] = $facebookID;
    }else{
      $_SESSION['id'] = $facebookID;
    }
  }
  if(!$_SESSION['id']){
    $errors['compete'][] = "You must be logged in to battle";
  }

  if($_GET['id']){
    $battleKey = $_GET['id'];
    $battleQuery = $dbh->prepare("SELECT * FROM battles WHERE battleKey=:battleKey");
    $battleQuery->bindParam(":battleKey", $battleKey);
    $battleQuery->execute();

    if($battleQuery->rowCount() == 0){
      $errors['compete'][] = "Invalid battle identification number";
      $errors['spectate'][] = "Invalid battle identification number";
    }else{
      $battle = $battleQuery->fetch(PDO::FETCH_ASSOC);
      if($battle['player1ID'] == $_SESSION['id'] || $battle['player2ID'] == $_SESSION['id']){
        $errors['spectate'][] = "You already registered to compete for this battle, you cannot change to spectate mode";
      }
      if($battle['player1ID'] && $battle['player2ID']){
        if(!($battle['player1ID'] == $_SESSION['id'] || $battle['player2ID'] == $_SESSION['id'])){
          $errors['compete'][] = "Both competing spots for this battle have already been taken";
        }
      }
    }
  }else{
    $errors['compete'][] = "No battle identification number found";
    $errors['spectate'][] = "No battle identification number found";
  }
  if($_POST['submitCompete'] && empty($errors['compete']) && $_GET['id'] && $_SESSION['id']){
      $battleQuery = $dbh->prepare("UPDATE battles SET player2ID=:player2ID WHERE battleKey=:battleKey");
      $battleQuery->bindParam(":player2ID", $_SESSION['id']);
      $battleQuery->bindParam(":battleKey", $battleKey);
     $battleQuery->execute();

     $questionQuery = $dbh->prepare("SELECT * FROM `questions` WHERE id >= (SELECT FLOOR( MAX(id) * RAND()) FROM `questions` ) ORDER BY id LIMIT 1");
      $questionQuery->execute();
      $question = $questionQuery->fetch(PDO::FETCH_ASSOC);

      $createPlayer = $dbh->prepare("INSERT INTO players (facebookID, battleID, questionNumber, questionCount, points) VALUES (:facebookID, :battleID, :questionNumber, 1, 2)");
      $createPlayer->bindParam(":facebookID", $_SESSION['id']);
      $createPlayer->bindParam(":battleID", $battleKey);
      $createPlayer->bindParam(":questionNumber", $question['id']);
      $createPlayer->execute();
      
     header("Location: ./battle.php?id=".$battleKey);
  }
  
?>
<html>
  <head>
    <title>Cutthroat Coding</title>
    <link href="./css/application.css" media="all" rel="stylesheet" type="text/css" />
    <style>
    body {
    overflow:hidden;
}
      .container {
  display: table;
  height: 100%;
  position: absolute;
  overflow: hidden;
  width: 100%;}
.helper {
  #position: absolute; /*a variation of an "lte ie7" hack*/
  #top: 50%;
  display: table-cell;
  vertical-align: middle;}
.content {
  #position: relative;
  #top: -50%;
  margin:0 auto;
  width:200px;}
  .title {
padding: 10px;
font-size: 30px;
text-shadow: 0px 2px 2px rgba(73,131,180,0.3);
color: rgb(133, 181, 219);
font-family: sans-serif;
font-weight: bold;
text-align: center;
line-height: 50px;}
.disabled {
  background-color: #D3D3D3 !important;
  background-image: none;
  cursor: not-allowed;
}
li {
  max-width: 300px;
white-space: normal;
text-align: left;}
    </style>
  </head>
  <body>
    <div class="container">
     <div class="helper">

          <div class="bodyContainer" style="width: 780px;text-align:center;">
      <div class="row row-split">
        <div class="pageTitle">
          <h1>Join Battle</h1>
        </div>
        <div class="mainContent">


          <?php 
            if(!$_SESSION['id']){ ?>
          <fb:login-button scope="" onlogin="checkLoginState();">
          </fb:login-button>

           <div id="status">
           </div>
          <?php }else{ 

              if(empty($errors['compete'])){ echo "<form action='./invite.php?id=".$_GET['id']."' method='POST' style='display:inline-block;'><input type='submit' name='submitCompete' class='button minibutton pwmLButton title' style='padding: 25px 15px;margin: 0 25px 0 0;' value='COMPETE'></form>";
            }else{ echo "<div class='button minibutton disabled' style='padding: 25px 15px;margin: 0 25px 0 0;'><div class='title'>COMPETE</div><ul>";
                foreach($errors['compete'] as $error){
                  echo '<li>' . $error . '</li>';
                }
                echo "</ul></div>"; }

            if(empty($errors['spectate'])){ echo "<form action='./battle.php?id=".$_GET['id']."' method='POST' style='display:inline-block;'><input type='submit' name='submitSpectate' class='button minibutton pwmLButton title' style='padding: 25px 15px;margin: 0 25px 0 0;' value='SPECTATE'></form>";
            }else{ echo "<div class='button minibutton disabled' style='padding: 25px 15px;'><div class='title'>SPECTATE</div><ul>";
            foreach($errors['spectate'] as $error){
                  echo '<li>' . $error . '</li>';
                }
                echo "</ul></div>"; }

           } ?>
        </div>
        </div>
         </div>
       </div>
    </div>

<?php if(!$_SESSION['id']){ ?>
    <script>

    function post_to_url(path, params, method) {
    method = method || "post"; // Set method to post by default if not specified.

    // The rest of this code assumes you are not using a library.
    // It can be made less wordy if you use one.
    var form = document.createElement("form");
    form.setAttribute("method", method);
    form.setAttribute("action", path);

    for(var key in params) {
        if(params.hasOwnProperty(key)) {
            var hiddenField = document.createElement("input");
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("name", key);
            hiddenField.setAttribute("value", params[key]);

            form.appendChild(hiddenField);
         }
    }

    document.body.appendChild(form);
    form.submit();
}

  // This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      testAPI();
    } else if (response.status === 'not_authorized') {
      // The person is logged into Facebook, but not your app.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into this app.';
    } else {
      // The person is not logged into Facebook, so we're not sure if
      // they are logged into this app or not.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into Facebook.';
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
    appId      : '312276722287273',
    cookie     : true,  // enable cookies to allow the server to access 
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.0' // use version 2.0
  });


  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
  });

  };

  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  function testAPI() {
    FB.api('/me', function(response) {
    <?php if($_GET['id']){
          echo "post_to_url('./invite.php?id=".$_GET['id']."', { 'fbID':response.id, 'fbName':response.name }, 'post');";
        }else{
          echo "post_to_url('./invite.php', { 'fbID':response.id, 'fbName':response.name }, 'post');";
        }
      ?>
    });
  }
</script>
<?php } ?>
  </body>
</html>
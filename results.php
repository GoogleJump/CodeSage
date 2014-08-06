<?php
  require_once("./php/config.php");
  if(!$_GET['id']){
    header("Location: http://dwbcoding.com/CutthroatCoding");
  }else{
  	$dbh = getDBH();
  	$battleQuery = $dbh->prepare("SELECT * FROM battles WHERE battleKey=:battleKey");
        $battleQuery->bindParam(":battleKey",  $_GET['id']);
        $battleQuery->execute();        	
        $battle = $battleQuery->fetch(PDO::FETCH_ASSOC);
        
        $playerQuery = $dbh->prepare("Select * FROM players WHERE facebookID=:playerID AND battleID=:battleID LIMIT 1");
        $playerQuery->bindParam(":playerID", $battle['player1ID']);
        $playerQuery->bindParam(":battleID", $battle['battleKey']);
        $playerQuery->execute();
        $player1 = $playerQuery->fetch(PDO::FETCH_ASSOC);
        
        $playerQuery = $dbh->prepare("Select * FROM players WHERE facebookID=:playerID AND battleID=:battleID LIMIT 1");
        $playerQuery->bindParam(":playerID", $battle['player2ID']);
        $playerQuery->bindParam(":battleID", $battle['battleKey']);
        $playerQuery->execute();
        $player2 = $playerQuery->fetch(PDO::FETCH_ASSOC);
        
  	$AccountQuery = $dbh->prepare("Select * FROM accounts WHERE facebookID=:player1ID LIMIT 1");
        $AccountQuery->bindParam(":player1ID", $battle['player1ID']);
        $AccountQuery->execute();
        $account1 = $AccountQuery->fetch(PDO::FETCH_ASSOC);

        $AccountQuery = $dbh->prepare("Select * FROM accounts WHERE facebookID=:player2ID LIMIT 1");
        $AccountQuery->bindParam(":player2ID", $battle['player2ID']);
        $AccountQuery->execute();
        $account2 = $AccountQuery->fetch(PDO::FETCH_ASSOC);
	     		
     		
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
  select {
display: inline-block;
height: 28px;
line-height: 28px;
border: 1px solid #aaa;
padding: 4px;
color: #555;
}
#settingsTable {
  margin: 0 auto;
}
#settingsTable tr td:first-child {
text-align: right;
padding: 0px 10px 10px 0;
}
#settingsTable tr td:last-child {
padding: 0px 10px 10px 0;
}
select {
  width: 100px;
}
    </style>
  </head>
  <body>
    <div class="container">
     <div class="helper">

          <div class="bodyContainer" style="width: 480px;text-align:center;">
      <div class="row row-split">
        <div class="pageTitle">
          <h1><?php echo $account1['facebookName']." vs ".$account2['facebookName']; ?></h1>
        </div>
        <div class="mainContent">
              <table id="settingsTable">
                <tr><td>Language:</td><td>
                <?php echo $battle['language']; ?>
              </td></tr>
              <tr><td># Questions:</td><td>
              <?php echo $battle['questionCount']; ?>
              </td></tr>
              <tr><td>Difficulty:</td><td>
              	<?php echo $battle['difficulty']; ?>
              </td></tr>
              <tr><td>Winner:</td><td>
              <?php if($player1['winner']){ echo $account1['facebookName']; }else
              if($player2['winner']){ echo $account2['facebookName']; } ?>
              </td></tr></table>
 		<a href="http://dbcoding.com/CutthroatCoding"><div class="button minibutton pwmLButton" style="padding: 15px 15px;margin-top:20px;">Back to Home</div></a>
        </div>
        </div>
         </div>
       </div>
    </div>
  </body>
</html>
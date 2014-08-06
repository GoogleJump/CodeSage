<?php
  require_once("./php/config.php");
  if(!$_SESSION['id']){
    header("Location: http://dwbcoding.com/CutthroatCoding");
  }
  $acceptedLanguages = ["c++", "java", "python", "php"];
  $acceptedQuestionCounts = [1, 2, 3, 4, 5, 6, 7, 8, 9];
  $acceptedDifficulties = ["easy", "medium", "hard", "ninja"];

  if($_POST['submit']){
    $errors = array();
    
    if(!in_array($_POST['language'], $acceptedLanguages)){ $errors[] = "Invalid Language Selection"; }
    if(!in_array($_POST['questionCount'], $acceptedQuestionCounts)){ $errors[] = "Invalid Question Count Selection"; }
    if(!in_array($_POST['difficulty'], $acceptedDifficulties)){ $errors[] = "Invalid Difficulty Selection"; }
    if(empty($errors)){
      date_default_timezone_set('America/New_York'); 
      $createdAt = date("Y-m-d H:i:s");
      $charset = array_flip(array_merge(range('a','z'), range('A','Z'), range(0,9)));
      $battleKey = implode('', array_rand($charset, 10));

      $dbh = getDBH();
      $createBattle = $dbh->prepare("INSERT INTO battles (battleKey, player1ID, language, difficulty, questionCount, createdAt) VALUES (:battleKey, :player1ID, :language, :difficulty, :questionCount, :createdAt) ");
      $createBattle->bindParam(":battleKey", $battleKey);
      $createBattle->bindParam(":player1ID", $_SESSION['id']);
      $createBattle->bindParam(":language", $_POST['language']);
      $createBattle->bindParam(":difficulty", $_POST['difficulty']);
      $createBattle->bindParam(":questionCount", $_POST['questionCount']);
      $createBattle->bindParam(":createdAt", $createdAt);
      $createBattle->execute();

      $questionQuery = $dbh->prepare("SELECT * FROM `questions` WHERE id >= (SELECT FLOOR( MAX(id) * RAND()) FROM `questions` ) ORDER BY id LIMIT 1");
      $questionQuery->execute();
      $question = $questionQuery->fetch(PDO::FETCH_ASSOC);

      $createPlayer = $dbh->prepare("INSERT INTO players (facebookID, battleID, questionNumber, questionCount, points) VALUES (:facebookID, :battleID, :questionNumber, 1, 2) ");
      $createPlayer->bindParam(":facebookID", $_SESSION['id']);
      $createPlayer->bindParam(":battleID", $battleKey);
      $createPlayer->bindParam(":questionNumber", $question['id']);
      $createPlayer->execute();

      
      header("Location: ./battle.php?id=".$battleKey);
    }else{

    }


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
          <h1>Select Battle Conditions</h1>
        </div>
        <div class="mainContent">
            <form action="" method="POST">
              <table id="settingsTable">
                <tr><td>Language:</td><td>
                <select name="language">
                  <?php foreach($acceptedLanguages as $language){
                    if($_POST['language'] == $language){
                      echo "<option value='{$language}' selected>".ucfirst($language)."</option>";
                    }else{
                      echo "<option value='{$language}'>".ucfirst($language)."</option>";
                    }
                  }
                  ?>
                </select>
              </td></tr>
              <tr><td># Questions:</td><td>
                <select name="questionCount">
                  <?php foreach($acceptedQuestionCounts as $questionCount){
                    if($_POST['questionCount'] == $questionCount){
                      echo "<option value='{$questionCount}' selected>".ucfirst($questionCount)."</option>";
                    }else{
                      echo "<option value='{$questionCount}'>".ucfirst($questionCount)."</option>";
                    }                    
                  }
                  ?>
                </select>
              </td></tr>
              <tr><td>Difficulty:</td><td>
                <select name="difficulty">
                   <?php foreach($acceptedDifficulties as $difficulty){
                    if($_POST['difficulty'] == $difficulty){
                      echo "<option value='{$difficulty}' selected>".ucfirst($difficulty)."</option>";
                    }else{
                      echo "<option value='{$difficulty}'>".ucfirst($difficulty)."</option>";
                    }                    
                  }
                  ?>
                </select>
              </td></tr></table>

              <input type="submit" name="submit" class="button minibutton pwmLButton" style="padding: 15px 15px;margin-top:20px;" value="Submit Battle" />
            </form>

        </div>
        </div>
         </div>
       </div>
    </div>
  </body>
</html>
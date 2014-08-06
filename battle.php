<?php
    require_once("./php/config.php");
    $dbh = getDBH();
    if($_GET['id']){
        $state = array();
        $battleKey = $_GET['id'];
        $battleQuery = $dbh->prepare("SELECT * FROM battles WHERE battleKey=:battleKey");
        $battleQuery->bindParam(":battleKey", $battleKey);
        $battleQuery->execute();
        if($battleQuery->rowCount() == 0){
            $errors['errors'][] = "Invalid battle identification number";
        }else{
             $battle = $battleQuery->fetch(PDO::FETCH_ASSOC);
             if($_SESSION['id']){
                if($_SESSION['id'] == $battle['player1ID']){
                    $state['position'] = "one";
                    $state['status'] = "compete";
                    $state['opponent'] = $battle['player2ID'];
                }else if($_SESSION['id'] == $battle['player2ID']){
                    $state['position'] = "two";
                    $state['status'] = "compete";
                    $state['opponent'] = $battle['player1ID'];
                }else{
                    $state['status'] = "spectate";
                }
             }else{
                $state['status'] = "spectate";
             }



            $playerQuery = $dbh->prepare("Select * FROM players WHERE facebookID=:player1ID AND battleID=:battleID LIMIT 1");
            $playerQuery->bindParam(":player1ID", $battle['player1ID']);
            $playerQuery->bindParam(":battleID", $battle['battleKey']);
            $playerQuery->execute();
            $player1 = $playerQuery->fetch(PDO::FETCH_ASSOC);

            $playerQuery = $dbh->prepare("Select * FROM players WHERE facebookID=:player2ID AND battleID=:battleID LIMIT 1");
            $playerQuery->bindParam(":player2ID", $battle['player2ID']);
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
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Cutthroat Coding</title>
    <link href="./css/application.css" media="all" rel="stylesheet" type="text/css" />
    <style type="text/css" media="screen">
        #editor, #editor2, #outputConsole {
            width: 500px;
            margin: 0 auto;
            text-align: left;
        }

        #editor {
            height: 300px;
        }

        .mainContent {
            text-align: left;
        }

        .flipped {
            -moz-transform: scaleX(-1);
            -o-transform: scaleX(-1);
            -webkit-transform: scaleX(-1);
            transform: scaleX(-1);
            filter: FlipH;
            -ms-filter: "FlipH";
        }

        .blurred {
            -webkit-filter: blur(2px);
            -moz-filter: blur(2px);
            -o-filter: blur(2px);
            -ms-filter: blur(2px);
            filter: blur(2px);
        }

        <?php if($state['status'] == "spectate") {
            echo "#editor { pointer-events:none; }";
        }

        else {
            echo "#editor2 { -webkit-filter: blur(2px); -moz-filter: blur(2px); -o-filter: blur(2px); -ms-filter: blur(2px); filter: blur(2px); }";
        }
?>
 #editor2 {
            height: 400px;
            pointer-events: none;
        }

        .divTitle {
            color: white;
            font-size: 30px;
        }

        .powerButton {
            padding: 25px 25px;
            border-radius: 50%;
            margin: 0 25px 0 0;
        }

            .powerButton img {
                width: 25px;
                height: 25px;
            }

        #outputConsole {
            width: 480px;
            background-color: #444;
            color: #FFF;
            height: 100px;
            padding: 0 10px 0 10px;
        }

        .disabled {
            background-color: #444 !important;
            background-image: #444 !important;
            cursor: not-allowed;
        }

        #ownDescription, #opponentDescription, #ownExample, #opponentExample, #opponentName {
            display: inline-block;
        }
    </style>
</head>
<body>
    <div class="container" style="width:1200px;max-height:650px;text-align:center;">
        <div class="helper" style="width:1200px;max-height:650px;text-align:center;">

            <div class="row row-split" style="width: 1000px;max-height:100px;text-align:center;position:relative;margin:20px auto;">
                <div style="border-radius:10px;padding:15px;background-color: #85b5db;">
                    <div class="divTitle" style="display:inline-block;">Share This Battle: </div><div style="color:white;display:inline-block;font-size:20px;margin:0 0 0 10px;"> http://dbcoding.com/CutthroatCoding/invite.php?id=<?php echo $_GET['id']; ?></div>
                </div>
            </div>

            <div class="bodyContainer" style="width: 1200px;max-height:450px;text-align:center;position:relative;margin:0 auto;">

                <div class="row row-split" style="max-width:550px;max-height:450px;display:inline-block;margin-right:50px;vertical-align: top;">
                    <div class="pageTitle divTitle"><?php if($state['position'] == "one"){ echo $account1['facebookName']; }else{ echo "<div id='opponentName'></div>"; }?></div>
                    <div class="mainContent">
                        <?php


                        $questionQuery = $dbh->prepare("SELECT * FROM questions WHERE id=:questionID LIMIT 1");
                        $questionQuery->bindParam(":questionID", $player1['questionNumber']);
                        $questionQuery->execute();
                        $question = $questionQuery->fetch(PDO::FETCH_ASSOC);
                        //echo "<b>Description:</b> ".$question['Description']."<br><b>Example:</b> ".$question['Example'];
                        if($state['position'] == "two"){
                        echo "<b>Description:</b><div id='opponentDescription'></div><br><b>Example:</b><div id='opponentExample'></div>";
                        }else{
                        echo "<b>Description:</b><div id='ownDescription'></div><br><b>Example:</b><div id='ownExample'></div>";
                        }
                        ?>
                        <div <?php if($state['position'] == "one"){ echo "id='editor'"; }else if($state['position'] == "two"){ echo "id='editor2'"; } ?> ></div>
                        <?php if($state['position'] == "one"){ ?>
                        <div id="outputConsole"></div>
                        <?php } ?>
                    </div>
                </div>


                <div class="row row-split" style="max-width:550px;max-height:450px;display:inline-block;vertical-align: top;">
                    <div class="pageTitle divTitle"><?php if($state['position'] == "two"){ echo $account2['facebookName']; }else{ echo "<div id='opponentName'></div>"; }?></div>
                    <div class="mainContent">
                        <?php
                        $questionQuery = $dbh->prepare("SELECT * FROM questions WHERE id=:questionID LIMIT 1");
                        $questionQuery->bindParam(":questionID", $player2['questionNumber']);
                        $questionQuery->execute();
                        $question = $questionQuery->fetch(PDO::FETCH_ASSOC);
                        //echo "<b>Description:</b> ".$question['Description']."<br><b>Example:</b> ".$question['Example'];
                        if($state['position'] == "one"){
                        echo "<b>Description:</b><div id='opponentDescription'></div><br><b>Example:</b><div id='opponentExample'></div>";
                        }else{
                        echo "<b>Description:</b><div id='ownDescription'></div><br><b>Example:</b><div id='ownExample'></div>";
                        }
                        ?>
                        <div <?php if($state['position'] == "one"){ echo "id='editor2'"; }else if($state['position'] == "two"){ echo "id='editor'"; } ?> ></div>
                        <?php if($state['position'] == "two"){ ?>
                        <div id="outputConsole"></div>
                        <?php } ?>
                    </div>
                </div>


                <div class="row row-split" style="width: 1000px;max-height:100px;text-align:left;position:relative;margin:100px auto 0 auto;">
                    <div style="border-radius:10px;padding:15px;background-color: #85b5db;">
                        <div style="display:inline-block;color:white;font-size:20px;vertical-align:middle;height:100%;margin:0 20px 0 0;">
                            Question: <div id="currentQuestionNumber" style="display:inline-block;"></div> / <?php echo $battle['questionCount']; ?><br>
                            Available Points: <div id="currentPoints" style="display:inline-block;"></div><br>
                        </div>
                        <div id='submitButton' class='button minibutton pwmLButton' style='padding: 25px 15px;border-radius:20px;margin: 0 25px 0 0;' onclick='submitCode()'>SUBMIT</div>
                        <div id='popupButton' class='button minibutton pwmLButton powerButton' onclick="sendPowerDown('popup')"><img src="./images/powerDowns/popup.png"></div>
                        <div id='blurButton' class='button minibutton pwmLButton powerButton' onclick="sendPowerDown('blur')"><img src="./images/powerDowns/blur.png"></div>
                        <div id='timerButton' class='button minibutton pwmLButton powerButton' onclick="sendPowerDown('freeze')"><img src="./images/powerDowns/timer.png"></div>
                        <div id='scissorsButton' class='button minibutton pwmLButton powerButton' onclick="sendPowerDown('snip')"><img src="./images/powerDowns/scissors.png"></div>
                        <div id='mirrorButton' class='button minibutton pwmLButton powerButton' onclick="sendPowerDown('flip')"><img src="./images/powerDowns/mirror.png"></div>

                    </div>

                </div>


            </div>
        </div>
    </div>
    <script src="./ace-builds/src-noconflict/ace.js" type="text/javascript" charset="utf-8"></script>
    <script src="./js/jquery.min.js"></script>
    <script>
        var currentQuestionNumber = <?php if($state['position'] == "one"){ echo $player1['questionCount']; }else if($state['position'] == "two"){ echo $player2['questionCount']; } ?>;
        var currentPoints = <?php if($state['position'] == "one"){ echo $player1['points']; }else if($state['position'] == "two"){ echo $player2['points']; } ?>;
        var langs = {"python": "python", "php": "php", "c++": "c_cpp", "javascript": "javascript"};
        var editor = ace.edit("editor");
        editor.setTheme("ace/theme/monokai");
        editor.getSession().setMode("ace/mode/"+<?php echo "langs['".$battle['language']."']"; ?>);

        var editor2 = ace.edit("editor2");
        editor2.setTheme("ace/theme/monokai");
        editor2.getSession().setMode("ace/mode/"+<?php echo "langs['".$battle['language']."']"; ?>);

        editor.setValue("Waiting for other player to join");

        var bothStarted = false;
        <?php
            echo "var code = '';";
            echo "var questionNum = 0;";
            echo "var question = '';";
            echo "var lang = '".$battle['language']."';";
            if($battle['language'] == "c++"){ echo "var defaultCode = '#include <iostream> \\nusing namespace std;\\n\\nint main() {\\n    return 0;\\n}';";
            }else if($battle['language'] == "php"){echo "var defaultCode = '<?php\\n\\n?>';";
            }else if($battle['language'] == "python"){ echo "var defaultCode = 'def main():\\n    return\\nmain()';";
            }else if($battle['language'] == "java"){ echo "var defaultCode = 'JAVA!'"; }
        ?>
        document.getElementById("currentQuestionNumber").innerHTML = currentQuestionNumber;
        document.getElementById("currentPoints").innerHTML = currentPoints;

        function submitCode(){

      $( "#submitButton" ).attr('onclick','').unbind('click');
        $('#submitButton').addClass("disabled");
        code = editor.getSession().getValue();
        <?php echo "var rwdat= 'language='+encodeURIComponent(lang)+'&code='+encodeURIComponent(code)+'&playerID='+encodeURIComponent('".$_SESSION['id']."')+'&battleID='+encodeURIComponent('".$_GET['id']."');"; ?>
        var jsons = JSON.stringify(rwdat);
        $.ajax({
            type: "POST",
            url: "./php/compile.php",
            data:  rwdat,
            dataType: 'json',
                success: function(response){
                    if(response.success){
                        if(!response.correct){
                            $("#outputConsole").html("Successfully Compiled!<br>Incorrect Answer, try again!<br>Output: "+response.output);
                        }else{
                            if(!response.battleOver){
                            $("#outputConsole").html("Successfully Compiled!<br>Correct Answer, great job! (+10 points)<br>Output: "+response.output);
                            currentPoints += 10;
                            setAttackButtons();
                            $("#currentPoints").html(currentPoints);
                            $("#currentQuestionNumber").html(response.questionCount);
                            $("#ownDescription").html(response.questionDescription);
                            $("#ownExample").html(response.questionExamples);
                            editor.setValue(defaultCode);
                            }else{
                                <?php echo "window.location.href = './results.php?id=".$_GET['id']."'"; ?>
                            }
                        }

                    }else{
                        $("#outputConsole").html("Failed To Compile!<br>Error: "+response.cmpinfo);
                    }
                    $( "body" ).on( "click", "#submitButton", submitCode );
                    $('#submitButton').removeClass("disabled");
                }
            });

        }

        setInterval(function(){updateCode();}, 5000);

        function updateCode(){
            var code = editor.getSession().getValue();
            $.ajax({
                type: "POST",
                url: "./php/compile.php",
                data: <?php echo "'code='+code+'&playerID=".$_SESSION['id']."&battleID=".$_GET['id']."',"; ?>
                dataType: 'json',
                success: function(response){
                }
            });
            $.ajax({
            type: "POST",
                url: "./php/fetchCode.php",
                data: <?php echo "'playerID=".$state['opponent']."&battleID=".$_GET['id']."',"; ?>
                dataType: 'json',
                success: function(response){
                    if(response.success == true){
                        if(!response.battleOver){
                       var editor2 = ace.edit("editor2");
                       editor2.getSession().setValue(response.code);
                       $("#opponentDescription").html(response.opponentDescription);
                        $("#opponentExample").html(response.opponentExample);
                        }else{
                                <?php echo "window.location.href = './results.php?id=".$_GET['id']."'"; ?>
                            }
                    }
                }
        });
        }
        function sendPowerDown(powerDownType){
            $.ajax({
            type: "POST",
                url: "./php/sendPowerDown.php",
                data: <?php echo "'playerID=".$_SESSION['id']."&opponentID=".$state['opponent']."&battleID=".$_GET['id']."&type='+powerDownType,"; ?>
                dataType: 'json',
                success: function(response){
                    if(response.success == true){
                        alert(powerDownType+" Attack Sent");
                        currentPoints = response.points;
                        $("#currentPoints").html(currentPoints);
                        setAttackButtons();
                    }else{
                        alert("Failed to send PowerDown");
                    }
                }
            });
        }
        setInterval(function(){fetchPowerDown();}, 5000);
        function fetchPowerDown(){
            $.ajax({
            type: "POST",
                url: "./php/fetchPowerDown.php",
                data: <?php echo "'playerID=".$_SESSION['id']."&battleID=".$_GET['id']."',"; ?>
                dataType: 'json',
                success: function(response){
                    if(response.success == true){
                        if(response.powerDown == "popup"){
                            alert("Yo Mama so dumb she brought a spoon to the super bowl.");
                        }else if(response.powerDown == "freeze"){
                            alert("Freeze!");
                        }else if(response.powerDown == "flip"){
                            $( "#editor" ).addClass( "flipped" );
                        }else if(response.powerDown == "blur"){
                            $( "#editor" ).addClass( "blurred" );
                        }
                        setAttackButtons();
                        clearAttacks();
                    }else{
                        alert("Failed to fetch PowerDown");
                    }
                }
            });
        }
        var fetchInterval = setInterval(function(){fetchBothStarted();}, 2000);
        function fetchBothStarted(){
            $.ajax({
            type: "POST",
                url: "./php/bothStarted.php",
                data: <?php echo "'playerID=".$_SESSION['id']."&battleID=".$_GET['id']."',"; ?>
                dataType: 'json',
                success: function(response){
                    if(response.success == true){
                       alert("Your opponent has joined");
                       bothStarted = true;
                            $("#currentQuestionNumber").html(response.ownCount);
                            $("#ownDescription").html(response.ownDescription);
                            $("#ownExample").html(response.ownExamples);
                            $("#opponentDescription").html(response.opponentDescription);
                            $("#opponentExample").html(response.opponentExamples);
                            $("#opponentName").html(response.opponentName);
                            editor.setValue(defaultCode);
                            editor2.setValue(defaultCode);
                        clearInterval(fetchInterval);
                    }
                }
            });
        }
        setAttackButtons();
        function setAttackButtons(){
        	if(currentPoints < 1){
        		$("#popupButton").addClass("disabled");
        		$("#blurButton").addClass("disabled");
        		$("#timerButton").addClass("disabled");
        		$("#scissorsButton").addClass("disabled");
        		$("#mirrorButton").addClass("disabled");
        	}else{
        		$("#popupButton").removeClass("disabled");
        		$("#blurButton").removeClass("disabled");
        		$("#timerButton").removeClass("disabled");
        		$("#scissorsButton").removeClass("disabled");
        		$("#mirrorButton").removeClass("disabled");
        	}
        }
        var attackCounter = 0;
        var clearAttacks = function(){
            if(attackCounter > 5){
                // run when condition is met
                attackCounter = 0;
                $( "#editor" ).removeClass( "flipped" );
                $( "#editor" ).removeClass( "blurred" );

            } else {
                attackCounter++;
                setTimeout(clearAttacks, 15000); // check again in a second
            }
        }
    </script>
</body>
</html>
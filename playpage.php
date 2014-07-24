<?php
	session_start();
?>


<!DOCTYPE html>
<html>
    <head>
    	<meta name="viewport" content="width=device-width, initial-scale=1">
    	<title>CodeWars</title>
    	<link href="assets/codemirror-4.0/lib/codemirror.css" rel="stylesheet">
    	<link href="assets/bootstrap-3.1.1-dist/css/bootstrap.min.css" rel="stylesheet">
    	<link href="playpage.css" rel="stylesheet">
    	<script src="assets/jquery-1.11.1.min.js"></script>
    	<script src="assets/codemirror-4.0/lib/codemirror.js"></script>
		<script src="assets/codemirror-4.0/mode/python/python.js"></script>
		<script src="assets/codemirror-4.0/mode/javascript/javascript.js"></script>
		<script src="assets/codemirror-4.0/mode/clike/clike.js"></script>
		<script type="text/javascript" src="playpage.js"></script>	
    </head>
<body>

	<script type="text/javascript">
		var timer;
		var totalsecs

		function createTimer(timerId, time) {
			timer = document.getElementById(timerId);
			totalsecs = time;
			updateTimer();
			window.setTimeout("tick()", 1000);
		}

		function tick() {
			if(totalsecs == 0) {
				window.location.replace('postgame.php');
				return;
			}
			totalsecs -= 1;
			updateTimer()
			window.setTimeout("tick()", 1000);
		}

		function updateTimer() {
			var seconds = totalsecs;

			var minutes = Math.floor(seconds/60);
			seconds -= minutes * 60;

			var timeStr = leadingZero(minutes) + ":" + leadingZero(seconds);

			timer.innerHTML = timeStr;
		}


		function leadingZero(time) {
			return time < 10 ? "0" + time : "" + time;
 		}
	</script>

	<img id="pic" src= <?php echo "https://graph.facebook.com/" . $_SESSION["profpic"] . "/picture" ?> />

	<p class="logo">
	    CodeWars_
	</p>


	<div id="timer"></div>
	<script type="text/javascript">window.onload = createTimer("timer", 220);</script>


	<div>
		<div class="p1">
			<textarea class="text" id="player">
#include<stdio.h>
int main() {
	printf("hello");
	return 0;
}
			</textarea>

			<div class="output" id="out1" readonly="true"></div>

			<div id="effects">
				<div class="effect" id="ef1"></div>
				<div class="effect" id="ef2"></div>
				<div class="effect" id="ef3"></div>
			</div>

			<a class="btn btn-danger btn-md" id="submit" onclick="showResult()">Submit</a>
		</div>


		<div class="p2">
			<textarea class="text" id="te">Lorem ipsum dolor sit amet</textarea>

			<div class="output" id="out2" readonly="true"></div>

			<div id="fake_effects">
				<div class="fake effect"></div>
				<div class="fake effect" id="fef2"></div>
				<div class="fake effect"></div>
			</div>

			<button class="btn btn-default btn-md fake" id="fake_submit">Submit</button>

		</div>
	
	</div>

	<script>
	var myCodeMirror1 = CodeMirror.fromTextArea(document.getElementById("player"), {
		lineNumbers: true,
	});

	myCodeMirror1.setSize("90%", "400px");

	var myCodeMirror2 = CodeMirror.fromTextArea(document.getElementById("te"), {
		lineNumbers: true,
		readOnly: "nocursor",
	});

	myCodeMirror2.setSize("90%", "400px");

	console.log(myCodeMirror1.getValue());

	function showResult()
    {
      var code  = myCodeMirror1.getValue();
      //var input = document.getElementById('input').value;

      if (code != '') {
        var xmlhttp;
        if (window.XMLHttpRequest) {
          xmlhttp = new XMLHttpRequest();
        } else {
          //document.getElementById('result').innerHTML = 'HERE IS AN ERROR!';
        }

        xmlhttp.onreadystatechange = function() {
          if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById('out1').innerHTML = xmlhttp.responseText;
          }
        }

        lang = <?php echo json_encode($_POST["language"]); ?>;

        xmlhttp.open('GET', 'ideone.php?code=' + encodeURIComponent(code) + 
        '&language=' + encodeURIComponent(lang), true); //+ '&input=' + encodeURIComponent(input)
        xmlhttp.send();
      }

    }

	</script>


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>	
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="assets/bootstrap-3.1.1-dist/js/bootstrap.min.js"></script>

</body>
</html>



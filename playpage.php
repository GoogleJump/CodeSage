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
		<script type="text/javascript" src="playpage.js"></script>	
    </head>
<body>

	<p class="logo">
	    CodeWars_
	</p>

	
	<div class="container">
		<textarea id="player">#include<stdio.h>
int main() {
    printf("hello");
    return 0;
}</textarea>
		<textarea id="te">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</textarea>
	</div>


	<script>
	var myCodeMirror1 = CodeMirror.fromTextArea(document.getElementById("player"), {
		lineNumbers: true,
	});

	myCodeMirror1.setSize("43%", "500px");

	var myCodeMirror2 = CodeMirror.fromTextArea(document.getElementById("te"), {
		lineNumbers: true,
		readOnly: "nocursor",
	});

	myCodeMirror2.setSize("43%", "500px");

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

        xmlhttp.open('GET', 'ideone.php?code=' + encodeURIComponent(code), true); //+ '&input=' + encodeURIComponent(input)
        xmlhttp.send();
      }

    }

	</script>


	<a class="btn btn-danger btn-md" id="submit" onclick="showResult()">Submit</a>

	<div class="effect" id="ef1">effect 1</div>
	<div class="effect" id="ef2">effect 2</div>
	<div class="effect" id="ef3">effect 3</div>
	<!-- <div class="effect" id="ef4">effect 4</div>
	<div class="effect" id="ef5">effect 5</div>
	<div class="effect" id="ef6">effect 6</div>
	
	<button class="btn btn-primary btn-sm" id="ef2">effect 2</button>
	<button class="btn btn-primary btn-sm" id="ef3">effect 3</button>
	<button class="btn btn-primary btn-sm" id="ef4">effect 4</button>
	<button class="btn btn-primary btn-sm" id="ef5">effect 5</button>
	<button class="btn btn-primary btn-sm" id="ef6">effect 6</button>
	-->

	<div class="output" id="out1" readonly="true"></div>
	<div class="output" id="out2" readonly="true"></div>



	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>	
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="assets/bootstrap-3.1.1-dist/js/bootstrap.min.js"></script>

</body>
</html>
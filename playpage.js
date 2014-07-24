$(document).ready(function() {
	var p1 = $('.CodeMirror')[1];
	$(p1).addClass('player1');

	var p2 = $('.CodeMirror')[1];
	$(p1).addClass('player2');

	$('#ef1').click(function() {
		var editor = $('.CodeMirror')[1];
		$(editor).toggle();
		window.setTimeout(function() {
			$(editor).toggle()
		}, 5000);
	});

	$('#ef2').click(
		function() {
			var editor = $('.CodeMirror')[1];
			$(editor).toggleClass('blur');
			window.setTimeout(function() {
				$(editor).toggleClass('blur')
			}, 5000);
		}

	);

	$('#ef3').click(function() {
		for (var i = 0; i < 10; i++) {
			alert("Hey!")
		}
	});

	$('#submit').click(function() {
		/*while($('#out1').text() === "") {
			$('#out1').css('background-image', 'url(ajax-loader.gif)');
			console.log("hello");
		}*/

		//console.log("Text: " + $('#out1').text());
	})

	if($('#timer').text() === "00:00") {
		console.log("it's over");
	}


});
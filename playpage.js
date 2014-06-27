$(document).ready(function() {
	$('#ef1').click(function() {
		var editor = $('.CodeMirror')[1];
		$(editor).toggle();
	});

	$('#ef2').click(
		function() {
			var editor = $('.CodeMirror')[1];
			$(editor).toggleClass('blur');
		}

	);

	$('#ef3').click(function() {
		for (var i = 0; i < 10; i++) {
			alert("Hey!")
		}
	});


});
function loadInnerHTML(button){
	$.ajax({
    type: 'HEAD',
    url: 'src/'+button.id+'.php',
	success: function() {
		$("#loadContent").load('src/'+button.id + ".php"); 
	},
	error: function() {
		$.ajax({
	    type: 'HEAD',
	    url: 'src/'+button.id+'.html',
		success: function() {
			$("#loadContent").load('src/'+button.id + ".html"); 
		},
		error: function() {
			$("#loadContent").load("src/error.html");
		}
		});
	}
	});
}

/*For JQuery methods */
$(document).ready(function() {
	$('#myForm').on('submit', function(e) {
	        e.preventDefault();
	});
});

function loadInnerHTML(button){
	$.ajax({
    type: 'HEAD',
    url: 'src/'+button.id+'.php',
	success: function() {
		$("#loadContent").load('src/'+button.id + ".php?Id=2"); 
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

function loadAttack(id){
	$.ajax({
    type: 'HEAD',
    url: 'src/attack.php',
	success: function() {
		$("#loadContent").load("src/attack.php?Id="+id); 
	},
	error: function() {
		alert("error");
	}
	});
}

function redirectHome(playerId, oppId){
	if(playerId != -1){
		$.ajax({
		type: "post",
		data: {"playerId": playerId, "oppId": oppId},
		url: 'src/level.php',
		success: function(response) {
		},
		error: function(response) {
			alert(response);
		  }
		});
	}
	
	$.ajax({
    type: 'HEAD',
    url: 'src/home.html',
	success: function() {
		$("#loadContent").load("src/home.html"); 
	},
	error: function() {
		alert("error");
	}
	});
}

/*For JQuery methods */
$(document).ready(function() {

});

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
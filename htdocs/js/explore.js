function explore(place, playerId){
	$.ajax({
         url: "src/dropChance.php",
         type: "POST",
         data: {"playerId": playerId },
         cache: false,
         success: function (response) {
             $('#exploreText').html(response);
         }
     });
}

function getRandomInt(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}
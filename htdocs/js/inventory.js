$(document).ready (function(){
            $("#equip-alert").hide();
            $("#drop-alert").hide();
            $("#unequip-alert").hide();
            $("#use-alert").hide();
            $(".equipbtn").click(function showAlert() {
                $("#equip-alert").alert();
                $("#equip-alert").fadeTo(2000, 500).slideUp(500, function(){
               $("#equip-alert").slideUp(500);
                });   
            });
        	$(".dropbtn").click(function showAlert() {
                $("#drop-alert").alert();
                $("#drop-alert").fadeTo(2000, 500).slideUp(500, function(){
               $("#drop-alert").slideUp(500);
                });   
            });
            $(".unequipbtn").click(function showAlert() {
                $("#unequip-alert").alert();
                $("#unequip-alert").fadeTo(2000, 500).slideUp(500, function(){
               $("#unequip-alert").slideUp(500);
                });   
            });
            $(".usebtn").click(function showAlert() {
                $("#use-alert").alert();
                $("#use-alert").fadeTo(2000, 500).slideUp(500, function(){
               $("#use-alert").slideUp(500);
                });   
            });
 });

function useObject(userId, itemId, func){
                $.ajax({
                type: "post",
                data: {"userId": userId, "itemId": itemId, "func": func},
                url: 'src/invChange.php',
                success: function(response) {
                    var json = $.parseJSON(response);
                    $("#response").css('color', 'blue');
                    $("#wQuant").css('color', 'black');
                    $("#hQuant").css('color', 'black');
                    $("#fQuant").css('color', 'black');                 
                    if (func == 1) {
                        $( "#response" ).html("You equipped " + json.itemName);
                    }
                    else if (func == 2) { 
                        $( "#response" ).html("You dropped " + json.itemName);
                        if (json.returnmsg == 0) { $('#wOption'+json.itemId).remove(); }
                        else { $("#wQuant"+json.itemId).html(json.returnmsg); }
                    }
                    else if (func == 3) { 
                        $( "#response" ).html("You unequipped " + json.itemName);
                    }
                    else if (func == 4) { 
                        $( "#response" ).html("You gained " + json.boost + " health");
                        if (json.returnmsg == 0) { $('#hOption'+json.itemId).remove();  }
                        else { $("#hQuant"+json.itemId).html(json.returnmsg); }
                    }
                    else if (func == 5) { 
                        $( "#response" ).html("You dropped " + json.itemName);
                        if (json.returnmsg == 0) { $('#hOption'+json.itemId).remove();  }
                        else { $("#hQuant"+json.itemId).html(json.returnmsg); }
                    }
                    else if (func == 6) { 
                        $( "#response" ).html("You gained " + json.boost + " energy");
                        if (json.returnmsg == 0) { $('#fOption'+json.itemId).remove();  }
                        else { $("#fQuant"+json.itemId).html(json.returnmsg); }
                    }
                    else if (func == 7) { 
                        $( "#response" ).html("You dropped " + json.itemName);
                        if (json.returnmsg == 0) { $('#fOption'+json.itemId).remove();  }
                        else { $("#fQuant"+json.itemId).html(json.returnmsg); }
                    }
                },
                error: function(response) {
                    $("#response").css('color', 'red');
                    $("#response").html(response);
                  }
                });
            }

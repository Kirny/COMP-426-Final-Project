$(document).ready(function () {
    fetch_balance();
});

var fetch_balance = function () {
    var div = $("#balance");
    $.ajax("welcomepage.php",
	         {type: "GET",
	         dataType: "json",
	         success: function (balance, textStatus, jqXHR) {
              div.append("<h4>"+ "Test" +"</h4>");
	         }
	         });
};

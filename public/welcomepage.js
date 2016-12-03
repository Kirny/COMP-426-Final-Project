$(document).ready(function () {
    fetch_balance();
});

var fetch_balance = function () {
    var div = $("#balance");
    $.ajax("../welcomepage.php",
	         {type: "GET",
	         dataType: "json",
	         success: function (data, textStatus, jqXHR) {
              div.append("<h4>"+ "$ " + data["balance"] + "</h4>");
	         }
	         });
};

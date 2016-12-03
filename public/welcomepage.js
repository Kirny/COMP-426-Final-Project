$(document).ready(function () {
    fetch_userInfo();
});

var fetch_userInfo = function () {
    var fn = $('#fullname');
    var un = $('#username');
    var bal = $('#balance');
    $.ajax("../welcomepage_load.php",
	         {type: "GET",
	         dataType: "json",
           cache: false,
	         success: function (data, textStatus, jqXHR) {
              fn.append("<div>" + data["firstname"] + " " + data["lastname"] + "</div>" + "<br>");
              un.append("<div>" + data["username"] + "</div>" + "<br>");
              bal.append("<h4>"+ "$ " + data["balance"] + "</h4>");
	         }
	         });
};

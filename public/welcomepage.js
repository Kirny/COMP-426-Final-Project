$(document).ready(function () {
    fetch_userInfo();

    $('#profilepic-form').on('submit', function (e) {
    	e.stopPropagation();
    	e.preventDefault();
    	$.ajax('../upload.php',
    	       {type: 'GET',
            	data: $('#profilepic-form').serialize(),
            	cache: false,
            	success: function () {
                  alert("profile pic has successfully been changed!");
              },
            	error: function () {
            		  alert('Incorrect Url or incorrect format!');}
    	        });
    });
});

var fetch_userInfo = function () {
    var fn = $('#fullname');
    var un = $('#username');
    var bal = $('#balance');
    var acc = $('#accounts');
    $.ajax("../welcomepage_load.php",
	         {type: "GET",
	         dataType: "json",
           cache: false,
	         success: function (data, textStatus, jqXHR) {
              fn.append("<div>" + data[0]["firstname"] + " " + data[0]["lastname"] + "</div>" + "<br>");
              un.append("<div>" + data[0]["username"] + "</div>" + "<br>");
              bal.append("<h4>"+ "$ " + data[0]["balance"] + "</h4>");

              $('#default').append("<td>" + "<h4> DEFAULT </h4>" + "</td>"
                        + "<td>" + "$ " + data[0]["balance"] + "</td>");

              for(i = 0; i < data[1].length; i++){
              var index = i + 1;
              acc.append("<tr>" + "<td>" + "<h4> ACCOUNT #" + index + "</h4>" + "</td>"
                        + "<td>" + "$ " + data[1][i]["balance"] + "</td>" + "</tr>");
              }
	         }
	         });
};

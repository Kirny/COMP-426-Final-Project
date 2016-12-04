$(document).ready(function () {
    fetch_userInfo();
});

var fetch_userInfo = function () {
    var bal = $('#balance');
    var acc = $('#accounts');
    $.ajax("../transfer_load.php",
	         {type: "GET",
	         dataType: "json",
           cache: false,
	         success: function (data, textStatus, jqXHR) {
              bal.append("<h4>"+ "$ " + data[0]["balance"] + "</h4>");

              $('.default-acc').append("<td>" + "<h4> DEFAULT </h4>" + "</td>"
                        + "<td>" + "$ " + data[0]["balance"] + "</td>");

              for(i = 0; i < data[1].length; i++){
              var index = i + 1;
              acc.append("<tr>" + "<td>" + "<h4> ACCOUNT #" + index + "</h4>" + "</td>"
                        + "<td>" + "$ " + data[1][i]["balance"] + "</td>" + "</tr>");
              }
              $('#confirm').on('click', function(){
                 location.href = "welcomepage.php";
              });
	         }
    });

};

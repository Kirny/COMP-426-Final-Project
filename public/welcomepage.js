$(document).ready(function () {
    fetch_userInfo();
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
              var one_acc = false;
              fn.append("<div>" + data[0]["firstname"] + " " + data[0]["lastname"] + "</div>" + "<br>");
              un.append("<div>" + data[0]["username"] + "</div>" + "<br>");
              bal.append("<h4>"+ "$ " + data[0]["balance"] + "</h4>");

              $('#default').append("<td>" + "<h4> DEFAULT </h4>" + "</td>"
                        + "<td>" + "$ " + data[0]["balance"] + "</td>");
              if(data[1] != undefined){
                  for(i = 0; i < data[1].length; i++){
                  var index = i + 1;
                  acc.append("<tr>" + "<td>" + "<h4> ACCOUNT #" + index + "</h4>" + "</td>"
                            + "<td>" + "$ " + data[1][i]["balance"] + "</td>" + "</tr>");
                  }
              }else{
                one_acc = true;
              }
              $('#transfer').on('click', function(){
                  if(!one_acc){
                    location.href = "transfer.php";
                  }
                  else{
                    alert("Cannot transfer with the default account only");
                  }
              });
	         }
    });

};

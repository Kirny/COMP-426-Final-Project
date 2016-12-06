$(document).ready(function () {
    fetch_info();
    $('#from tr').on('click', function(){
         $('#from tr').removeClass('selected');
         $(this).addClass('selected');
         $('#to tr').on('click', function(){
            $('#to tr').removeClass('selected');
            $(this).addClass('selected');
         });
    });
    $('#confirm').on('click', function(){
       location.href = "welcomepage.php";
    });
});

var fetch_info = function () {
    var def = $('.default-acc');
    var from = $('#from');
    var to = $('#to');
    $.ajax("../transfer_load.php",
	         {type: "GET",
	         dataType: "json",
           cache: false,
	         success: function (data, textStatus, jqXHR) {
              def.append("<td>" + "<h4> DEFAULT </h4>" + "</td>"
                        + "<td>" + "$ " + data[0]["balance"] + "</td>");

              for(i = 0; i < data[1].length; i++){
              var index = i + 1;
              from.append("<tr id='from-" +index+ "'>" + "<td>" + "<h4> ACCOUNT #" + index + "</h4>" + "</td>"
                        + "<td>" + "$ " + data[1][i]["balance"] + "</td>" + "</tr>");
              to.append("<tr id='to-" +index+ "'>" + "<td>" + "<h4> ACCOUNT #" + index + "</h4>" + "</td>"
                        + "<td>" + "$ " + data[1][i]["balance"] + "</td>" + "</tr>");
              }
	         }
    });

  };

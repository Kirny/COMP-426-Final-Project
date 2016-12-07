$(document).ready(function () {
    $('#transfer-line').hide();
    fetch_info();
    $('#cancel').on('click', function(){
       location.href = "welcomepage.php";
    });
});

var Account = function(account_json) {
    this.id = account_json.id;
    this.balance = account_json.balance;
    this.user_id = account_json.user_id;
};

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
              selection();
	         }
           });

};

var selection = function() {
    $('#from tr').on('click', function(e){
         $('#from tr').removeClass('selected');
         $(this).addClass('selected');
         $('#to tr').on('click', function(e){
              $('#to tr').removeClass('selected');
              $(this).addClass('selected');
              $('#transfer-line').show();
              var from_row = $('#from tr.selected').attr('id'); //from-def, from-1 ..
              var from_index = (from_row.charAt(from_row.length - 1)) == 'f' ?  //0, 1, 2 ..
                                0 : parseInt(from_row.charAt(from_row.length - 1));
              var to_row = $('#to tr.selected').attr('id');
              var to_index = (to_row.charAt(to_row.length - 1)) == 'f' ?
                                0 : parseInt(to_row.charAt(to_row.length - 1));
              $.ajax("../transfer_load.php",
          	         {type: "GET",
          	         dataType: "json",
                     cache: false,
          	         success: function (data, textStatus, jqXHR) {
                        var from_id = from_index == 0 ?         //default chosen?
                                  data[0]["default_acc"] : data[1][from_index - 1]["id"];
                        var to_id = to_index == 0 ?
                                data[0]["default_acc"] : data[1][to_index - 1]["id"];
                        $.ajax("../account_ctrl.php/" + from_id,
                                {type: "GET",
                                dataType: "json",
                                success: function(account_json, status, jqXHR){
                                    from_acc = new Account(account_json);
                                    $.ajax("../account_ctrl.php/" + to_id,
                                            {type: "GET",
                                            dataType: "json",
                                            success: function(account_json, status, jqXHR){
                                                to_acc = new Account(account_json);
                                                $('#confirm').on('click', function (){
                                                    var amount = $('#transfer-amt').val();
                                                    if(amount != ""){
                                                      if(amount < 0){
                                                        alert("Negative amount not allowed");
                                                        return;
                                                      }
                                                      $.ajax("../account_ctrl.php/" + from_id,
                                                           {type: "POST",
                                                           dataType: "json",
                                                           data: {'id': from_id,
                                                                  'balance': parseFloat(from_acc.balance) - parseFloat(amount)},
                                                           success: function(account_json, textStatus, jqXHR){
                                                                from_acc.balance -= parseFloat(amount);
                                                                console.log(account_json);
                                                           },
                                                           error: function(jqXHR, status, error){
                                                                alert(jqXHR.responseText);
                                                      }});
                                                      $.ajax("../account_ctrl.php/" + to_id,
                                                           {type: "POST",
                                                           dataType: "json",
                                                           data: { 'id': to_id,
                                                                  'balance': parseFloat(to_acc.balance) + parseFloat(amount)},
                                                           success: function(account_json, textStatus, jqXHR){
                                                                to_acc.balance += parseFloat(amount);
                                                                console.log(account_json);
                                                           },
                                                           error: function(jqXHR, status, error){
                                                                alert(jqXHR.responseText);
                                                      }});
                                                    }
                                                    //location.href = "welcomepage.php";
                                                }); //"Transfer Now"
                                            }
                                    });
                                }
                        });

          	         }//1st success
             }); //ajax ends
         });
    });
};

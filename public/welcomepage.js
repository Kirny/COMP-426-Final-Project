var url_base = "https://wwwp.cs.unc.edu/Courses/comp426-f16/users/dyj/ProjectArea";
var user_default_balance;
var receiver_default_balance;

$(document).ready(function () {
    fetch_userInfo();

    $('#profilepic-form').on('submit', function (e) {
    	e.stopPropagation();
    	e.preventDefault();
    	$.ajax('../upload.php',
    	       {type: 'GET',
            	data: $('#profilepic-form').serialize(),
            	cache: false,
            	success: function (data) {
                  alert("profile pic has successfully been changed!");
                  $('#profilepic').attr("src", data.pictureURL);
              },
            	error: function () {
            		  alert('Incorrect Url or incorrect format!');}
    	});
    });

    $('#add_account').on('click', function (e) {
      $.ajax(url_base + '/account_ctrl.php/',
    	       {type: 'POST',
              data:{},
            	cache: false,
            	success: function (data) {
                  alert("Successfully created an account");
                  $('#fullname div').remove();
                  $('#username div').remove();
                  $('#balance h4').remove();
                  $('#default').empty();
                  $('#default td').remove();
                  $('#default ~ tr').remove();
                  $('#contact-list').empty();
                  $('#contact-list li').remove();
                  fetch_userInfo();
              },
            	error: function () {
            		  alert('No more than 5 accounts (excluding DEFAULT) per user is allowed');
              }
    	});
    });

     $('[data-toggle="tooltip"]').tooltip();

     $("#send-transaction").on("click", function(e) {
       e.stopPropagation();
       //alert(user_default_balance);
       //alert(receiver_default_balance);
       /* This is the ajax call juts commented out for you
       $.ajax('../whatever.php',
     	       {type: 'POST',
              data:{"user-default-account-balance" : user_default_balance,
                    "reciever-default-account-balance" : receiver_default_balance},
             	cache: false,
             	success: function (data) {
                   alert("Money Sent!");
                   $.modal.close();
               },
             	error: function () {
             		  alert('Insufficient Funds');
               }
     	});
      */
     });
}); //$(document).ready ends

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
              fn.append("<div>" + data[0]["firstname"] + " " + data[0]["lastname"] + "</div>");
              un.append("<div>" + data[0]["username"] + "</div>");
              bal.append("<h4>"+ "$ " + data[0]["balance"] + "</h4>");

              $('#default').append("<td>" + "<h4> DEFAULT </h4>" + "</td>"
                        + "<td>" + "$ " + data[0]["balance"] + "</td>");

              user_default_balance = data[0]["balance"];

              $('#profilepic').attr("src", data[0]["profilepic_url"]);

              if(data[1] != undefined){
                  for(i = 0; i < data[1].length; i++){
                  var index = i + 1;
                  acc.append("<tr id='row" + index + "'>"  + "<td>" + "<span id='X" + index + "' class='glyphicon glyphicon-remove'></span>"
                            + "<h4> ACCOUNT #" + index + "</h4>" + "</td>"
                            + "<td>" + "$ " + data[1][i]["balance"] + "</td>" + "</tr>");
                  $('X' + index).data("acc_id", data[1][i]["accountID"]);
                  }
              }else{
                one_acc = true;
              }
              $('span').on('click', function(e){
                   var acc_id = $.data(this, "acc_id");
                   alert("acc_id is " + acc_id);
                   $.ajax(url_base + '/account_ctrl.php/' + acc_id + '?delete',
                         {type: 'GET',
                          data: {},
                          cache: false,
                          success: function() {
                              alert("X clicked");
                              $('#fullname div').remove();
                              $('#username div').remove();
                              $('#balance h4').remove();
                              $('#default').empty();
                              $('#default td').remove();
                              $('#default ~ tr').remove();
                              $('#contact-list').empty();
                              $('#contact-list li').remove();
                              fetch_userInfo();
                          },
                          error: function() {
                               alert("Delete failure");
                          }
                   });
              });
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


    $.ajax("../contactlist_load.php",
           {type: "GET",
            dataType: "json",
            cache: false,
            success: function (data) {
              var size = Object.keys(data).length;
              var firstname;
              var lastname;
              var username;
              var profilepic_url;
              var default_acc_bal;

              for(i = 0; i < size; i++) {
                firstname = data[i].firstname;
                lastname = data[i].lastname;
                username = data[i].username;
                profilepic_url = data[i].profilepic_url;
                default_acc_bal = data[i].default_acc_bal;
                $("#contact-list").append("<li class=\"list-group-item\" id=\"list" + i + "\">" +
                  "<div class=\"col-xs-12 col-sm-3\">" +
                    "<img src=" + "\"" + profilepic_url + "\"" + "alt=\"Scott Stevens\" class=\"img-responsive img-circle\" />" +
                  "</div>" +
                  "<div class=\"col-xs-12 col-sm-9\">" +
                    "<span class=\"name\">" + firstname + " " + lastname + "</span><br/>" +
                    "<small>" + username + "</small>" +
                    "</div>" +
                    "<div class=\"clearfix\"></div>" +
                  "</li>");

                  $('#list' + i).data("username", username);
                  $('#list' + i).data("firstname", firstname);
                  $('#list' + i).data("lastname", lastname);
                  $('#list' + i).data("default_acc_bal", default_acc_bal);


                  $('#list' + i).on('click', function(e) {
                    $('#transaction-modal h3').text("Transaction to " + $.data(this, "firstname") + " " + $.data(this, "lastname"));
                    receiver_default_balance = $.data(this, "default_acc_bal");
                    $('#transaction-modal').modal();
                  });
              }

            },
            error: function () {
              alert("please reload page something went wrong!");
            }
      });
};

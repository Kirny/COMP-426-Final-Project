$(document).ready(function () {

  $('.login-form').on('submit', function (e) {
  	e.stopPropagation();
  	e.preventDefault();
  	$.ajax('../login.php',
  	       {type: 'GET',
          	data: $('.login-form').serialize(),
          	cache: false,
          	success: function () {
                window.location ='welcomepage.php';
            },
          	error: function () {
          		  alert('Username or Password incorrect');}
  	        });
  });

  $('#register-form').on('submit', function (e) {
    e.stopPropagation();
    e.preventDefault();
    if($('#username_box').val().length < 2 || $('#username_box').val().length > 10) {
      alert("Username must be between 2 to 10 characters");
    } else if($('#password_box').val().length < 5 || $('#password_box').val().length > 12) {
      alert("Password must be between 5 to 12 characters");
    } else {
      $.ajax('../registration.php',
             {type: 'GET',
              data: $('#register-form').serialize(),
              cache: false,
              success: function (data) {
                  if(data.username_exist_flag == 1) {
                    alert("Username Already Exists!");
                  } else {
                    alert('Registration Successful');
                    $.modal.close();
                  }
              },
              error: function () {
                  alert('Something Wrong Occured! Contact the development team.');}
              });
    };
  });
});

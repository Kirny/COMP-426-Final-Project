$(document).ready(function () {

  $('.login-form').on('submit', function (e) {
	e.stopPropagation();
	e.preventDefault();
	$.ajax('../login.php',
	       {type: 'GET',
        	data: $('.login-form').serialize(),
        	cache: false,
        	success: function () {
        		  alert('Login Successful');
              window.location ='welcomepage.html';
          },
        	error: function () {
        		  alert('Username or Password incorrect');}
	        });
  });

  $('.register-form').on('submit', function (e) {
	e.stopPropagation();
	e.preventDefault();
	$.ajax('../login.php',
	       {type: 'GET',
        	data: $('.login-form').serialize(),
        	cache: false,
        	success: function () {
        		  alert('Login Successful');
              window.location ='welcomepage.html';
          },
        	error: function () {
        		  alert('Username or Password incorrect');}
	        });
  });
});

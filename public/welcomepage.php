<?php
  session_start();
  require_once('../authenticate.php');
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Welcome Page</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../css/jquery.modal.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="welcomepage.js"></script>
  <script src="jquery.modal.js"></script>
  <style>
    /* Remove the navbar's default margin-bottom and rounded borders */
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }

    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content {height: 450px}

    /* Set gray background color and 100% height */
    .sidenav {
      padding-top: 20px;
      background-color: #f1f1f1;
      height: 100%;
    }

    /* Set black background color, white text and some padding */
    footer {
      background-color: #555;
      color: white;
      padding: 15px;
    }

    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height:auto;}
    }
  </style>
  <link rel="stylesheet" type="text/css" href="../css/welcomepage.css">
</head>
<body>

<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <img class="navbar-brand" src="img/brand.jpg" alt="brand" width="62" height="300">
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">

      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="../logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>

<!--
<div id="transaction-modal" class="modal">
  <input id="transaction-amt" type="number" length="6">
  <button id="send-transaction"> Send! </button>
</div>
-->

<form id="transaction-modal" class="modal">
  <h3> </h3>
  <input id="transaction-amt" type="number" length="6">
  <button id="send-transaction"> Send! </button>
</form>

<div class="container-fluid text-center">
  <div class="row content">
    <div class="col-sm-3">
      <img id ="profilepic" src="">
      <form id = "profilepic-form" action="../upload.php" method="post" enctype="multipart/form-data">
        <input type="text" name="pictureURL" id="fileToUpload" placeholder="URL to your picture">
        <button type="submit">Upload</button>
      </form>
    <br><br>
	  <div id="fullname"> <strong>Name</strong> : </div>
    <br>
    <div id="username"> <strong>Username: </strong></div>
    <br>
	  <div id="balance"> <strong>Default Account Balance : </strong></div>
    </div>
    <div class="col-sm-6">
      <h1>Welcome to Bank of Carolina</h1>
      <hr>
      <br>
      <h3>Your Account(s)</h3>
      <div id="accounts-box">
          <table id="accounts" cellpadding="5" cellspacing="10">
              <tr id="default"> </tr>
          </table>
      </div>
      <div>
        <br>
        <button id="add_account">Add Account</button>
        <button id="transfer">Transfer </button>
      </div>
    </div>
	<!-- From here is the contact stuff -->

	<div class="row col-sm-3">
            <div class="panel panel-default">
                <div class="panel-heading c-list">
                    <span class="title">Contacts</span>
                      <!--
                    <ul class="pull-right c-controls">

                        <li><a href="#cant-do-all-the-work-for-you" data-toggle="tooltip" data-placement="top" title="Add Contact"><i class="glyphicon glyphicon-plus"></i></a></li>
                        <li><a href="#" class="hide-search" data-command="toggle-search" data-toggle="tooltip" data-placement="top" title="Toggle Search"><i class="fa fa-ellipsis-v"></i></a></li>

                    </ul>
                      -->
                </div>

                <div class="row" style="display: none;">
                    <div class="col-xs-12">
                        <div class="input-group c-search">
                            <input type="text" class="form-control" id="contact-list-search">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search text-muted"></span></button>
                            </span>
                        </div>
                    </div>
                </div>

                <ul class="list-group" id="contact-list">

                </ul>
            </div>
	</div>

	<!-- End of contact stuff -->
  </div>
</div>

<footer class="container-fluid text-center navbar-fixed-bottom">
  <p>Copyright Felix INC</p>
</footer>

</body>
</html>

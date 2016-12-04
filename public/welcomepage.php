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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="welcomepage.js"></script>
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
      <img class="navbar-brand" src="img/brand.jpg" alt="brand" width="80" height="300">
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

<div class="container-fluid text-center">
  <div class="row content">
    <div class="col-sm-3">
      <img id ="profilepic" src="img/kmp.jpg">
      <form id = "profilepic-form" action="../upload.php" method="post" enctype="multipart/form-data">
        <input type="text" name="pictureURL" id="fileToUpload" placeholder="Url to your picture">
        <button type="submit">Upload</button>
      </form>
    <br><br>
	  <div id="fullname"> <strong>Name</strong> : </div>
    <div id="username"> <strong>Username: </strong></div>
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
    </div>
	<!-- From here is the contact stuff -->

	<div class="row col-sm-3">
            <div class="panel panel-default">
                <div class="panel-heading c-list">
                    <span class="title">Contacts</span>
                    <ul class="pull-right c-controls">
                        <li><a href="#cant-do-all-the-work-for-you" data-toggle="tooltip" data-placement="top" title="Add Contact"><i class="glyphicon glyphicon-plus"></i></a></li>
                        <li><a href="#" class="hide-search" data-command="toggle-search" data-toggle="tooltip" data-placement="top" title="Toggle Search"><i class="fa fa-ellipsis-v"></i></a></li>
                    </ul>
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
                    <li class="list-group-item">
                        <div class="col-xs-12 col-sm-3">
                            <img src="http://api.randomuser.me/portraits/men/49.jpg" alt="Scott Stevens" class="img-responsive img-circle" />
                        </div>
                        <div class="col-xs-12 col-sm-9">
                            <span class="name">Scott Stevens</span><br/>
                            <span class="glyphicon glyphicon-map-marker text-muted c-info" data-toggle="tooltip" title="5842 Hillcrest Rd"></span>
                            <span class="visible-xs"> <span class="text-muted">5842 Hillcrest Rd</span><br/></span>
                            <span class="glyphicon glyphicon-earphone text-muted c-info" data-toggle="tooltip" title="(870) 288-4149"></span>
                            <span class="visible-xs"> <span class="text-muted">(870) 288-4149</span><br/></span>
                            <span class="fa fa-comments text-muted c-info" data-toggle="tooltip" title="scott.stevens@example.com"></span>
                            <span class="visible-xs"> <span class="text-muted">scott.stevens@example.com</span><br/></span>
                        </div>
                        <div class="clearfix"></div>
                    </li>
                    <li class="list-group-item">
                        <div class="col-xs-12 col-sm-3">
                            <img src="http://api.randomuser.me/portraits/men/97.jpg" alt="Seth Frazier" class="img-responsive img-circle" />
                        </div>
                        <div class="col-xs-12 col-sm-9">
                            <span class="name">Seth Frazier</span><br/>
                            <span class="glyphicon glyphicon-map-marker text-muted c-info" data-toggle="tooltip" title="7396 E North St"></span>
                            <span class="visible-xs"> <span class="text-muted">7396 E North St</span><br/></span>
                            <span class="glyphicon glyphicon-earphone text-muted c-info" data-toggle="tooltip" title="(560) 180-4143"></span>
                            <span class="visible-xs"> <span class="text-muted">(560) 180-4143</span><br/></span>
                            <span class="fa fa-comments text-muted c-info" data-toggle="tooltip" title="seth.frazier@example.com"></span>
                            <span class="visible-xs"> <span class="text-muted">seth.frazier@example.com</span><br/></span>
                        </div>
                        <div class="clearfix"></div>
                    </li>
                    <li class="list-group-item">
                        <div class="col-xs-12 col-sm-3">
                            <img src="http://api.randomuser.me/portraits/women/90.jpg" alt="Jean Myers" class="img-responsive img-circle" />
                        </div>
                        <div class="col-xs-12 col-sm-9">
                            <span class="name">Jean Myers</span><br/>
                            <span class="glyphicon glyphicon-map-marker text-muted c-info" data-toggle="tooltip" title="4949 W Dallas St"></span>
                            <span class="visible-xs"> <span class="text-muted">4949 W Dallas St</span><br/></span>
                            <span class="glyphicon glyphicon-earphone text-muted c-info" data-toggle="tooltip" title="(477) 792-2822"></span>
                            <span class="visible-xs"> <span class="text-muted">(477) 792-2822</span><br/></span>
                            <span class="fa fa-comments text-muted c-info" data-toggle="tooltip" title="jean.myers@example.com"></span>
                            <span class="visible-xs"> <span class="text-muted">jean.myers@example.com</span><br/></span>
                        </div>
                        <div class="clearfix"></div>
                    </li>
                    <li class="list-group-item">
                        <div class="col-xs-12 col-sm-3">
                            <img src="http://api.randomuser.me/portraits/men/24.jpg" alt="Todd Shelton" class="img-responsive img-circle" />
                        </div>
                        <div class="col-xs-12 col-sm-9">
                            <span class="name">Todd Shelton</span><br/>
                            <span class="glyphicon glyphicon-map-marker text-muted c-info" data-toggle="tooltip" title="5133 Pecan Acres Ln"></span>
                            <span class="visible-xs"> <span class="text-muted">5133 Pecan Acres Ln</span><br/></span>
                            <span class="glyphicon glyphicon-earphone text-muted c-info" data-toggle="tooltip" title="(522) 991-3367"></span>
                            <span class="visible-xs"> <span class="text-muted">(522) 991-3367</span><br/></span>
                            <span class="fa fa-comments text-muted c-info" data-toggle="tooltip" title="todd.shelton@example.com"></span>
                            <span class="visible-xs"> <span class="text-muted">todd.shelton@example.com</span><br/></span>
                        </div>
                        <div class="clearfix"></div>
                    </li>
                    <li class="list-group-item">
                        <div class="col-xs-12 col-sm-3">
                            <img src="http://api.randomuser.me/portraits/women/34.jpg" alt="Rosemary Porter" class="img-responsive img-circle" />
                        </div>
                        <div class="col-xs-12 col-sm-9">
                            <span class="name">Rosemary Porter</span><br/>
                            <span class="glyphicon glyphicon-map-marker text-muted c-info" data-toggle="tooltip" title="5267 Cackson St"></span>
                            <span class="visible-xs"> <span class="text-muted">5267 Cackson St</span><br/></span>
                            <span class="glyphicon glyphicon-earphone text-muted c-info" data-toggle="tooltip" title="(497) 160-9776"></span>
                            <span class="visible-xs"> <span class="text-muted">(497) 160-9776</span><br/></span>
                            <span class="fa fa-comments text-muted c-info" data-toggle="tooltip" title="rosemary.porter@example.com"></span>
                            <span class="visible-xs"> <span class="text-muted">rosemary.porter@example.com</span><br/></span>
                        </div>
                        <div class="clearfix"></div>
                    </li>
                    <li class="list-group-item">
                        <div class="col-xs-12 col-sm-3">
                            <img src="http://api.randomuser.me/portraits/women/56.jpg" alt="Debbie Schmidt" class="img-responsive img-circle" />
                        </div>
                        <div class="col-xs-12 col-sm-9">
                            <span class="name">Debbie Schmidt</span><br/>
                            <span class="glyphicon glyphicon-map-marker text-muted c-info" data-toggle="tooltip" title="3903 W Alexander Rd"></span>
                            <span class="visible-xs"> <span class="text-muted">3903 W Alexander Rd</span><br/></span>
                            <span class="glyphicon glyphicon-earphone text-muted c-info" data-toggle="tooltip" title="(867) 322-1852"></span>
                            <span class="visible-xs"> <span class="text-muted">(867) 322-1852</span><br/></span>
                            <span class="fa fa-comments text-muted c-info" data-toggle="tooltip" title="debbie.schmidt@example.com"></span>
                            <span class="visible-xs"> <span class="text-muted">debbie.schmidt@example.com</span><br/></span>
                        </div>
                        <div class="clearfix"></div>
                    </li>
                    <li class="list-group-item">
                        <div class="col-xs-12 col-sm-3">
                            <img src="http://api.randomuser.me/portraits/women/76.jpg" alt="Glenda Patterson" class="img-responsive img-circle" />
                        </div>
                        <div class="col-xs-12 col-sm-9">
                            <span class="name">Glenda Patterson</span><br/>
                            <span class="glyphicon glyphicon-map-marker text-muted c-info" data-toggle="tooltip" title="5020 Poplar Dr"></span>
                            <span class="visible-xs"> <span class="text-muted">5020 Poplar Dr</span><br/></span>
                            <span class="glyphicon glyphicon-earphone text-muted c-info" data-toggle="tooltip" title="(538) 718-7548"></span>
                            <span class="visible-xs"> <span class="text-muted">(538) 718-7548</span><br/></span>
                            <span class="fa fa-comments text-muted c-info" data-toggle="tooltip" title="glenda.patterson@example.com"></span>
                            <span class="visible-xs"> <span class="text-muted">glenda.patterson@example.com</span><br/></span>
                        </div>
                        <div class="clearfix"></div>
                    </li>
                </ul>
            </div>
	</div>

    <div id="cant-do-all-the-work-for-you" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="mySmallModalLabel">Ooops!!!</h4>
                </div>
                <div class="modal-body">
                    <p>I am being lazy and do not want to program an "Add User" section into this snippet... So it looks like you'll have to do that for yourself.</p><br/>
                    <p><strong>Sorry<br/>
                    ~ Mouse0270</strong></p>
                </div>
            </div>
        </div>
    </div>

	<!-- End of contact stuff -->
  </div>
</div>

<footer class="container-fluid text-center">
  <p>Copyright Felix INC</p>
</footer>

</body>
</html>

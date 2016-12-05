<?php
  session_start();
  require_once('../authenticate.php');
 ?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
   <title>Transfer</title>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
   <script src="transfer.js"></script>
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
   <link rel="stylesheet" type="text/css" href="../css/transfer.css">
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
    <h1> Transfer </h1>
    <br> <br>
    <div id="transfer-box">
        <div id="from-box">
          <h3>From </h3>
          <table id="from" class="acc-display" cellpadding="5" cellspacing="10">
              <tr class="default-acc"> </tr>
          </table>
        </div>
        <div id="to-box">
          <h3>To </h3>
          <table id="to" class="acc-display" cellpadding="5" cellspacing="10">
              <tr class="default-acc"> </tr>
          </table>
        </div>
        <br><br><br><br>
        <div id="arrow">
            <h1> &#8658;</h1>
        </div>
    </div>
 </div>
 <br>
 <div>
    <button id="confirm"> Transfer Now! </button>
 </div>
 <br><br><br><br>
 <footer class="container-fluid text-center">
   <p>Copyright Felix INC</p>
 </footer>

 </body>
 </html>

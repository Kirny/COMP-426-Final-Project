<?php
session_start();
require_once('authenticate.php');
?>

<!DOCTYPE html>

<html>
<head>
  <link rel="stylesheet" type="text/css" href="transaction.css">
</head>
<body>
  <div class="history">
    <span class="history-header">History of Transactions between You and Guy</span>
    <br>
    <br>
    <table class="table table-hover" id="dev-table">
      <thead>
        <tr>
          <th> (+/-)  </th>
          <th>Amount($) </th>
          <th>Date</th>
          <th>Time</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th> + </th>
          <td>500.00</td>
          <td>10/31/16</td>
          <td>5:14 PM</td>
        </tr>
        <tr>
          <td> - </th>
          <td>34.75 </td>
          <td>10/30/16 </td>
          <td>3:25 PM </td>
        </tr>
        <tr>
          <td> - </th>
          <td>9.10 </td>
          <td>10/30/16 </td>
          <td>8:32 PM </td>
        </tr>
        <tr>
          <td> + </th>
          <td>84.99 </td>
          <td>10/29/16 </td>
          <td>11:47 AM</td>
        </tr>
      </tbody>
    </table>
  </div>
  <div class="container">
      <div class="row profile">
  		<div class="col-md-3">
  			<div class="profile-sidebar">
  				<!-- SIDEBAR USERPIC -->
  				<div class="profile-userpic">
  					<img src="http://img08.deviantart.net/5895/i/2010/096/9/5/random_guy_from_the_internet_by_mygreenglasses.jpg" class="img-responsive" alt="">
  				</div>
  				<!-- END SIDEBAR USERPIC -->
  				<!-- SIDEBAR USER TITLE -->
  				<div class="profile-usertitle">
  					<div class="profile-usertitle-name">
  						Random Guy
  					</div>
  					<div class="profile-usertitle-job">
  						Student
  					</div>
  				</div>
  				<!-- END SIDEBAR USER TITLE -->
  				<!-- SIDEBAR BUTTONS -->
  				<div class="profile-userbuttons">
  					<button type="button" class="btn btn-success btn-sm">Loan</button>
  					<button type="button" class="btn btn-danger btn-sm">Transfer</button>
  				</div>
  				<!-- END SIDEBAR BUTTONS -->
  				<!-- SIDEBAR MENU -->
  				<div class="profile-usermenu">
  					<ul class="nav">

  					</ul>
  				</div>
  				<!-- END MENU -->

  		</div>
  		<div class="col-md-9">
              <div class="profile-content">
                    Amount to loan/transfer: $ 1,000.00
              <br>
              <br>
            			  Amount Balance: $  999,999.99
              <br>
              <br>
              <br>
                    Balance Remaining: $  998,999.99
              </div>
  		</div>
      </div>
  	</div>
  </div>
</body>
<html>

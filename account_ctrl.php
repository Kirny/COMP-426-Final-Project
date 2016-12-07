<?php
session_start();
$username = $_SESSION['username'];
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'database.php';
require_once('orm/Account.php');

$path_components = explode('/', $_SERVER['PATH_INFO']);

$conn = new mysqli($hn, $usr, $pw, $db);

$user_id = 0;
$sql = "SELECT id FROM User WHERE username = '$username'";
$result = mysqli_query($conn, $sql);
if($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $user_id = $row['id'];
}else{
  echo "Query returned with no data on " . $user_id . ".";
}

$acc_count = 0;
$sql2 = "SELECT COUNT(*) FROM Account INNER JOIN User ON Account.user_id = User.id
        WHERE User.username = '$username'";
$result2 = mysqli_query($conn, $sql2);
if($result2->num_rows > 0){
  $row2 = $result2->fetch_row();
  $acc_count = $row2[0] - 1;    //Exclude the default account
}else{
  echo "Query returned with no data on " . $acc_count . ".";
}

// Note that since extra path info starts with '/'
// First element of path_components is always defined and always empty.

if ($_SERVER['REQUEST_METHOD'] == "GET") {
  // GET means either instance look up, index generation, or deletion

  // Following matches instance URL in form
  // /account_ctrl.php/<id>
  if ((count($path_components) >= 2) &&
      ($path_components[1] != "")) {

    // Interpret <id> as integer
    $account_id = intval($path_components[1]);

    // Look up object via ORM
    $account = Account::findByID($account_id);

    if ($account == null) {
      // account not found.
      header("HTTP/1.0 404 Not Found");
      print("Account id: " . $account_id . " not found.");
      exit();
    }

    // Check to see if deleting
    if (isset($_REQUEST['delete'])) {
      $account->delete();
      header("Content-type: application/json");
      print(json_encode(true));
      exit();
    }

    // Normal lookup.
    // Generate JSON encoding as response
    header("Content-type: application/json");
    print($account->getJSON());
    exit();
  }

  // ID not specified, then must be asking for index
  header("Content-type: application/json");
  print(json_encode(Account::getAllIDs()));
  exit();

} else if ($_SERVER['REQUEST_METHOD'] == "POST") {

  // Either creating or updating

  // Following matches /account_ctrl.php/<id> form
  if ((count($path_components) >= 2) &&
      ($path_components[1] != "")) {

    //Interpret <id> as integer and look up via ORM
    $account_id = intval($path_components[1]);
    $account = Account::findByID($account_id);

    if ($account == null) {
      // account not found.
      header("HTTP/1.0 404 Not Found");
      print("Account id: " . $account_id . " not found while attempting update.");
      exit();
    }

    // Validate values
    $new_balance = false;
    if (isset($_REQUEST['balance'])) {
      $new_balance = floatval($_REQUEST['balance']);
      if ($new_balance < 0) {
    	header("HTTP/1.0 400 Bad Request");
    	print("Cannot have a negative balance.");
    	exit();
      }
    }

    // Update via ORM
    if ($new_balance != false) {
      $account->setBalance($new_balance);
    }

    // Return JSON encoding of updated Account
    header("Content-type: application/json");
    print($account->getJSON());
    exit();
  } else {

    // Creating a new Account item

    // Validate values
     $balance = floatval(0);
     /* if (isset($_REQUEST['balance'])) {
      $balance = floatval($_REQUEST['balance']);
      if ($balance < 0) {
        	header("HTTP/1.0 400 Bad Request");
        	print("Priority value out of range");
        	exit();
      }
    } */
    if($acc_count >= 5){
        header("HTTP/1.0 400 Bad Request");
        print("No more than 5 accounts (excluding DEFAULT) per user is allowed");
        exit();
    }

    // Create new Account via ORM
    $new_account = Account::create($balance, $user_id);

    // Report if failed
    if ($new_account == null) {
      header("HTTP/1.0 500 Server Error");
      print("Server couldn't create new account.");
      exit();
    }

    //Generate JSON encoding of new Account
    header("Content-type: application/json");
    print($new_account->getJSON());
    exit();
  }
}

// If here, none of the above applied and URL could
// not be interpreted with respect to RESTful conventions.

header("HTTP/1.0 400 Bad Request");
print("Did not understand URL");

 ?>

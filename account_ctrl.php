<?php
//session_start();
require_once('orm/Account.php');

$path_components = explode('/', $_SERVER['PATH_INFO']);

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
      $new_balance = intval($_REQUEST['balance']);
      if ($new_balance < 0)) {
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
    $balance = 0;
    if (isset($_REQUEST['balance'])) {
      $balance = intval($_REQUEST['balance']);
      if ($balance < 0) {
        	header("HTTP/1.0 400 Bad Request");
        	print("Priority value out of range");
        	exit();
      }
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

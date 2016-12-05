<?php

$username_exist_flag = 0;

function register_user($firstname, $lastname, $username, $password) {

  include 'database.php';

  $conn = new mysqli($hn, $usr, $pw, $db);

  $sql = "SELECT * FROM User WHERE username = '$username'";

  $result = mysqli_query($conn, $sql);

  if($result->num_rows > 0) {
    global $username_exist_flag;
    $username_exist_flag = 1;
    return true;
  }


  $sql = "INSERT INTO User VALUES (NULL, '$firstname', '$lastname', '$username', '$password', NULL, DEFAULT)";

  $user_id = 0;

  if($conn->query($sql) === FALSE) {
    return false;
  } else {
    $user_id = $conn->insert_id;
  }

  $account_id = 0;

  $sql = "INSERT INTO Account VALUES (NULL, '100.00', '$user_id')";

  if($conn->query($sql) === FALSE) {
    return false;
  } else {
    $account_id = $conn->insert_id;
  }

  $sql = "UPDATE User SET default_acc=$account_id WHERE id=$user_id";

  if($conn->query($sql) === FALSE) {
    return false;
  }

  return true;
}

$firstname = $_GET['firstname'];
$lastname = $_GET['lastname'];
$username = $_GET['username'];
$password = md5($_GET['password']);

if(register_user($firstname, $lastname, $username, $password)) {
  header('Content-type: application/json');
  print("{\"username_exist_flag\":$username_exist_flag}");
} else {
  header('HTTP/1.1 401 Unauthorized');
  header('Content-type: application/json');
  print(json_encode(false));
}
?>

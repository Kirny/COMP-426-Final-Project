<?php

session_start();

function check_password($username, $password) {

  include 'database.php';

  $conn = new mysqli($hn, $usr, $pw, $db);

  $sql = "SELECT password FROM User WHERE username = '$username'";

  $result = mysqli_query($conn, $sql);

  if($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if(md5($password) == $row["password"]) {
      return true;
    }
  }

  return false;
}

$username = $_GET['username'];
$password = $_GET['password'];

if (check_password($username, $password)) {
  header('Content-type: application/json');

  // Generate authorization cookie
  $_SESSION['username'] = $username;
  $_SESSION['authsalt'] = time();

  $auth_cookie_val = md5($_SESSION['username'] . $_SERVER['REMOTE_ADDR'] . $_SESSION['authsalt']);

  setcookie('BANKAUTH', $auth_cookie_val, 0, '/Courses/comp426-f16/users/'. $username .'/ProjectArea', 'wwwp.cs.unc.edu', true); //ProjectArea can be changed.

  print(json_encode(true));

} else {
  unset($_SESSION['username']);
  unset($_SESSION['authsalt']);

  header('HTTP/1.1 401 Unauthorized');
  header('Content-type: application/json');
  print(json_encode(false));
}
?>

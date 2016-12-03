<?php

function register_user($firstname, $lastname, $username, $password) {

  include 'database.php';

  $conn = new mysqli($hn, $usr, $pw, $db);

  $sql = "INSERT INTO User VALUES (NULL, '$firstname', '$lastname', '$username', '$password', '1')";

  $result = mysqli_query($conn, $sql);

  if($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    if(md5($password) == $row["password"]) {
      return true;
    }
  }

  return false;
}

$firstname = $_GET['firstname'];
$lastname = $_GET['lastname'];
$username = $_GET['username'];
$password = md5($_GET['password']);

if (register_user($firstname, $lastname, $username, $password)) {
  header('Content-type: application/json');
  print(json_encode(true));
} else {
  header('HTTP/1.1 401 Unauthorized');
  header('Content-type: application/json');
  print(json_encode(false));
}
?>

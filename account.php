<?php
  session_start();

  $username = $_SESSION["username"];

  include 'database.php';

  $conn = new mysqli($hn, $usr, $pw, $db);

  $sql = "SELECT id FROM User WHERE username = '$username'";

  $user_id = 0;

  $result = mysqli_query($conn, $sql);

  //expect only one entry, since every user has exactly one default account
  if($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $user_id = $row['id'];
  }else{
    die("something weird happened..");
  }

  $sql = "INSERT INTO Account VALUES (NULL, 0, '$user_id')";

  if($conn->query($sql) === FALSE) {
    header('HTTP/1.1 401 Unauthorized');;
  } 
 ?>

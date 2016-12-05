<?php
  session_start();

  $username = $_SESSION["username"];

  header('Content-type: application/json');

  print("[" . "\n");

  include 'database.php';

  $conn = new mysqli($hn, $usr, $pw, $db);

  $sql = "SELECT firstname, lastname, username, profilepic_url FROM User WHERE username != '$username'";

  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $remainingrows = $result->num_rows;
    while($row = $result->fetch_assoc()) {
      if($remainingrows == 1) {
        print("{");
        print("\"firstname\":" . "\"" . $row["firstname"] . "\"," . " \"lastname\":" . "\"" . $row["lastname"] . "\"," . " \"username\":" . "\"" . $row["username"] . "\"," . " \"profilepic_url\":" . "\"". $row["profilepic_url"] . "\"");
        print("}" . "\n");
      } else {
        print("{");
        print("\"firstname\":" . "\"" . $row["firstname"] . "\"," . " \"lastname\":" . "\"" . $row["lastname"] . "\"," . " \"username\":" . "\"" . $row["username"] . "\"," . " \"profilepic_url\":" . "\"" . $row["profilepic_url"] . "\"");
        print("}," . "\n");
        $remainingrows -= 1;
      }
    }
  } else {
    die("ERROR");
  }

  print("]");

 ?>

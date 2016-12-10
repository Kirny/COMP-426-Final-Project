<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
  session_start();

  $username = $_SESSION["username"];

  header('Content-type: application/json');

  print("[" . "\n");

  include 'database.php';

  $conn = new mysqli($hn, $usr, $pw, $db);

  $sql = "SELECT id, firstname, lastname, username, profilepic_url, default_acc FROM User WHERE username != '$username'";

  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $remainingrows = $result->num_rows;
    while($row = $result->fetch_assoc()) {
      if($remainingrows == 1) {
        print("{");
        print("\"firstname\":" . "\"" . $row["firstname"] . "\"," . " \"lastname\":" . "\"" . $row["lastname"] . "\"," . " \"username\":" . "\"" . $row["username"] . "\"," . " \"profilepic_url\":" . "\"". $row["profilepic_url"] . "\"");
        $default_acc = $row["default_acc"];
        $sql = "SELECT balance FROM Account WHERE id=$default_acc";
        $result2 = $conn->query($sql);
        $row2 = $result2->fetch_assoc();
        print(", \"default_acc_bal\":" . $row2["balance"] . ", \"default_acc_id\":" . $default_acc);
        print("}" . "\n");
      } else {
        print("{");
        print("\"firstname\":" . "\"" . $row["firstname"] . "\"," . " \"lastname\":" . "\"" . $row["lastname"] . "\"," . " \"username\":" . "\"" . $row["username"] . "\"," . " \"profilepic_url\":" . "\"" . $row["profilepic_url"] . "\"");
        $default_acc = $row["default_acc"];
        $sql = "SELECT balance FROM Account WHERE id=$default_acc";
        $result2 = $conn->query($sql);
        $row2 = $result2->fetch_assoc();
        print(", \"default_acc_bal\":" . $row2["balance"] . ", \"default_acc_id\":" . $default_acc);
        print("}," . "\n");
        $remainingrows -= 1;
      }
    }
  } else {
    die("ERROR");
  }

  print("]");

 ?>

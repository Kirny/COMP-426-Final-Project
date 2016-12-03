<?php
session_start();
require_once('authenticate.php');
include("database.php");

$conn = new mysqli($hn, $usr, $pw, $db);
if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}

$username = $_SESSION['username'];

$sql = "SELECT * FROM Account INNER JOIN User ON User.id = Account.user_id
        WHERE User.username = '$username' AND User.default_acc = Account.id";
$result = mysqli_query($conn, $sql);

if($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $data = $row;
  header('Content-type: application/json');
  echo json_encode($data);
}else{
  echo "Query returned with no data.";
}

?>

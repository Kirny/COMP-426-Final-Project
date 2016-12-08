<?php
session_start();
include("database.php");

$conn = new mysqli($hn, $usr, $pw, $db);
if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}

$username = $_SESSION['username'];
$data = array();

//gets the full name, username, and the default account
$sql = "SELECT * FROM Account INNER JOIN User ON User.id = Account.user_id
        WHERE User.username = '$username' AND User.default_acc = Account.id";
$result = mysqli_query($conn, $sql);

//expect only one entry, since every user has exactly one default account
if($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $user_info = $row;
  $data[0] = $user_info;
}else{
  echo "Query returned with no data on " . $user_info . ".";
}

//gets the other accounts besides the default one
$sql2 = "SELECT Account.id, balance FROM Account INNER JOIN User ON User.id = Account.user_id
        WHERE User.username = '$username' AND User.default_acc != Account.id
        ORDER BY Account.id ASC";

if($result2 = mysqli_query($conn, $sql2)) {
  $i = 0;
  while($row2 = mysqli_fetch_assoc($result2)){
    $other_info[$i] = $row2;
    $i++;
  }
  $data[1] = $other_info;
}else{
  echo "No accounts other than the default";
}

header('Content-type: application/json');
echo json_encode($data);

?>

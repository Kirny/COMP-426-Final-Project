<?php
session_start();
require_once('authenticate.php');

$conn = new mysqli("classroom.cs.unc.edu", "dyj", "dudwp524", "dyjdb");
if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}

$username = $_SESSION['username'];

$sql = "SELECT * FROM Account INNER JOIN Account.user_id = User.id
        WHERE User.username = '$username' AND User.default_acc = Account.id";
$result = mysqli_query($conn, $sql);

$balance = null;
if($result->num_rows > 0) {
  $row = $result->fetch_array();
  $balance = $row[1];
}else{
  echo "Query returned with no data.";
}

$_SESSION['balance'] = $balance;

?>

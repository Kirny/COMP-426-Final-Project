<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

  session_start();
  $pictureURL = $_GET['pictureURL'];
  $username = $_SESSION['username'];

  function isImage($url) {
     $params = array('http' => array(
                  'method' => 'HEAD'
               ));
     $ctx = stream_context_create($params);
     $fp = @fopen($url, 'rb', false, $ctx);
     if (!$fp)
        return false;  // Problem with url

    $meta = stream_get_meta_data($fp);
    if ($meta === false)
    {
        fclose($fp);
        return false;  // Problem reading data from url
    }

    $wrapper_data = $meta["wrapper_data"];
    if(is_array($wrapper_data)){
      foreach(array_keys($wrapper_data) as $hh){
          if (substr($wrapper_data[$hh], 0, 19) == "Content-Type: image") // strlen("Content-Type: image") == 19
          {
            fclose($fp);
            return true;
          }
      }
    }

    fclose($fp);
    return false;
  }

  if(isImage($pictureURL)) {
    include 'database.php';

    $conn = new mysqli($hn, $usr, $pw, $db);

    $sql = "UPDATE User SET profilepic_url='$pictureURL' WHERE username='$username'";

    if($conn->query($sql) === FALSE) {
      header('HTTP/1.1 401 Unauthorized');
    } else {
      header('Content-type: application/json');
      print("{\"pictureURL\":\"$pictureURL\"}");
    }
  } else {
    header('HTTP/1.1 401 Unauthorized');
    header('Content-type: application/json');
    print(json_encode(false));
  }
?>

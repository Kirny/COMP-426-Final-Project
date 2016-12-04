<?php

  session_start();
  $pictureURL = $_GET['pictureURL'];

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
    
    header('Content-type: application/json');
    print(json_encode(true));
  } else {
    header('HTTP/1.1 401 Unauthorized');
    header('Content-type: application/json');
    print(json_encode(false));
  }
?>

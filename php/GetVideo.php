<?php


$id = $_GET["id"] ;
echo getVideo($id) ;

function getVideo($id) {

  require "vars.php" ;

  $conn = new mysqli($dbHost, $dbUser, $dbPass, $db) ;
  $stmt = $conn->prepare("SELECT title, channel, vidstring, seed, date FROM videos WHERE id=?") ;
  $stmt->bind_param("s", $id) ;
  $stmt->execute() ;
  $stmt->bind_result($title, $channel, $vidString, $seed, $date) ;
  $stmt->fetch() ;

  $obj = new stdClass() ;
  $obj->title = $title ;
  $obj->channel = $channel ;
  $obj->vidString = $vidString ;
  $obj->date = $date ;
  return json_encode($obj) ;
  
}


?>

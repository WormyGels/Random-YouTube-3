<?php

$json = getVideos() ;
echo $json ;

function getVideos($num = 20) {
  require "vars.php" ;

  $conn = new mysqli($dbHost, $dbUser, $dbPass, $db) ;
  $stmt = $conn->prepare("SELECT id, title, channel, vidstring, date FROM videos ORDER BY id DESC LIMIT $num") ;
  $stmt->execute() ;
  $stmt->bind_result($id, $title, $channel, $vidString, $date) ;

  $objs = [] ;

  while($stmt->fetch()) {

    $obj = new stdClass() ;
    $obj->id = $id ;
    $obj->title = $title ;
    $obj->channel = $channel ;
    $obj->vidString = $vidString ;
    $obj->date = $date ;

    $objs[] = $obj ;
  }

  return json_encode($objs) ;

}

?>

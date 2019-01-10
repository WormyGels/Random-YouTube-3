<?php

require_once "php/GetVideo.php" ;
require_once "php/NewVideo.php" ;

$id = getLatestVid() ;

$obj = json_decode(getVideo($id)) ;
$url = "https://www.youtube.com/watch?v=".$obj->vidString ;

header("Location: ".$url) ;

?>

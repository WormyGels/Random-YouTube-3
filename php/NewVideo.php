<?php

//call the function
$id = getRandomVideo() ;
//echo it to JS
echo getLatestVid() ;

//getting odd behavior from insert_id so need to make this unfortunately
function getLatestVid() {
  require "vars.php" ;

  $conn = new mysqli($dbHost, $dbUser, $dbPass, $db) ;
  $stmt = $conn->prepare("SELECT id FROM $table ORDER BY id DESC LIMIT 1") ;

  $stmt->execute() ;
  $stmt->bind_result($id) ;
  $stmt->fetch() ;


  if (isset($id))
    return $id ;
  else
    return 0 ;
}
//will return the id of the last inserted video
function getRandomVideo() {
  require "vars.php" ;

  //request the random video
  $q = getRandomString() ;
  $json = file_get_contents("https://www.googleapis.com/youtube/v3/search?key=$apiKey&maxResults=50&part=snippet&type=video&q=$q") ;
  $decode = json_decode($json) ;

  foreach ($decode->{"items"} as $result) {
    $vidStrings[] = $result->{"id"}->{"videoId"} ;
    $channels[] = $result->{"snippet"}->{"channelTitle"} ;
    $titles[] = $result->{"snippet"}->{"title"} ;
  }

  //call again if we got no results
  if (!isset($titles)) {
    getRandomVideo() ;
    return ;
  }

  //pick one of our (up to 50) videos
  $randIndex = rand(0, count($titles)-1) ;
  $vidString = $vidStrings[$randIndex] ;
  $channel = $channels[$randIndex] ;
  $title = $titles[$randIndex] ;

  if (videoExists($vidString)) {
    getRandomVideo() ;
    return ;
  }

  //insert into database
  $conn = new mysqli($dbHost, $dbUser, $dbPass, $db) ;
  $stmt = $conn->prepare("INSERT INTO $table (title, channel, vidstring, seed) VALUES (?, ?, ?, ?)") ;
  $stmt->bind_param("ssss", $title, $channel, $vidString, $q) ;
  $stmt->execute() ;
}
function videoExists($vidstring) {
  require "vars.php" ;

  $conn = new mysqli($dbHost, $dbUser, $dbPass, $db) ;
  $stmt = $conn->prepare("SELECT id FROM $table WHERE vidstring = ?") ;
  $stmt->bind_param("s", $vidstring) ;
  $stmt->bind_result($id) ;
  $stmt->execute() ;

  if (isset($id)) {
    return true ;
  }
  return false ;
}
function getRandomString($length = 5) {
  $domain = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
  
  $str = "";
  for ($i = 0; $i < $length; $i++) {
    $str .= $domain[rand(0, strlen($domain)-1)];
  }

  return $str;
}
// function getRandomString($length = 5) {
//   return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length) ;
// }
?>

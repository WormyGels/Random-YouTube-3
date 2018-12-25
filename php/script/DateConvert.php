<?php

error_reporting(E_ERROR | E_PARSE) ;
set_time_limit(300) ; //max 5 minutes

/*
This is a script that will hopefully convert the old standard of dates to the new
more appropriate standard of dates

DO NOT RUN THIS AGAIN

it is commented out so it can be done easily
*/

// //20:44-November-17-2018
// include "vars.php" ;
//
// // $test = "00:00-January-1-2000" ;
// // if (strlen(explode("-", explode(":", $test)[1])[0]) > 1) {
// //   echo "true" ;
// // }
// // else {
// //   echo "false" ;
// // }
//
// // if (strlen(explode("-", explode(":", $test)[1])[0]) < 2) {
// //   $test = $test[0].$test[1].$test[2]."0".substr($test, 3) ;
// // }
// // echo $test ;
//
// $conn = new mysqli($dbHost, $dbUser, $dbPass, $db) ;
//
// $stmt = $conn->prepare("SELECT title, channel, vidstring, seed, date, fav FROM 1currygod") ;
// $stmt->execute() ;
// $stmt->bind_result($title, $channel, $vidstring, $seed, $date, $fav) ;
// $i = 0 ;
//
// $titles = [] ;
// $dates = [] ;
// $channels = [] ;
// $vidstrings = [] ;
// $seeds = [] ;
// $favs = [] ;
//
// while ($stmt->fetch()) {
//   $i++ ;
//   $d = DateTime::createFromFormat('H:i-M-d-Y', $date) ;
//   if ($d == false) {
//     $d = DateTime::createFromFormat('M-d-Y', $date) ;
//   }
//   if (strlen(explode("-", explode(":", $date)[1])[0]) < 2) {
//     $day = explode("-", $date)[1]."-".explode("-", $date)[2]."-".explode("-", $date)[3] ;
//     $time = explode("-", $date)[0] ;
//
//     $hour = explode(":", $time)[0] ;
//     $minute = explode(":", $time)[1] ;
//
//     if (strlen($minute) < 2) {
//       $minute = "0".$minute ;
//     }
//     $date = "$hour:$minute-$day" ;
//
//     $d = DateTime::createFromFormat('H:i-M-d-Y', $date) ;
//   }
//
//   if ($d == false) {
//     $d = DateTime::createFromFormat('H:i-M-d-Y', "00:00-January-1-2000") ;
//   }
//
//   $newDate = $d->format("Y-m-d H:i").":00" ;
//   $dates[] = $newDate ;
//   $titles[] = $title ;
//   $channels[] = $channel ;
//   $vidstrings[] = $vidstring ;
//   $seeds[] = $seed ;
//   $favs[] = $fav ;
//
//   // echo $newDate."<br>" ;
// }
// for ($i = 0 ; $i < count($dates) ; $i++) {
//   $stmt2 = $conn->prepare("INSERT INTO videos (title, channel, vidstring, seed, date, fav) VALUES (?, ?, ?, ?, ?, ?)") ;
//   $stmt2->bind_param("sssssi", $titles[$i], $channels[$i], $vidstrings[$i], $seeds[$i], $dates[$i], $favs[$i]) ;
//   $stmt2->execute() ;
// }
//
// echo $done ;


?>

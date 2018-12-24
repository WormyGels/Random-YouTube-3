//config
var refreshTime = 200 ; //time to refresh recent videos list

//an array of all the videos in the recent videos list
var videos = [] ;
//the current json string for comparison between the client and server
//to see if we need to update the recent videos
var curJson = "" ;

//the video that the user is currently on
var curVideo = 0 ;

//when jquery is loaded
$(function() {

  //set the click event for the new video button
  $("#new-video").click(function() {

    var http = $.ajax("php/NewVideo.php").done(function(response) {
      if (response != "") {
        switchVideo(response) ;
      }
    }) ;

  }) ;

  //load the 20 most recent videos into the recent videos list
  var http = $.ajax("php/GetRecentVideos.php").done(function(response) {
    if (response != "") {
      var json = JSON.parse(response) ;
      curJson = json ;
      curVideo = json[json.length-1].id ;
      fillRecents(json) ;
      switchVideo(curVideo) ;
    }
    else
      window.alert("There was a problem communicating with the database. Please refresh the page.") ;

  }) ;

  setInterval(refreshList, refreshTime) ;

}) ;
//fills the recent videos with the passed json object
function fillRecents(json) {
  //utility function to add a video
  function addRecent(id, title, channel, vidString, date) {
    var html = '<div class="prev-vid">' ;
    if (id == curVideo)
      html = '<div class="prev-vid active">' ;
    html += '<img class="prev-video thumbnail" src="https://i.ytimg.com/vi/'+vidString+'/hqdefault.jpg">' ;
    html += '<span class="prev-video title">'+title+'</span>' ;
    html += '<span class="prev-video channel">'+channel+'</span>' ;
    html += '<span class="prev-video date">'+date+'</span>' ;
    html += '<span class="prev-video num">'+id+'</span>' ;
    html += '</div>' ;
    //set a click event
    var jqueryElement = $(html).click(function() {
      switchVideo(id) ;
    }) ;
    //append to DOM
    jqueryElement.appendTo("#videos") ;
  }
  //clear the videos div
  $("#videos").empty() ;

  for (var i = 0 ; i < json.length ; i++) {
    addRecent(json[i].id, json[i].title, json[i].channel, json[i].vidString, json[i].date) ;
  }

}
//switch the video to new ID
function switchVideo(newId) {
  //get the needed information from the database (string)
  var http = $.ajax("php/GetVideo.php?id="+newId).done(function(response) {
    if (response != "") {
      var decode = JSON.parse(response) ;
      $("#title").text(decode.title) ;
      $("#channel").text(decode.channel) ;
      $("#date").text(decode.date) ;
      $("#vidnum").text(newId) ;

      curVideo = newId ;
      fillRecents(curJson) ;

      //update the video frame
      $("#yt-video").attr("src", "https://www.youtube.com/embed/"+decode.vidString+"?autoplay=1") ;
    }
  }) ;
}
//makes a comparison between the database and the current client's recent videos
//updates when there is a difference
var refreshList = function() {
  //check the videos
  var http = $.ajax("php/GetRecentVideos.php").done(function(response) {
    if (response != "") {
      var json = JSON.parse(response) ;
      //there is a difference and we need to update
      if (JSON.stringify(json) != JSON.stringify(curJson)) {
        curJson = json ;
        fillRecents(json) ;
      }
    }
  }) ;
}

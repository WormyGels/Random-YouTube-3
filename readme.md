# Random YouTube Generator w/ History

A small HTML/PHP/JavaScript project for generating random YouTube videos. Uses the YouTube data API. To get an API key you must create a project on the Google Cloud Platform page and enable the "YouTube Data API v3" service. This API key gets placed in "vars.php".

In addition to generating random videos, it also logs them in a database so they can be retrieved later. In previous versions of this project, this was more relevant since there was a search and favorites, but the current version does not have this.

If you're looking for something that simply generates a random YouTube video, there are probably better options. This was created for a fairly niche purpose for myself and a couple friends.

## Features
* Random YouTube video generation
* Live update on recent videos (shared rolling)

## Plans
* Improved history browsing
* Favorites

## Preview
![Screenshot of window](/img/screenshot.png)

## Libraries Used
* jQuery
* Moment.js

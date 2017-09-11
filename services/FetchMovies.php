<?php

Namespace Services;
Use Models\Movies.php;


Class FetchMovies extends Movies {
	$api_key = "f312ac2cb63002f508d52fd432cea28d";
	$nowPlaying_url = "https://api.themoviedb.org/3/movie/latest?api_key=";
	$pageNumber = "1";
	$resource = call_page($nowPlaying_url . $api_key . "&page=" . $pageNumber);


}
echo ($resource);
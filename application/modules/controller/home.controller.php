<?php

model::load('blazer');

// declare new function
function cover()
{
	// render::view('home.cover');
	// OR
	$view = new blazer();
	$view->render('home.cover.php',$data=NULL,TRUE);
}

function blazer()
{
	// plugin('bootstrap/autoload.json');
	$view = new blazer();
	$data['user'] = "Yash Kumar Verma";
	$view->render('home.blazer.html',$data,FALSE);
}
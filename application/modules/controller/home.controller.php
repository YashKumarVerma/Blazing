<?php

model::load('blazer');

// declare new function
function cover()
{
	render::view('home.cover');
}

function blazer()
{
	$view = new blazer();
	$data['user'] = "Yash Kumar Verma";
	$view->render('home.blazer.html',$data,FALSE);
}
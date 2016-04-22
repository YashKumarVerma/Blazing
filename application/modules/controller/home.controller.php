<?php

model::load('blazer');
model::load('handler_file');

// declare new function
function cover()
{
	// render::view('home.cover');
	// OR
	$view = new blazer();
	$view->render('home.cover.php',$data=NULL,FALSE);
	// set last parameter TRUE to enable turbo mode
}

function blazer()
{
	// plugin('bootstrap/autoload.json');
	$view = new blazer();
	$data['user'] = "Yash Kumar Verma";
	$view->render('home.blazer.html',$data,FALSE);
	// set last parameter TRUE to enable turbo mode
}

function file_handler()
{
	$handle = new handler;
	console(
			// $handle->file('new_file.md')->create()
			$handle->file('new_file.md')->append('i am yash')
	);
}
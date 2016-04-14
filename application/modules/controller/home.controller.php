<?php

function homepage()
{
	$username = io::url()[1];

	render::view('profile',['username'=> $username , 'age'=> 16]);
}

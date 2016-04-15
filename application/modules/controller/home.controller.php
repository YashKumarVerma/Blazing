<?php

function homepage()
{
	$username = io::url()[1];
	$data = ['username'=> $username , 'age'=> 16];

	render::view('profile',$data);
}

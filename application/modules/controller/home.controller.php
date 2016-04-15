<?php

model::load('database');

function homepage()
{
	$username = io::url()[1];
	$data = ['username' => $username];
	render::view('profile',$data);
}

function database()
{
	// or use new database();
	$database = new db();

	// to execute queries which do not show data, but only execute on database
	$database->operation("INSERT INTO users (`NAME`,`AGE`) VALUES('Yash',16) ;");

	// to execure query which show data
	$data = $database->select("SELECT * FROM users WHERE 1 ;");
	foreach ($data as $node) 
	{
		echo "Hello " . $node['NAME'] . "<br>";
	}

}
	

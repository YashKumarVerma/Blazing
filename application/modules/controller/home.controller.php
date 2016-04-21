<?php

model::load('database');
model::load('blazer');

function homepage()
{
	$username = io::url()[1];
	$data = ['username' => $username];

	$view = new blazer();
	$view->render('profile.html',$data,TRUE);
}

function database()
{
	// or use new database();
	$database = new db();

	// to execute queries which do not show data, but only execute on database
	// $database->operation("INSERT INTO users (`NAME`,`AGE`) VALUES('Yash',16) ;");

	// to execure query which show data
	// $data = $database->select("SELECT * FROM users WHERE 1 ;");
	// foreach ($data as $node) 
	// {
		// echo "Hello " . $node['NAME'] . "<br>";
	// }

	// Insert data using :
	// $database->table('users')->insert(['name'=>'adam' , 'age' => 21]);

	// get data using . If want all rows, pass no parameter
	// $data = $database->table('users')->select();
	// foreach ($data as $value) {
	// 	print_r($value) ;
	// 	echo "<br />";
	// }
	
	// to delete use
	// $database->table('users')->delete();

	// to update use
	// $database->table('users')->update(['NAME' => 'yash kumar verma']," `UID`= '1' ");
}

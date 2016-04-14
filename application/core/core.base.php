<?php 

class base
{

}

class extension
{
	static function load($i)
	{
		include "application/extensions/extension." . $i . ".php";
	}
}

function console($i)
{
	echo "<pre>" ;
	print_r($i);
	echo "</pre>";
}


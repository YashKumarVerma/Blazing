<?php 

class io
{
	static function get($i)
	{
		if(isset($_GET[$i]))
		{
			return addslashes($_GET[$i]);
		}
	}

	static function post($i)
	{
		if(isset($_POST[$i]))
		{
			return addslashes($_POST[$i]);
		}
	}
}
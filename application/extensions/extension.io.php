<?php 

class check extends io
{

	// true if the get parameter $i exists
	static function get($i)
	{
		if(isset($_GET[$i]))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	// true if the post parameter $i exists
	static function post($i)
	{
		if(isset($_POST[$i]))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
}
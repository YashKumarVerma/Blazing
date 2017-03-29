<?php 


/*************************************************************************** 
| Input Output Functions
****************************************************************************/
class io
{
	static function get($i)
	{
		if(isset($_GET[$i]))
		{
			return addslashes($_GET[$i]);
		}
		else
		{
			return 0;
		}
	}

	static function post($i)
	{
		if(isset($_POST[$i]))
		{
			if(!is_array($_POST[$i]))
				return addslashes(trim($_POST[$i]));
			else{
				return $_POST[$i];
			}
		}
		else
		{
			return 0;
		}

	}
	

	static function url()
	{
		return explode('/', $_GET['url'] );
	}

// to check multiple isset conditions over post
	static function postCheck($i)
	{
		// if it is an array
		if(is_array($i))
		{
			// then loop through all elements 
			$err = 0;
			foreach ($i as $key) 
			{ 
				// if any unknown post index found, set error =1;
				if(!isset($_POST[$key]))
					$err=1;
			}

			// if there is error (error = 1)
			if($err)
				return 0; // 0 means postCheck Failed
			else
				return 1; // 1 means postCheck is successful
		}
	}

// to check multiple isset over session
	static function sessionCheck($i)
	{
		// if it is an array
		if(is_array($i))
		{
			// then loop through all elements 
			$err = 0;
			foreach ($i as $key) 
			{ 
				// if any unknown post index found, set error =1;
				if(!isset($_SESSION[$key]))
					$err=1;
			}

			// if there is error (error = 1)
			if($err)
				return 0; // 0 means postCheck Failed
			else
				return 1; // 1 means postCheck is successful
		}
	}  

}

/*************************************************************************** 
| Extension loading class
****************************************************************************/
class extension
{
	static function load($i)
	{
		include "application/extensions/extension." . $i . ".php";
	}
}

/*************************************************************************** 
| Small Independent Functions
****************************************************************************/

function console($i)
{
	echo "<pre>" ;
	print_r($i);
	echo "</pre>";
}

/*************************************************************************** 
| Some native code
****************************************************************************/
isset($_GET['url'])? $_GET['url'] : $_GET['url'] = ''; 
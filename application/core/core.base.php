<?php 

/*************************************************************************** 
****************************************************************************/
class base
{

}

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
	}

	static function post($i)
	{
		if(isset($_POST[$i]))
		{
			return addslashes($_POST[$i]);
		}
	}
	
	static function url()
	{
	return explode('/', $_GET['url'] );
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

function notNULL($i)
{
	if($i != NULL)
	{
		return TRUE;
	}
	else
	{
		return FALSE;
	}
}

/*************************************************************************** 
| Some native code
****************************************************************************/
isset($_GET['url'])? $_GET['url'] : $_GET['url'] = ''; 


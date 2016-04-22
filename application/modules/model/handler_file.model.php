<?php

/*
*@author : Yash Kumar Verma
*@url : https://github.com/YashKumarVerma/Blazing
*@note : model to handle file operations
*/

class handler
{
	// declaring variables
	var $file;

	// to read file
	public function file($location)
	{
		$this->file = new file_helper_class($location);
		return $this->file;
	}

}

class file_helper_class
{
	// declaring variables
	var $file_location;

	// on starting
	function __construct($location)
	{
		$this->file_location = $location;
	}

	// to read all data
	public function read()
	{
		if(file_exists($this->file_location))
		{
			return file_get_contents($this->file_location);
		}
		else
		{
			return "File Not Found";
		}
	}

	// to create file
	public function create()
	{
		if(file_exists($this->file_location))
		{
			// return false is file already exists
			return FALSE;
		}
		else
		{
			// file created
			return TRUE;
		}
	}


}


/*************************************************************
*Initialize the handler by:
@ $handler = new handler;

* Load a file as target by:
@ $handler->file('filename');

* Load the contents of target file by
@ $handler->file('filename')->read();

*/
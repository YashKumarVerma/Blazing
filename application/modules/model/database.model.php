<?php


class database
{
	var $name;
	var $host;
	var $user;
	var $pass;
	var $connection;
	var $status;
	var $table;

	function __construct()
	{
		// declaring database credentils
		$this->name = $GLOBALS['protected']['database']['name'];
		$this->host = $GLOBALS['protected']['database']['host'];
		$this->user = $GLOBALS['protected']['database']['user'];
		$this->pass = $GLOBALS['protected']['database']['pass'];

		// attempt to connect
		$this->connection = new mysqli($this->host, $this->user, $this->pass, $this->name);

		// check if connection successful, else store error in $this->status
			if($this->connection->connect_error)
			{
				$this->status = $this->connection->connect_error;
			}
	}

	public function operation($query)
	{
		if($this->connection->query($query) === TRUE)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	public function select($query)
	{
		$result = $this->connection->query($query);
		if($result->num_rows > 0)
		{
			$output = array();
			while($row = $result->fetch_assoc())
			{
				array_push($output, $row);
			}
			return $output;
		}
	}
}

class db extends database
{

}
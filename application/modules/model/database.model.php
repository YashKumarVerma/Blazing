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
	var $table_name;

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

	public function query($query)
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

	public function table($table_name)
	{
		$this->table = new table($table_name,$this->connection);
		return $this->table;
	}
}

class table
{
	var $connection;
	var $name;

	function __construct($name,$connection)
	{
		$this->name = $name;
		$this->connection = $connection;
	}

	// to insert data
	public function insert($data)
	{
		// query building starts
		$query = "INSERT INTO " . $this->name;
		$query .= ' ( ';
		foreach ($data as $index => $value)
		{
			$query .= '`' . addslashes($index) . '`' ;
		}
		$query .= ' )';
		$query = str_replace('``', '`,`', $query);
		$query .= " VALUES( ";
		foreach ($data as $value)
		{
			$query .= " '".addslashes($value)."' ,"; 
		}
		if(strpos(strrev($query),',') == 0 ) 
			{ 
			 $query = substr(strrev($query), 1); 
			 $query = strrev($query);
			}
		$query .= ' ); ';
		// query building ends 
		
		if($this->connection->query($query) == TRUE)
		{
			return TRUE;
		}
		else
		{
			echo $this->connection->error;
			return FALSE;
		}
	}

	// to get data
	public function select($conditions = 1)
	{
		$query = "SELECT * FROM " . $this->name . " WHERE " . $conditions . " ;";
		$result = $this->connection->query($query);
		{
			if($result->num_rows > 0)
			{
				$output = array();
				while($row = $result->fetch_assoc())
				{
					array_push($output,$row);
				}
				return $output;
			}
			else
			{
				echo $this->connection->error;
				return FALSE;
			}
		}
	}

	// to delete that 
	public function delete($condition = 1 )
	{
		$query = "DELETE FROM " . $this->name . " WHERE " . $condition . " ;";
		if($this->connection->query($query) == TRUE)
		{
			return TRUE;
		}
		else
		{
			echo $this->connection->error;
			return FALSE;
		}
	}

	// to update database
	public function update($fields , $condition = 1)
	{
		$query = "UPDATE " . $this->name . " SET ";
		foreach ($fields as $index => $value) {
			$query .= "`" . addslashes($index) . "` = '" . addslashes($value) . "' ";
		}
		$query.= "WHERE " . $condition;
		if($this->connection->query($query) == TRUE)
			{
				return TRUE;
			}
		else
		{
			echo $this->connection->error;
			return FALSE;
		}
	}

	// to increment a value by one
	// prposed. pending code

}


// add as much as db as you want to be called.
class db extends database
{

}


/*
model::load('blazer');

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

	// Insert data using :
	$database->table('users')->insert(['name'=>'adam' , 'age' => 21]);

	// get data using . If want all rows, pass no parameter
	$data = $database->table('users')->select();
	foreach ($data as $value) {
		print_r($value) ;
		echo "<br />";
	}
	
	// to delete use
	$database->table('users')->delete();

	// to update use
	$database->table('users')->update(['NAME' => 'yash kumar verma']," `UID`= '1' ");
}
*/

<?php
	include("config.php");
	class connection
	{
		public $mysqli;
		public $query;
		public function connection() 
		{
			$this->mysqli = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
			/* check connection */
			if (mysqli_connect_errno()) 
			{
				printf("Connect failed: %s\n", mysqli_connect_error());
				exit();
			}
			/* Execute query */
		}
		public function execQuery($query)
		{
			if(substr(strtolower($query),0,1)!="s")
			{
				return($this->mysqli->query($query));
			}
			else
			{
				return($this->result = $this->mysqli->query($query));
			}
		}
		public function closeConnection()
		{
			$this->mysqli->close();
		}
	}
?>

<?php

class Db_connect
{
		private $conn;

		public function connect()
		{
			require_once 'config.php';

			$this->conn  = mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) ;
			return $this->conn;
		}

		public function CloseConnect()
		{
			require_once 'config.php';

			mysql_close($this->conn);
		}
}
	
?>
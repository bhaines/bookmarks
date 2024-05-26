<?php

class mysql {

	var $error = "";
	var $result = false;
	var $connection = false;

	function mysql () {
		global $dsn;
		$this->connection = new mysqli($dsn['hostspec'], $dsn['username'], $dsn['password'], $dsn['database']);
		if ( $this->connection->connect_error ) {
			$this->error = $this->connection->error;
		}
	}

	function query ($query) {
		if ($this->result = $this->connection->query ($query)) {
			return true;
		}
		else{
			$this->error = $this->connection->error;
			return false;
		}
	}

	function escape ($string) {
		if (! $this->connection) {
			$this->mysql();
		}
		return mysqli_real_escape_string ($this->connection, $string);
	}

	function mysql_result($result, $row) {
		return $result->fetch_array()[0];
	}

	function mysql_fetch_assoc($result) {
		return $result->fetch_assoc();
	}

	function mysql_num_rows($result) {
		return $result->num_rows;
	}

	function mysql_fetch_object($result) {
		return $result->fetch_object();
	}

	function insert_id() {
		return $this->connection->insert_id;
	}
}

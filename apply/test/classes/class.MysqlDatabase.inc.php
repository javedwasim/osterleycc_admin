<?php
session_start();
require_once "class.AbstractionDatabase.inc.php";

class MysqlDatabase extends AbstractionDatabase
{
	public function __construct($host, $user, $password, $databaseName)
	{
		$this->db = mysql_connect($host, $user, $password);
		mysql_select_db($databaseName, $this->db);
	}
	public function __destruct()
	{
		mysql_close($this->db);
	}
	
//	public function select($query)
//	{
//		return $this->toArray(mysql_query($query));
//	}
//	private function toArray($res)
//	{
//		while($row = mysql_fetch_array($res))
//		{
//			$arr[] = $row;
//		}
//		
//		return $arr;
//	}
//	public function query($query)
//	{
//		return mysql_query($query);
//	}

}
$db = new MysqlDatabase("localhost","root","root","abstraction_db");


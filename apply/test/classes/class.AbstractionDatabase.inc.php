<?php

abstract class AbstractionDatabase
{
	private $db;
	
	abstract public function __construct($host, $user, $password, $databaseName);
	abstract public function __destruct();
	abstract public function select($query);
	abstract public function query($query);
	
}
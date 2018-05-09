<?php
  define("log",   "");
  define("pass",  "");
  define("dsn",   "mysql:host={HOST};dbname={DB};charset:utf-8;");
  try{
    $con = new PDO( dsn, log , pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
		$con->exec("SET NAMES utf8");
		$con->exec("SET CHARACTER SET utf8");
  }catch( PDOException $e ){
	  die( $e->getMessage() );  
  }   
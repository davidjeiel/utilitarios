<?php
  header("Content-type: text/html; charset=utf-8"); 
  
  class Conexao
  {
    const dsn  = "mysql:host={HOST};dbname={DB};charset:utf-8;";
    const log  = "";
    const pass = "";    
    public $con;
    
    public function __construct()
    { 
      $this->con = new PDO( self::dsn, self::log , self::pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8") ); 
      $this->con->exec("SET NAMES utf8");
		  $this->con->exec("SET CHARACTER SET utf8");
    }     
    public function __destruct(){ unset($this->con); }    
  }
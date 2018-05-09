<?php

class Dados 
{
    public $pastas;
    public $diretorio = array();
    
    public function __construct() {
        //pegaInstancia();
        pegaDiretorio();
    }
    
    public function pegaInstancia()
    {
        $this->pastas = explode( "\\", __DIR__ );         
    }
    
    public function pegaDiretorio()
    {
        foreach ($this->pastas as $value) {
            array_push( $this->diretorio, $value  );
        }
    }
       
    /*
        $diretorio = implode( $aux_diret, '\\' );    
        $auto      = $diretorio."\ctrl\AutoLoad.class.php";  
    */
}
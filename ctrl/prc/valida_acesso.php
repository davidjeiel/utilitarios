<?php
//Inclui o arquivo de segurança
    
    require_once '../AutoLoad.class.php';
    $autoload = new Autoload;
    $autoload->folders("acessoSeguro");   
    $as = new acessoSeguro;
    $as->protegePagina();

<?php

    include_once "conexao.php";

    $email = $_REQUEST['login'];    
    $select =  " SELECT"
              ."	   id_usuario"
              ."	  ,nome"                           
              ."	  ,email"                           
              ."	  ,id_perfil "
              ."  FROM usuarios ";

    $condicao = " WHERE email = '{$email}'";
    $sql   = $select . $condicao;   
    $query = $con->prepare($sql);
    $query->execute();
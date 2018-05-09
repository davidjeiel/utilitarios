<?php

   include_once "../../ctrl/fnc/conexao.php";

   $pass = $_REQUEST['senha'];   
   $email= $_REQUEST['log'];

   $select   = " SELECT"
              ."	   id_usuario"
              ."	  ,nome"                           
              ."	  ,email"                           
              ."	  ,id_perfil "
              ."  FROM usuarios ";
   $condicao = " WHERE email = '{$email}'"
              ." AND pass = '{$pass}'";

   $sql = $select . $condicao;

   $rsPart = $con->prepare($sql);
   $rsPart->execute();    
   
  $dados_usuario = array(
      "id",
      "nome",
      "email",
      "id_perfil"
    );
  foreach ( $rsPart as $val ):
      $dados_usuario["id"]        = $val['id_usuario'];
      $dados_usuario["nome"]      = $val['nome'];
      $dados_usuario["email"]     = $val['email'];
      $dados_usuario["id_perfil"] = $val['id_perfil'];
  endforeach;
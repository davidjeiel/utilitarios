<?php
  header("Content-type: text/html; charset=utf-8"); 
  include_once "conexao.class.php";
  
  class Seletores extends Conexao
  {
    public function __construct()
    {
      parent::__construct();
    }  
    
    public function usuarios()
    {
      $sql =   "select "
          ."	  id_usuario"
          ."	, nome"
          ."	, cpf"
          ."	, email"
          ."	, telefone"
          ."	, pass"
          ."	, ativo"
          ."	, id_perfil "
          ." from usuarios ";

      $recordset = $this->con->prepare($sql);  
      $recordset->execute();
      echo '<div class="col-md-4">';
        echo '<label align="center">Selecione o usuário:</label>';
        echo '<select  name="seletor_usuario" id="seletor_usuario" class="form-control">';
          echo '<option></option>';
            foreach( $recordset as $val ){
              echo "<option value='". $val['id_usuario']  ."'>". $val['nome'] ."</option>";
            };
        echo "</select>";
      echo '</div>';
    }
    
    public function historicos()
    {
      $select =  "SELECT id_historico"
              ."	    ,historico"
              ."	    ,tp_movimento "
              ."  FROM hist_movimento";

      $rsHist = $this->con->prepare($select);
      $rsHist->execute(); 
      
      echo '<div class="col-md-4">';
        echo '<label align="center">Selecione o histórico:</label>';
        echo '<select name="selet_hist" id="selet_hist" class="form-control">';
          echo '<option></option>';
             foreach( $rsHist as $val ): 
          echo '<option value="'. $val["id_historico"].'">'. $val['historico'] .'</option>';
             endforeach; 
        echo'</select>';
      echo '</div>';
    }
    
    public function __destruct()
    {}
  }
<?php
    /****************************************************************************
    *                 Função que valida um usuário e senha                      *
    *---------------------------------------------------------------------------/
    * @param  - string $usuario - O usuário a ser validado                      /
    * @param  - string $senha   - A senha a ser validada                        /
    ****************************************************************************/   
    
    class acessoSeguro   
    {  
        const     pag_inicial = "../../painel.php"; #Página do painel inicial
        const     index       = "../../index.php";  #Página inicial acessada sem login
        public    $select;                          #Seleção de dados SQL
        public    $array_usuario;                   #Matriz que contém os dados do usuário
        public    $login;                           #Login do usuário
        public    $senha;                           #Senha do usuário
        protected $senhaEncryptada;                 #Senha do usuário após processo de encriptação
        public    $inst;

        public function __construct()
        {           
            $this->login = $_REQUEST["login"];
            $this->senha = $_REQUEST["senha"];  
            $this->senhaEncryptada = $this->codifica( $this->senha ); 
            $this->select =  " SELECT"
                            ."	   id_usuario"
                            ."	  ,nome"
                            ."	  ,cpf"
                            ."	  ,email"
                            ."	  ,telefone"
                            ."	  ,pass"
                            ."	  ,ativo "
                            ."	  ,id_perfil "
                            ."   FROM usuarios "
                            ."  WHERE email = '$this->login' " 
                            ."    AND pass  = '$this->senhaEncryptada';";
        }
      
        public function geraChave($senha)
        { //Método de encriptação em SHA 256
          return hash('SHA256', $senha);
        }
      
        public function codifica($senha)
        { //Codifica a senha em md5
              $senha = addslashes($senha);
              $key   = md5($senha);
              return $key;
        }
    
        public function validaEmailSenha()
        { 
              //Verificações no banco de dados
                include "conexao.php";              
                $sql    = $this->select;
                $result = $con->prepare($sql);
                $result->execute();
                $resultQtd = $result->rowCount();
                $this->array_usuario = array("usuario","email","nome","senha");
                  
              if( $resultQtd >= 1 )
              { //Caso haja cadastro para o usuário que está acessando
                  session_start();  
                  foreach( $result as $value )
                  { //Atribui variáveis de sessão
                      $GLOBALS["Registros"]    = $resultQtd;
                      $GLOBALS["usuarioID"]    = $value['id_usuario'];   // Pega o valor da coluna 'id' 
                      $GLOBALS["usuarioNome"]  = $value['nome'];         // Pega o valor da coluna 'nome' 
                      $GLOBALS["usuarioEmail"] = $value['email'];        // Pega o valor da coluna 'email' 
                      $GLOBALS["usuarioSenha"] = $value['pass'];         // Pega o valor da coluna 'pass' 
                      $GLOBALS["usuarioPerfil"]= $value['id_perfil'];    // Pega o valor da coluna 'pass' 
                  }  
                  if ( $this->senhaEncryptada === $_SESSION["usuarioSenha"] ){
                      return true; 
                  }else{
                      return false;
                  }                 
              }
        }
        
        protected function expulsaVisitante()
        {
            // Manda pra tela de login
              header( "Location: ".self::index );
        }

        public function protegePagina()
        {
            if ( empty( $GLOBALS["Registros"] ) ){
              // Não há usuário logado, manda pra página de login                
                $this->expulsaVisitante();
            }         
        }       

        public function loginUsuario()
        {
            header( "Location: http://".$_SERVER["HTTP_HOST"]."/painel.php" );
        }

        public function __desctruct()
        {
            session_unset();
            session_write_close();
            unset($GLOBALS["Registros"]);
            unset($GLOBALS["usuarioID"]);
            unset($GLOBALS["usuarioNome"]);
            unset($GLOBALS["usuarioEmail"]);
            unset($GLOBALS["usuarioSenha"]);
            unset($GLOBALS["usuarioPerfil"]);
        }          
    }    
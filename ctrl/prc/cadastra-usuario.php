<?php
  /*
  * @descript: Processador de formulário para cadastro de usuários
  * @author:   David Jeiel <davidjeiel@gmail.com>
  * @version:  1.0
  */
      include "../AutoLoad.class.php";
      $autoload = new AutoLoad;
      $autoload->folders("acessoSeguro");
      $ass = new acessoSeguro;

      include "../fnc/conexao.php";
     // include "../fnc/acesso.php";

    //Informações básicas
      @$nome_usuario   = strtoupper($_REQUEST['nome_usuario']);
      @$email_usuario  = $_REQUEST['email_usuario'];
      @$senha_usuario  = $ass->codifica($_REQUEST['senha_usuario']);
      @$tel_usuario    = $_REQUEST['tel_usuario'];
      @$cpf            = $_REQUEST['cpf_usuario'];

    //Dados Bancários
      @$banco          = $_REQUEST['banco'];
      @$agencia        = $_REQUEST['agencia'];
      @$op             = $_REQUEST['op'];
      @$conta          = $_REQUEST['conta'];
      @$dv             = $_REQUEST['dv'];

    $dados = array( 
                    nome     => $nome_usuario, 
                    email    => $email_usuario, 
                    senha    => $senha_usuario, 
                    telefone => $tel_usuario, 
                    cpf      => $cpf,
                    banco    => $banco,  
                    agencia  => $agencia,
                    operacao => $op, 
                    conta    => $conta, 
                    dv       => $dv
     );
  
    foreach( $dados as $key => $val ):
      if( !isset($val) ):
        echo "<script type='text/javascript'>alert('Não foi recebido o dado $key');</script>";  
        header("Location: http://consorcios.captalize.com.br");    
      endif;
    endforeach;

    //Cadastra dados básicos do usuário
      $sql_insere_usuarios =  " INSERT INTO usuarios("                         
                             ."                     nome"
                             ."                   , cpf"
                             ."                   , email"
                             ."                   , telefone"
                             ."                   , pass"
                             ."                   , ativo"
                             ."                   ) "
                             ."          VALUES ("
                             ."              '".$dados["nome"]."'"
                             ."             ,'".$dados["cpf"]."'"
                             ."             ,'".$dados["email"]."'"
                             ."             ,'".$dados["telefone"]."'"
                             ."             ,'".$dados["senha"]."'"
                             ."             ,1"
                             ."             )";

        $rsCadastraUsuario = $con->prepare($sql_insere_usuarios);
        $rsCadastraUsuario->execute();

      //Identifica qual o id do usuário cadastrado
        $identifica_usuario =  "SELECT id_usuario "
                              ."  FROM usuarios "
                              ." WHERE email = '". $dados["email"] ."'   "
                              ."  LIMIT 1";

        $rsIdentificaUsuario = $con->prepare($identifica_usuario);
        $rsIdentificaUsuario->execute();

      //Cria variável com o id dusuário cadastrado
        foreach( $rsIdentificaUsuario as $value ):
            $id_user = $value["id_usuario"];
        endforeach;

      //Cadastra a conta informada pelo usuário
        if( isset($op) ){ #Caso haja operação informada
          $cadastra_conta =    'INSERT INTO contas('
                                  .'						  banco'
                                  .'						, agencia'
                                  .'						, operacao'
                                  .'						, conta'
                                  .'						, dv_conta'
                                  .'						, tp_conta'
                                  .'						, id_usuario'
                                  .'					) '
                                  .'	 VALUES ('
                                  .'	 		 '.$dados['banco']
                                  .'			,'.$dados['agencia']
                                  .'			,'.$dados['operacao']
                                  .'			,'.$dados['conta']
                                  .'			,'.$dados['dv']
                                  .'			, 1'
                                  .'			,'.$id_user
                                  .'			)';
        }if( empty($op) ){ #Caso não haja operação informada
              $cadastra_conta =    'INSERT INTO contas('
                                  .'						  banco'
                                  .'						, agencia'
                                  .'						, conta'
                                  .'						, dv_conta'
                                  .'						, tp_conta'
                                  .'						, id_usuario'
                                  .'					) '
                                  .'	 VALUES ('
                                  .'	 		 '.$dados['banco']
                                  .'			,'.$dados['agencia']
                                  .'			,'.$dados['conta']
                                  .'			,'.$dados['dv']
                                  .'			, 1'
                                  .'			,'.$id_user
                                  .'			)';
        }
        
        $rsCadastraConta = $con->prepare($cadastra_conta);
        $rsCadastraConta->execute();
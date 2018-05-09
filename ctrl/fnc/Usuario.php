<?

  class Usuario extends Conexao
  {
    public  $id;
    public  $nome;
    public  $email;
    public  $perfil;
    private $select;
    private $user;
    private $condicao;
    protected $sql;
    protected $dados_usuario;
    
    public function __construct()
    {
      $this->email = $_REQUEST['login'];
      $this->getQuery();
      
      /*
        if( isset($_GLOBAL['Registros']) ):
          $this->id     = $_GLOBAL['usuarioID'];
          $this->nome   = $_GLOBAL['usuarioNome'];
          $this->email  = $_GLOBAL['usuarioEmail'];
          $this->perfil = $_GLOBAL['usuarioPerfil'];
        elseif( empty($_GLOBAL['Registros']) ):
          $this->getUsuario();    
        endif;
      */
    }
    
    public function getQuery()
    {
       $this->select   =  " SELECT"
                            ."	   id_usuario"
                            ."	  ,nome"                           
                            ."	  ,email"                           
                            ."	  ,id_perfil "
                            ."  FROM usuarios "
                            ."  WHERE email = '{$this->email}'";       
    }
    
    public function getDados()
    {
       $this->dados_usuario = $this->con->prepare($this->select);
       $this->dados_usuario->execute();
       
        foreach( $dados_usuario as $res ):
          $this->id    = $res['id_usuario'];
          $this->nome  = $res['nome'];
          $this->email = $res['email'];
          $this->perfil= $res['perfil'];
        endforeach;
    }
    
    public function __destruct()
    {
      unset(
              $this->id,
              $this->nome,
              $this->email,
              $this->perfil
           );
    }
  }
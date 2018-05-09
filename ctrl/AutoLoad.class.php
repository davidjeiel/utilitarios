<?php
  
    class AutoLoad
    {
          private $archives;

          public function __construct()
          { 
            spl_autoload_register(array($this, 'folders'));
          }

          public function folders($archive)
          {
              $this->archives = array(  
                                        __DIR__.'\\class\\'.$archive.'.class.php',
                                        __DIR__.'\\fnc\\'  .$archive.'.php',
                                        __DIR__.'\\prc\\'  .$archive.'.php',
                                        __DIR__.'\\rs\\'   .$archive.'.php',
                                        __DIR__.'\\selet\\'.$archive.'.php',
                                        __DIR__.'\\interface\\'.$archive.'.class.php',
                                        __DIR__.'\\dados\\'.$archive.'.class.php' 
                                     );

             foreach( $this->archives as $file ):                 
                if( file_exists( $file ) ):                  
                    require_once $file;
                endif; 
             endforeach;     
          }        
    }
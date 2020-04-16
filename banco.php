<?php
    
    
    class Banco
    {
        private $host     = "localhost";
        private $port     = "5432";
        private $user     = "";
        private $dbname   = "";
        private $password = "";
        private $conexao  = null;

        function __construct($p_host,$p_port,$p_user,$p_dbname,$p_password ) 
        {
            $connStr =  "  host= $p_host "
                        ." port= $p_port"
                        ." user= $p_user"
                        ." dbname= $p_dbname"
                        ." password= $p_password";

            $this->conexao = pg_connect($connStr) or die("Não foi possível fazer a conexão ao database");
        }

        function getConexao()
        {
            return $this->conexao;
        }  

        function desconecta()
        {
            pg_close($this->conexao);
        }
       
    }



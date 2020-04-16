<?php



    Class Tb_evento
    {
        private $banco;
        private $conexao;
        private $nomeTabela;

        //Campos da Tabela

        private $nm_evento  = null;
        private $id_evento  = null;

        // Contrutor: Passar o banco que se quer utilizar

            function __construct($p_banco)
            {

                    $this->banco      = $p_banco;
                    $this->conexao    = $this->banco->getConexao();
                    $this->nomeTabela = get_class($this);

            $comando = "insert into $this->nomeTabela values (                   
                        $1,$2,$3)";           
            $comando = pg_prepare($this->conexao, "insert", $comando);

            $comando = "update  $this->nomeTabela set nm_evento = 
                        $2 where id_evento = $1";           
            $comando = pg_prepare($this->conexao, "update", $comando);

            $comando = "delete from  $this->nomeTabela where id_evento = $1";      
            $comando = pg_prepare($this->conexao, "delete", $comando);

            }


        // Métodos para manusear os dados da tabela

        function SetIdEvento($p_idEvento)
        {
            $this->id_evento = $p_idEvento;
        }
        
        function GetIdEvento()
        {
            return $this->id_evento;
        }

        function SetNmEvento($p_nmEvento)
        {
            $this->nm_evento = $p_nmEvento;
        }
            
        function GetNmEvento()
        {
            return $this->nm_evento;
        }

        function SetQrCode($p_qrCode)
        {
            $this->qrcode = $p_qrCode;
        }
            
        function GetQrCode()
        {
            return $this->qrcode;
        }



        
        // Método para executar o INSERT na tabela

        function Inserir()
        {   
            $result = pg_execute($this->conexao, "insert",array($this->id_evento,"'$this->nm_evento'","'$this->qrcode"));
        }

        // Método para executar o UPDATE na tabela

        function Update()
        {
            $result = pg_execute($this->conexao, "update",array($this->id_evento,"'$this->nm_evento'"));
        }

       // Método para executar o DELETE na tabela

        function Delete()
        {
            $result = pg_execute($this->conexao, "delete",array($this->id_evento));	
        }

        // Método para executar o SELECT na tabela

        function Read()
        {   
            $comando = "Select * from  $this->nomeTabela where id_evento = $this->id_evento";           
            $result = pg_query($this->conexao,  $comando);
            $consulta = pg_fetch_assoc($result);
            $this->nm_evento=$consulta['nm_evento'];	    
        }

}
?>
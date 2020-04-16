<?php
	
	namespace chillerlan\QRCodeExamples;

	$BancoSistema = new Banco("localhost","5432","postgres","testeEvento","root"); 
	$Tb_evento = new Tb_evento($BancoSistema);
	
	use chillerlan\QRCode\{QRCode, QROptions};
	require_once __DIR__.'../vendor/autoload.php';

	include 'banco.php';
	include 'Tb_evento.php';
	include 'url.php';

	$options = new QROptions
    (
        [
            'version'    => 5,
            'outputType' => QRCode::OUTPUT_MARKUP_SVG,
            'eccLevel'   => QRCode::ECC_L,
        ]
    );
    

	$nomeEvento = $_POST['nomeEvento'];
	$idEvento   = $_POST['idEvento'];
	$nomeimg    = 'qrcode_img/'.$idEvento.'.svg';
	$QRCODE     = new QRcode($options);
	$url        = URL;

	$QRCODE->render($url, $nomeimg);

	


	//insert
    try
    {
        if(isset($_POST['salvar']))
        {
         	$Tb_evento->SetIdEvento($nomeEvento);
         	$Tb_evento->SetNmEvento($idEvento);
         	$Tb_evento->SetQrCode($nomeimg);
         	$Tb_evento->Inserir(); 
      	}      	
   	}catch(Exception $e)
   	{
      echo 'Exceção capturada: ',  $e->getMessage();
   	}
      
   	$BancoSistema->desconecta();

?>
<?php 
require_once('../class/bodega.php');
if(isset($_POST['bremitente']) && isset($_POST['bnbultos'])){
	$bclavep = $_POST['bclavep'];
	$bfolioce = $_POST['bfolioce'];
	$bremitente = $_POST['bremitente'];
	$bcons = $_POST['bcons'];
	$bdestino = $_POST['bdestino'];	
	$bnbultos = $_POST['bnbultos'];
	$bvol = $_POST['bvol'];
	$bpeso = $_POST['bpeso'];
	$bmercancia = $_POST['bmercancia'];
	$btbultos = $_POST['btbultos'];
	$bubica = $_POST['bubica'];
	$bmedida = $_POST['bmedida'];
	$bdocu = $_POST['bdocu'];
	//habiltar hasta qu se sepa como poner con numeros
	//$blento = $_POST['blento'];
	//$bpeligro = $_POST['bpeligro'];
	//$brecol = $_POST['brecol'];

	$blento = 0;
	$bpeligro = 0;
	$brecol = 0;

	$hora = date("H:i:s");
	$hoy = date('Y-m-d');
	//$hoy = now();
	$boficina = $_SESSION['logged_oficina'];
	$bbodegae_id = "438";

	$bremitente = ucwords($bremitente);
	//$bremitente = ucwords(strtolower($bremitente));
	$bcons = ucwords($bcons);
	$bnbultos = strtolower($bnbultos);
	$bvol = strtolower($bvol);
	$bpeso = strtolower($bpeso);

	$saveBodega = $bodega->add_bodega($bclavep, $bfolioce, $bremitente, $bcons, $bdestino, $bnbultos, $bvol, $bpeso, $bmercancia, $btbultos, $bubica, $bmedida, $bdocu, $blento, $bpeligro, $brecol, $hoy, $boficina, $bbodegae_id);
	if($saveBodega){
		$return['valid'] = true;
		$return['msg'] = "Nuevo registro agregado con éxito!";
	}else{
		$return['valid'] = false;
	}
	echo json_encode($return);
}//end isset

$bodega->Disconnect();
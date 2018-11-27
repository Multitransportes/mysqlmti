<?php 
require_once('../class/Bodega.phpb');
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

	$ilento = $_POST['lento'];
	$ipeligro = $_POST['ipeligro'];
	$irecol = $_POST['irecol'];
	
	// print_r('$checkbox');
	// print_r($_POST['ipeligro']);
	//print_r($_POST['irecol']);


	$bbodegae_id = 19;
	$bbodegaed_id = $_POST['bbodegaed_id'];
	
	$hora = date("H:i:s");
	$hoy = date('Y-m-d');
	//$hoy = now();

	$boficina = $_SESSION['logged_oficina'];
	$bbodegae_id = "438";

	$bremitente = ucwords($bremitente);
	$bcons = ucwords($bcons);
	$bnbultos = strtolower($bnbultos);
	$bvol = strtolower($bvol);
	$bpeso = strtolower($bpeso);

	$bempleado_id = $_SESSION['logged_cemple'];
	$saveEdit = $bodega->edit_bodega($bbodegaed_id,$bclavep,$bfolioce,$bremitente, $bcons, $bdestino,$bnbultos, $bvol, $bpeso, $bmercancia,$btbultos,$bubica,$bmedida,$bdocu,$ilento,$ipeligro,$irecol,$bempleado_id);
	$return['valid'] = false;
	if($saveEdit){
		$return['valid'] = true;
		$return['msg'] = "Editado correctamente!";
	}
	echo json_encode($return);
}//end isset
$bodega->Disconnect();

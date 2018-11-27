<?php 
//add to expired table before e delete sa stock table
require_once('../class/Bodega.php');
if(isset($_POST['bodegaed_ID'])){
	$bbodegae_id = $_POST['bodegaed_ID'];
	$saveBodega = $bodega->del_bodegaList($bbodegae_id);
	$return['valid'] = false;
	if($saveBodega){
		$return['valid'] = true;
		$return['msg'] = "Eliminado correctamente!";
	}
	echo json_encode($return);
}//end isset

$bodega->Disconnect();//close connection

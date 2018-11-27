<?php 
require_once('../class/bodega.php');

if(isset($_POST['bodegaed_ID'])){
	$bodegaed_id = $_POST['bodegaed_ID'];
	$itemDetails = $bodega->get_bodega($bodegaed_id);
    
    //print_r($itemDetails);

	$return['title'] = "Edit Bodega";
	$return['event'] = "edit";
	if($itemDetails > 0){
		$return['clavprod'] = $itemDetails['bodegaed_codproduc'];
		$return['folioce'] = $itemDetails['bodegaed_folioce'];
		$return['remitente'] = $itemDetails['bodegaed_remitente'];
		$return['cons1'] = $itemDetails['bodegaed_consigna'];
		$return['id'] = $itemDetails['bodegaed_ID'];
		$return['destino'] = $itemDetails['bodegaed_destino'];
		$return['nbultos'] = $itemDetails['bodegaed_n_bultos'];
		$return['volumen'] = $itemDetails['bodegaed_volumen'];
		$return['peso'] = $itemDetails['bodegaed_peso_bruto'];
		$return['mercancia'] = $itemDetails['bodegaed_mercancia'];
		$return['tbulto'] = $itemDetails['bodegaed_tbultos'];
		$return['ubica'] = $itemDetails['bodegaed_ubicacio'];
		$return['medida'] = $itemDetails['bodegaed_medidas'];
		$return['docu'] = $itemDetails['bodegaed_documen'];
		
		$return['lento'] = $itemDetails['bodegaed_lenmov'];
		$return['peligro'] = $itemDetails['bodegaed_peligrosa'];
		$return['recol'] = $itemDetails['bodegaed_s_recol'];
	}
	echo json_encode($return);	
	
}//end isset

$bodega->Disconnect();
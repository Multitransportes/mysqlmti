<?php
require_once('../database/Database.php');
require_once('../interface/iBodega.php');
class Bodega extends Database implements ibodega {
	
	public function all_bodegas()
	{
		$oficina = $_SESSION['logged_oficina'];
		$sql = "SELECT *
				FROM bodegaed i 
				INNER JOIN bodegae it 
				ON i.bodegae_id = it.bodegae_id
				where i.bodegaed_oficina = ? 
				ORDER BY i.bodegaed_remitente";
		return $this->getRows($sql, [$oficina]);
	}//end all_bodegas
	
	public function del_bodegaList($b_bodegaed_id)
	{
		$sql = "DELETE FROM bodegaed 
				WHERE bodegaed_id = ?";
		return $this->deleteRow($sql, [$b_bodegaed_id]);
	}//end del_bodegaList

	public function get_bodega($b_bodegaed_id)
	{
		$sql = "SELECT *
				FROM bodegaed
				WHERE bodegaed_id = ?";

		// print_r($sql);

		return $this->getRow($sql, [$b_bodegaed_id]);
	}//end edit_Bodega


	public function add_bodega($b_claveprod,$b_folioce,$b_remitente, $b_cons, $b_destino,$b_nbultos, $b_vol, $b_peso, $b_mercancia,$b_tbultos,$b_ubica,$b_medida,$b_docu,$b_lento,$b_peligro,$b_recol,$b_fecha, $b_oficina,$b_bodegae_id)
	{
		$sql = "INSERT INTO bodegaed(bodegaed_codproduc,bodegaed_folioce,bodegaed_remitente, bodegaed_consigna,bodegaed_destino, bodegaed_n_bultos, bodegaed_volumen, bodegaed_peso_bruto,bodegaed_mercancia,bodegaed_tbultos,bodegaed_ubicacio,bodegaed_medidas,bodegaed_documen, bodegaed_lenmov, bodegaed_peligrosa, bodegaed_s_recol, bodegaed_fecha, bodegaed_oficina, bodegae_id)
				VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?,?,?,?,?,?,?,?,?,?,?)";
		
		//print_r($sql);
		//print_r($b_recol);

		return $this->insertRow($sql, [$b_claveprod,$b_folioce,$b_remitente, $b_cons, $b_destino,$b_nbultos, $b_vol, $b_peso, $b_mercancia,$b_tbultos,$b_ubica,$b_medida,$b_docu,$b_lento,$b_peligro,$b_recol,$b_fecha, $b_oficina,$b_bodegae_id]);

	}//end add_Bodega

	// public function edit_bodega($ibodegaed_id, $iremitente, $ifolioce, $ibodegae_id, $icons, $iame_no, $idestino, $itbultos, $inbultos, $ivol,$ipeso)
	// {
	// 	$sql = "UPDATE bodegaed 
	// 			SET bodegaed_remiente = ?, bodegaed_folioce = ?, bodegae_id = ?, bodegaed_cons1 = ?, bodegaed_ame_no = ?, bodegaed_destino = ?, bodegaed_tbultos = ?, bodegaed_n_bultos = ?, bodegaed_volumen = ?, bodegaed_peso_bruto = ?
	// 			WHERE bodegaed_id = ?";
	// 	return $this->updateRow($sql, [$iremitente, $ifolioce, $ibodegae_id, $icons, $iame_no, $idestino, $itbultos, $inbultos, $ivol, $ipeso, $ibodegaed_id]);

	public function edit_bodega($b_bodegaed_id,$b_claveprod,$b_folioce,$b_remitente, $b_cons, $b_destino,$b_nbultos, $b_vol, $b_peso, $b_mercancia,$b_tbultos,$b_ubica,$b_medida,$b_docu,$b_lento,$b_peligro,$b_recol,$b_empleado_id)
	{
		$sql = "UPDATE bodegaed 
				SET bodegaed_codproduc = ?, bodegaed_folioce = ?, bodegaed_remitente = ?, bodegaed_consigna = ?, bodegaed_destino = ?, bodegaed_n_bultos = ?, bodegaed_volumen = ?, bodegaed_peso_bruto = ?, bodegaed_mercancia = ?, bodegaed_tbultos = ?, bodegaed_ubicacio = ?, bodegaed_medidas = ?, bodegaed_documen = ?, bodegaed_lenmov = ?, bodegaed_peligrosa = ?, bodegaed_s_recol = ?, empleado_id = ?
				WHERE bodegaed_id = ?";

		//print_r($b_docu);
		//print_r($b_recol);

		return $this->updateRow($sql, [$b_claveprod,$b_folioce,$b_remitente, $b_cons, $b_destino,$b_nbultos, $b_vol, $b_peso, $b_mercancia,$b_tbultos,$b_ubica,$b_medida,$b_docu,$b_lento,$b_peligro,$b_recol,$b_empleado_id,$b_bodegaed_id]);
	}//end edit_Bodega

	public function daily_bodegas($date)
	{		
		//$sql = "SELECT *
		//		FROM bodegaed i 				
		//		INNER JOIN bodegae it 
		//		ON i.bodegae_id = it.bodegae_id
		//		ORDER BY i.bodegaed_remitente 
		//		WHERE i.bodegaed_fecha = ?
		//		";
	
		$sql = "SELECT *
				FROM bodegaed i
				WHERE i.bodegaed_fecha = ?
				";	
		return $this->getRows($sql, [$date]);
	}//end daily_bodegas

}//end class Bodega

$bodega = new Bodega();

/* End of file Item.php */
/* Location: .//D/xampp/htdocs/regis/class/Item.php */
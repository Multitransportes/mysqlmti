<?php
require_once('../database/Database.php');
require_once('../interface/ichecador.php');
class Checador extends Database implements ichecador {
	
	public function all_checadors()
	{

		$oficina = $_SESSION['logged_oficina'];
		$cemple = $_SESSION['logged_cemple'];
		$sql = "SELECT *
				FROM checador i 
				where i.checador_oficina = ? 
				and i.checador_cemple = ?";
		return $this->getRows($sql, [$oficina, $cemple]);
	}//end all_checador
	
	public function del_checadorList($b_bodegaed_id)
	{
		$sql = "DELETE FROM bodegaed 
				WHERE bodegaed_id = ?";
		return $this->deleteRow($sql, [$b_bodegaed_id]);
	}//end del_bodegaList

	public function get_checador($b_bodegaed_id)
	{
		$sql = "SELECT *
				FROM bodegaed
				WHERE bodegaed_id = ?";

		// print_r($sql);

		return $this->getRow($sql, [$b_bodegaed_id]);
	}//end edit_Bodega


	public function add_checador($b_claveprod,$b_folioce,$b_remitente, $b_cons, $b_destino,$b_nbultos, $b_vol, $b_peso, $b_mercancia,$b_tbultos,$b_ubica,$b_medida,$b_docu,$b_lento,$b_peligro,$b_recol,$b_fecha, $b_oficina,$b_bodegae_id)
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

	public function edit_checador($b_bodegaed_id,$b_claveprod,$b_folioce,$b_remitente, $b_cons, $b_destino,$b_nbultos, $b_vol, $b_peso, $b_mercancia,$b_tbultos,$b_ubica,$b_medida,$b_docu,$b_lento,$b_peligro,$b_recol,$b_empleado_id)
	{
		$sql = "UPDATE bodegaed 
				SET bodegaed_codproduc = ?, bodegaed_folioce = ?, bodegaed_remitente = ?, bodegaed_consigna = ?, bodegaed_destino = ?, bodegaed_n_bultos = ?, bodegaed_volumen = ?, bodegaed_peso_bruto = ?, bodegaed_mercancia = ?, bodegaed_tbultos = ?, bodegaed_ubicacio = ?, bodegaed_medidas = ?, bodegaed_documen = ?, bodegaed_lenmov = ?, bodegaed_peligrosa = ?, bodegaed_s_recol = ?, empleado_id = ?
				WHERE bodegaed_id = ?";

		//print_r($b_docu);
		//print_r($b_recol);

		return $this->updateRow($sql, [$b_claveprod,$b_folioce,$b_remitente, $b_cons, $b_destino,$b_nbultos, $b_vol, $b_peso, $b_mercancia,$b_tbultos,$b_ubica,$b_medida,$b_docu,$b_lento,$b_peligro,$b_recol,$b_empleado_id,$b_bodegaed_id]);
	}//end edit_Bodega

	public function daily_checador($date)
	{		
		
	    $diaActual=date("d",strtotime($date));
    	$month=date("n",strtotime($date));
     	$year=date("Y",strtotime($date));
   		$ultimoDiaMes=date("d",(mktime(0,0,0,$month+1,1,$year)-1));

   		#print_r($diaActual);

		if($diaActual<=15){
			$fechaini = date("Y/m/d",mktime(0,0,0,$month,1,$year));
			$fechafin = date("Y/m/d",mktime(0,0,0,$month,15,$year));
		}else{
			$fechaini = date("Y/m/d",mktime(0,0,0,$month,16,$year));
			$fechafin = date("Y/m/d",mktime(0,0,0,$month,$ultimoDiaMes,$year));
			#$fechafin = date("Y/m/d",mktime(0,0,0,$month,16,$year));
		}

		#print_r($fechaini);
		#print_r($fechafin);
		$cemple = $_SESSION['logged_cemple'];
		$sql = "SELECT checador_ID, checador_FECHA,checador_HORA, 0 as row_number
				FROM checador i
				WHERE i.checador_fecha between ?
				and ?
				and i.checador_cemple = ?
				";	
		return $this->getRows($sql, [$fechaini, $fechafin, $cemple]);
	}//end daily_checador

	public function daily_checadorxf($fechaini, $fechafin)
	{		
		
		$oficina = $_SESSION['logged_oficina'];
		$sql = "SELECT i.checador_OFICINA,i.checador_CEMPLE, i.checador_FECHA, i.checador_HORA, e.Empleado_nombre
				FROM checador i
			    INNER JOIN empleado e ON i.checador_cemple = e.Empleado_cemple WHERE i.checador_fecha between ?
				and ?
				and i.checador_oficina = ?
				and i.checador_id > 0
				order by e.Empleado_nombre, i.checador_fecha,i.checador_hora
				";	
		return $this->getRows($sql, [$fechaini, $fechafin, $oficina]);
	}//end daily_checador

	//public function daily_checadorxp($date,$datef)
	public function daily_checadorxp($date)
	{		
		
		$oficina = $_SESSION['logged_oficina'];
		$sql = "SELECT i.*, e.Empleado_nombre
				FROM checador i
			    INNER JOIN empleado e ON i.checador_cemple = e.Empleado_cemple
				WHERE i.checador_fecha = ?
				and i.checador_oficina = ?
				order by i.checador_fecha,i.checador_hora
";	
		return $this->getRows($sql, [$date,$oficina]);
	}//end daily_checadorxp

}//end class checador

$checador = new Checador();

/* End of file Item.php */
/* Location: .//D/xampp/htdocs/regis/class/Item.php */

#´para saber el ultimo dato registrado en la base de datos.
#$rs = mysql_query("SELECT MAX(id_tabla) AS id FROM tabla");
#if ($row = mysql_fetch_row($rs)) {
#$id = trim($row[0]);
#}
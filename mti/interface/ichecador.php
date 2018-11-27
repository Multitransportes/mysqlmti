<?php 
interface ichecador{
	public function all_checadors();
	public function del_checadorList($b_checador_id);
	public function get_checador($b_checador_id);

	public function add_checador($b_claveprod,$b_folioce,$b_remitente, $b_cons, $b_destino,$b_nbultos, $b_vol, $b_peso, $b_mercancia,$b_tbultos,$b_ubica,$b_medida,$b_docu,$b_lento,$b_peligro,$b_recol,$b_fecha, $b_oficina,$b_bodegae_id);

	public function edit_checador($b_checador_id,$b_claveprod,$b_folioce,$b_remitente, $b_cons, $b_destino,$b_nbultos, $b_vol, $b_peso, $b_mercancia,$b_tbultos,$b_ubica,$b_medida,$b_docu,$b_lento,$b_peligro,$b_recol,$b_empleado_id);
	
	public function daily_checador($date);

	public function daily_checadorxf($fechaini,$fechafin);
	
	//public function daily_checadorxp($date,$datef);
	public function daily_checadorxp($date);

}//end iBodega
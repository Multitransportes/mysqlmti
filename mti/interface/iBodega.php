<?php 
interface ibodega{
	public function all_bodegas();
	public function del_bodegaList($b_bodegaed_id);
	public function get_bodega($b_bodegaed_id);

	public function add_bodega($b_claveprod,$b_folioce,$b_remitente, $b_cons, $b_destino,$b_nbultos, $b_vol, $b_peso, $b_mercancia,$b_tbultos,$b_ubica,$b_medida,$b_docu,$b_lento,$b_peligro,$b_recol,$b_fecha, $b_oficina,$b_bodegae_id);

	public function edit_bodega($b_bodegaed_id,$b_claveprod,$b_folioce,$b_remitente, $b_cons, $b_destino,$b_nbultos, $b_vol, $b_peso, $b_mercancia,$b_tbultos,$b_ubica,$b_medida,$b_docu,$b_lento,$b_peligro,$b_recol,$b_empleado_id);

	public function daily_bodegas($date);
}//end iBodega
<?php 
interface icliente{
	public function all_cliente();
	public function del_clienteList($b_cliente_id);
	public function get_cliente($b_cliente_id);
	public function get_Cliente_Especifico($b_name);

	//public function add_bodega($b_remitente, $b_cons, $b_nbultos, $b_vol, $b_peso, $b_fecha, $b_oficina, $b_bodegae_id);

	//public function edit_bodega($b_bodegaed_id, $b_remitente, $b_cons, $b_nbultos, $b_vol, $b_peso);

	// public function edit_bodega($ibodegaed_id, $iremitente, $ifolioce, $ibod_id, $icons, $iame_no, $idestino, $itbultos, $inbultos, $ivol, $ipeso);

	public function daily_cliente($date);
}//end iBodega
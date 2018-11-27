<?php
require_once('../database/Database.php');
require_once('../interface/iCliente.php');
class cliente extends Database implements icliente {
	
	public function all_cliente()
	{
		$oficina = $_SESSION['logged_oficina'];
		$sql = "SELECT *
				FROM Cliente i 
				where i.cliente_oficina = ? 
				ORDER BY i.cliente_name";
		return $this->getRows($sql, [$oficina]);
	}//end all_bodegas
	
	public function del_clienteList($b_cliente_id)
	{
		$sql = "DELETE FROM cliente 
				WHERE cliente_id = ?";
		return $this->deleteRow($sql, [$b_cliente_id]);
	}//end del_bodegaList

	public function get_cliente($b_cliente_id)
	{
		$sql = "SELECT *
				FROM cliente
				WHERE cliente_id = ?";
		return $this->getRow($sql, [$b_cliente_id]);
	}//end edit_Bodega

	public function get_Cliente_Especifico($b_name)
	{
		//$sql="SELECT * FROM Cliente WHERE cliente_name LIKE ? ORDER BY cliente_id ASC LIMIT 0, 10";
		$oficina = $_SESSION['logged_oficina'];
		$sql =	"SELECT * 
				FROM Cliente i
				where i.cliente_oficina = ? 
					and i.cliente_NAME LIKE ?
				ORDER BY i.cliente_ID ASC LIMIT 0, 10";
		
		//print_r($sql);
		//print_r($b_name);

		$b_name = "%".$b_name."%";
		return $this->getRows($sql, [$oficina, $b_name]);
	}

	// public function add_bodega($b_remitente1, $b_cons1, $b_nbultos1, $b_vol1, $b_peso1, $b_fecha, $b_oficina, $b_bodegae_id)
	// {
	// 	$sql = "INSERT INTO bodegaed(bodegaed_REMITENTE, bodegaed_CONS1, bodegaed_N_BULTOS, bodegaed_VOLUMEN, bodegaed_PESO_BRUTO, bodegaed_fecha, bodegaed_oficina, bodegae_id)
	// 			VALUES(?, ?, ?, ?, ?, ?, ?, ?)";
		
	// 	return $this->insertRow($sql, [$b_remitente1, $b_cons1, $b_nbultos1, $b_vol1, $b_peso1, $b_fecha, $b_oficina, $b_bodegae_id]);
	// 	//return $this->insertRow($sql, [$iremitente, $ifolioce, $ibodegae_id, $icons, $iame_no, $idestino, $itbultos, $inbultos, $ivol, $ipeso]);

	// }//end add_Bodega

	// public function edit_bodega($b_bodegaed_id, $b_remitente, $b_cons, $b_nbultos, $b_vol, $b_peso)
	// {
	// 	$sql = "UPDATE bodegaed 
	// 			SET bodegaed_remitente = ?, bodegaed_cons1 = ?, bodegaed_n_bultos = ?, bodegaed_volumen = ?, bodegaed_peso_bruto = ?
	// 			WHERE bodegaed_id = ?";
	// 	return $this->updateRow($sql, [$b_remitente, $b_cons, $b_nbultos, $b_vol, $b_peso, $b_bodegaed_id]);
	// }//end edit_Bodega

	public function daily_cliente($date)
	{	
		$sql = "SELECT *
				FROM cliente i
				WHERE i.cliente_edit_date = ?
				";	
		return $this->getRows($sql, [$date]);
	}//end daily_cliente

}//end class cliente

$cliente = new cliente();

/* End of file Item.php */
/* Location: .//D/xampp/htdocs/regis/class/Item.php */
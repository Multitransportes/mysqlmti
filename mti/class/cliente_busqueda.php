<?php
require_once('../class/Cliente.php');

$nombre = $_POST['nombre'];//recibe el nombre a buscar

//print_r($nombre);

//por si quitan los datos de busqueda no mande toda la informacion en pantalla
if ($nombre == ''){
	$nombre = "//";
}
$consulta=$cliente->get_Cliente_Especifico($nombre);// se llama a la funcion

//print_r($consulta);

if($consulta){
	foreach ($consulta as $rs) {
		// se remplaza el termino buscado por el nombre del producto traido de la base de datos (reemplza termino a negrita)
			$nombre = str_replace($_POST['nombre'], '<b>'.$_POST['nombre'].'</b>', $rs['cliente_NAME']);
			// se agrega una nueva opcion a la lista, se indica id, y nombre
		   echo '<li onclick="set_item('.$rs['cliente_ID'].','.'\''.str_replace("'", "\'", $rs['cliente_NAME']).'\')">'.$nombre.'</li>';			
   }
}else{
	//si tiene informacion diferente a la que se mando se imprime no hay...
	if ($nombre != '//'){
	echo '<li>'."No hay resultados".'</li>';
	}
}

?>
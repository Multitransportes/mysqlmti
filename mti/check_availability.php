<?php 
require_once('database/Database.php');
$db = new Database();
if(!empty($_POST["email"])) {
	$email= $_POST["email"];
	$cnt=0;
	$sql = "SELECT email FROM users WHERE email=?";
	$result = $db->getRows($sql, [$email]);

	foreach($result as $x):
	    $cnt++;
	endforeach;
	if($cnt>0)
	{
	echo "<span style='color:red'> el Email ya existe .</span>";
	echo "<script>$('#submit').prop('disabled',true);</script>";
	} else{
	
	echo "<span style='color:green'> Correo electrónico disponible para el registro .</span>";
 	echo "<script>$('#submit').prop('disabled',false);</script>";
	}
}


?>

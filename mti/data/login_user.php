<?php 
require_once('../class/User.php');

if(isset($_POST['un'])){
	$un = $_POST['un'];
	$up = $_POST['up'];

	//print_r($un);
	#print_r($up);

	$up = md5($up);
	
	#print($up);

	$result = $user->user_login($un, $up);
	#print($result);
	if($result > 0){
		// echo 'succ';
		$return['logged'] = true;
		$return['url'] = "dashboard.php";
		// $_SESSION['logged_id'] = $result['user_id'];
		// $_SESSION['logged_type'] = $result['user_type'];
		// $_SESSION['logged_name'] = $result['empleado_nombre'];
		//$_SESSION['logged_cemple'] = $result['empleado_cemple'];
		$_SESSION['logged_oficina'] = $result['oficina'];

		$_SESSION['login']=$_POST['un'];
		$_SESSION['id']=$result['id'];
		$_SESSION['fullName']=$result['fullName'];
		$_SESSION['logged_cemple'] = $result['cemple'];
		$_SESSION['logged_empleadoid'] = $result['empleado_id'];

		//print_r($_SESSION['fullName']);

		$host=$_SERVER['HTTP_HOST'];
		$uip=$_SERVER['REMOTE_ADDR'];
		$status=1;

		$_SESSION['uniqid'] = uniqid();
		$uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');

		// For stroing log if user login successfull
		//$log=mysqli_query($con,"insert into userlog(uid,username,userip,status) values('".$_SESSION['id']."','".$_SESSION['login']."','$uip','$status')");
		
		$result = $user->insert_Row($_SESSION['id'],$_SESSION['login'],$uip,$status);

	}else{
		// echo 'fail';
		$return['logged'] = false;
		$return['msg'] = "Usuario o contraseña invalido !";
	}

	echo json_encode($return);

}//end isset

$user->Disconnect();
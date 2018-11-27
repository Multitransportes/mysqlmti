<?php
session_start();
//error_reporting(0);
require_once('database/Database.php');
include('include/checklogin.php');
check_login();

date_default_timezone_set('America/Mexico_City');// change according timezone
$currentTime = date( 'h:i:s A');
$today = date("y.m.d");

#actualizar las checadas del empleado
if(isset($_POST['submit']))
{

	$pfcheca=$_POST['fcheca'];
	if (!empty($pfcheca)) {
		# code...
		$rest = substr($pfcheca, -4, 4);
		$msg="manda.. ".$rest;
		
	if ($rest=="Registro") {
	}else {
		# code...

		$db = new Database();
		$sql = "select * from empleado where empleado_cemple=?";
		$iemple = $db->getRow($sql, [$rest]);
		
		print_r($iemple);

		$pcemple = 0;
		$poficina = 0;

		foreach($iemple as $i){
			$pcemple = $iemple['empleado_CEMPLE'];
			$poficina = $iemple['empleado_OFICINA'];
		}
		if ($pcemple>0) {
			# code...
			$sql = "INSERT INTO checador (checador_oficina,checador_cemple,checador_fecha,checador_hora) values (?,?,?,?)";
		 	$saveperfil = $db->insertRow($sql,[$poficina,$pcemple,$today,$currentTime]);
			if($saveperfil)	{
				$msg="Su perfil se a actualizado con éxito".$pfcheca;
			}else{
				$msg="Error no se actualizo".$pfcheca;		
			}
			$partes_ruta = pathinfo($_SERVER['PHP_SELF']);
			$extra = $partes_ruta['basename'];
			#$extra="checmex.php";

			$host  = $_SERVER['HTTP_HOST'];
			$uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
			header("location:http://$host$uri/$extra");
			exit();
		}
	}

	#fin del if
	}

}

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>MTI | Asistencia</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta content="" name="description" />
		<meta content="" name="author" />
		<!-- la letra mas definida de multi en encabezado...
		<link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
		-->
		<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="vendor/themify-icons/themify-icons.min.css">
		<link href="vendor/animate.css/animate.min.css" rel="stylesheet" media="screen">
		<link href="vendor/perfect-scrollbar/perfect-scrollbar.min.css" rel="stylesheet" media="screen">
		<link href="vendor/switchery/switchery.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" media="screen">
		<link href="vendor/select2/select2.min.css" rel="stylesheet" media="screen">

		<link href="vendor/bootstrap-datepicker/bootstrap-datepicker3.standalone.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet" media="screen">


		<link rel="stylesheet" href="assets/css/styles.css">
		<link rel="stylesheet" href="assets/css/plugins.css">
		<link rel="stylesheet" href="assets/css/themes/theme-1.css" id="skin_color" />


	</head>
	<body>
		<div id="app">		
			<?php include('include/sidebar.php');?>
			<div class="app-content">
				
				<?php include('include/header.php');?>
						
				<!-- end: TOP NAVBAR -->
				<div class="main-content" >
					<div class="wrap-content container" id="container">

						<!-- start: BASIC EXAMPLE -->
						<div class="container-fluid container-fullw bg-white">
							<div class="row">
								<div class="col-md-12">
									<h5 style="color: green; font-size:18px; ">
									<?php if($msg) { echo htmlentities($msg);}?> </h5>

			                        <h1 class="page-header">
			                            Registro de Asistencia
			                        </h1>
	                    
									<div class="panel-body">
										<form role="form" name="checadorreg" id="checadorreg" method="POST" onsubmit="return checkurl();">
			                        <strong>Entradas diarias:</strong>
			                       <!-- /.row  -->   

							<div class="form-group">
					                <input id="fechaini" name ="fechaini" type="date" class="btn btn-default btn-sm" placeholder="" value="<?= date('Y-m-d');?>"  onchange="showAllChecadorxp();">                   
					                <input id="fechafin" name ="fechafin" type="date" class="btn btn-default btn-sm" placeholder="" value="<?= date('Y-m-d');?>">                   


								<span class="input-icon">
									<input type="text" class="form-control" name="fcheca" id="fcheca" placeholder="Registro" autocomplete="off" autofocus value="Registro" onfocus="if(this.value=='Registro')this.value='';" onblur="if(this.value=='')this.value='Registro';"  pattern="[A-Za-z0-9]{8,20}" title="Un código de seguridad válido consiste en una cadena con 8 a 10 caracteres, cada uno de los cuales es una letra o un dígito" required/>
									<i class="fa fa-user"></i> </span>

<!-- 							<input type="button" name="imprimir" value="Imprimir"  onClick="window.print();"/>
 -->						</div>

			                        <div id="printchec" class="pull-right">
			                            <button type="button" class="btn btn-success btn-sm">
			                                Imprimir
			                                <span class="glyphicon glyphicon-print" aria-hidden="true"></span>
			                            </button>
			                        </div>

			               			<div id="all-checadorxp"></div>

									<button type="submit" name="submit" class="btn btn-o btn-primary" value ="enviar">
										Actualiza
									</button>


									</form>
									</div>	
            					</div>


						
							<!-- end: SELECT BOXES -->
							</div>
							<!-- end: BASIC EXAMPLE -->
						</div>
			</div>
			
			<!-- start: FOOTER -->
	<?php include('include/footer.php');?>
			<!-- end: FOOTER -->
		
			<!-- start: SETTINGS -->
	<?php include('include/setting.php');?>
			
			<!-- end: SETTINGS -->
		</div>
		<!-- start: MAIN JAVASCRIPTS -->
		<script src="vendor/jquery/jquery.min.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="vendor/jquery-cookie/jquery.cookie.js"></script>
		<script src="vendor/modernizr/modernizr.js"></script>
		<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
		<script src="vendor/switchery/switchery.min.js"></script>
		<!-- end: MAIN JAVASCRIPTS -->
		<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<script src="vendor/maskedinput/jquery.maskedinput.min.js"></script>
		<script src="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
		<script src="vendor/autosize/autosize.min.js"></script>
		<script src="vendor/selectFx/classie.js"></script>
		<script src="vendor/selectFx/selectFx.js"></script>
		<script src="vendor/select2/select2.min.js"></script>
		<script src="vendor/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
		<script src="vendor/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<!-- start: CLIP-TWO JAVASCRIPTS -->
		<script src="assets/js/main.js"></script>
		<!-- start: JavaScript Event Handlers for this page -->
		<script src="assets/js/form-elements.js"></script>

		<!--para llamar a las librerias-->
		<script type="text/javascript" src="assets/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="assets/js/regis.js"></script>


		<script>
			jQuery(document).ready(function() {
				Main.init();
				FormElements.init();
			});
		</script>
		<!-- end: JavaScript Event Handlers for this page -->
		<!-- end: CLIP-TWO JAVASCRIPTS -->
	</body>
</html>

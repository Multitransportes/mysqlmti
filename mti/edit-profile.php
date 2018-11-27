<?php
session_start();
//error_reporting(0);
require_once('database/Database.php');
include('include/checklogin.php');
check_login();

date_default_timezone_set('America/Mexico_City');// change according timezone
$currentTime = date( 'd-m-Y h:i:s A', time () );

//para mostrar el correo y el alias
$cnt = 0;
$db = new Database();
$sql = "select * from users where id=?";
$menuu = $db->getRow($sql, [$_SESSION['id']]);
//print_r($menuu);
$fullNamep = "";
foreach($menuu as $i){
	$fullNamep = $menuu['fullName'];
	// $addressp = $menuu['address'];
	// $cityp=$menuu['city'];
	// $genderp=$menuu['gender'];
	$emailp=$menuu['email'];
}

//se muestra la informacion del empleado en el perfil
$db = new Database();
$sql = "select * from empleado where empleado_id=?";
$iemple = $db->getRow($sql, [$_SESSION['logged_empleadoid']]);
//print_r($iemple);
foreach($iemple as $i){
	$pnombre = $iemple['empleado_NOMBRE'];
	$pcurp = $iemple['empleado_CURP'];
	$prfc = $iemple['empleado_RFC'];
	$pssocial = $iemple['empleado_SSOCIAL'];
	$pfecha_nac = $iemple['empleado_FECHA_NAC'];
	$pdomi=$iemple['empleado_DOMICILIO'];
	$ptele=$iemple['empleado_TELEFONO'];
	$pmail=$iemple['empleado_MAIL'];
}

//actualizar el perfil del empleado
if(isset($_POST['submit']))
{
	$fname=$_POST['fname'];
	//$address=$_POST['address'];
	//$city=$_POST['city'];
	//$gender=$_POST['gender'];

	//$sql = "Update users set fullName=?,address=?,city=?,gender=?,updationDate=? where id=?";
 	//$saveperfil = $db->updateRow($sql,[$fname,$address,$city,$gender,$currentTime,$_SESSION['id']]);

	$sql = "Update users set fullName=?,updationDate=? where id=?";
 	$saveperfil = $db->updateRow($sql,[$fname,$currentTime,$_SESSION['id']]);
	if($saveperfil)	{

		$pnombre=$_POST['pnombre'];
		$pdomi=$_POST['pdomi'];
		$pcurp=$_POST['pcurp'];
		$prfc=$_POST['prfc'];

		$sql = "Update empleado set empleado_NOMBRE=?,empleado_DOMICILIO=?,empleado_CURP=?,empleado_RFC=?,empleado_MODIFIEDBY=? where empleado_id=?";
	  	$saveperfil = $db->updateRow($sql,[$pnombre,$pdomi,$pcurp,$prfc,$currentTime,$_SESSION['logged_empleadoid']]);
		if($saveperfil)	{		
			$msg="Su perfil se a actualizado con éxito".$_SESSION['logged_empleadoid'];
		}
	}else{
		$msg="Error no se actualizo".$_SESSION['logged_empleadoid'];		
	}

}

#para incremenar el valor por ejemplo de folios.
//$update_sql = "update tablename set col1 = col1 + 1 where id = 1";

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>MTI | Edit Profile</title>
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
		<!---->
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
									<div class="row margin-top-30">
										<div class="col-lg-8 col-md-12">
											<div class="panel panel-white">
												<div class="panel-heading">
													<h5 class="panel-title">Editar Perfil</h5>
												</div>
												<div class="panel-body">
													<form role="form" name="edit" method="post">
						<div class="form-group">
							<label for="fname">Nombre Corto</label>
							<input type="text" name="fname" class="form-control" value="<?php echo $fullNamep; ?>" >
						</div>
						<div class="form-group">
							<label for="pnombre">Nombre Completo</label>
							<input type="text" name="pnombre" class="form-control" value="<?php echo $pnombre; ?>" >
						</div>
						<div class="form-group">
							<label for="fess">User Email</label>
							<input type="email" name="uemail" class="form-control"  readonly="readonly"  value="<?php echo htmlentities($emailp);?>">
								<a href="change-emaild.php">Actualiza tu Correo Electrónico</a>
						</div>

<div class="panel-group" id="accordion">
  	<!--
  			inicio del uno according...
  	--> 	
  	<div class="panel panel-default">
	    <div class="panel-heading">
	      <h4 class="panel-title">
	        <a class="accordion-toggle" data-toggle="collapse"
	           data-parent="#accordion" href="#uno">
	          Mensajes
	        </a>
	      </h4>
	    </div>
	    <div id="uno" class="panel-collapse collapse in">
	      <div class="panel-body">
	        <p>Curabitur pretium tincidunt lacus...   </p>
	      </div>
	    </div>
  	</div>

  	<!--
  			inicio del segundo according...
  	-->
  	<div class="panel panel-default">
	    <div class="panel-heading">
	      <h4 class="panel-title">
	        <a class="accordion-toggle" data-toggle="collapse"
	           data-parent="#accordion" href="#dos">
	          Checador
	        </a>
	      </h4>
	    </div>
	    <div id="dos" class="panel-collapse collapse">
	      <div class="panel-body">
	        <p>Revisar mis entradas...   </p>

               <strong>Entradas diarias:</strong>
                <input id="fechaini" name ="fecha2" type="date" class="btn btn-default btn-sm" placeholder="" value="<?= date('Y-m-d');?>" onchange="showAllChecador();">                   

               	<div id="all-checador"></div>
	      </div>
	    </div>
  	</div>
  	<!--
  			fin del segundo according...
  	-->
  	<!--
  			inicio del tres according...
  	-->
  	<div class="panel panel-default">
	    <div class="panel-heading">
	      <h4 class="panel-title">
	        <a class="accordion-toggle" data-toggle="collapse"
	           data-parent="#accordion" href="#tres">
	          Solicitud
	        </a>
	      </h4>
	    </div>
	    <div id="tres" class="panel-collapse collapse">
	      <div class="panel-body">
	        <p>Curabitur pretium tincidunt lacus...   </p>
	      </div>
	    </div>
  	</div>
  	<!--
  			fin del tres according...
  	-->

  	<!--
  			inicio del cuarto according...
  	-->  	
  	<div class="panel panel-default">
	    <div class="panel-heading">
	      <h4 class="panel-title">
	        <a class="accordion-toggle" data-toggle="collapse"
	           data-parent="#accordion" href="#cuatro">
	          Datos Generales
	        </a>
	      </h4>      
	    </div>
	    <div id="cuatro" class="panel-collapse collapse">
	      	<div class="panel-body">
				<div class="container-fluid">
				    <div role="tabpanel">
				        <!-- Elementos de navegación con pestañas-->
				        <ul class="nav nav-tabs" id="pestanas" role="tablist">
				            <li role="presentation" class="active">
				                <a href="#general" aria-controls="general" role="tab" data-toggle="tab">General</a>
							</li>
				            <li role="presentation">
				                <a href="#nomina" aria-controls="nomina" role="tab" data-toggle="tab">Nomina</a>
				            </li>
				            <li role="presentation">
				                <a href="#Ojosymanos" aria-controls="Ojosymanos" role="tab" data-toggle="tab">Ojos y manos</a>
				            </li>
				            <li role="presentation">
				                <a href="#equipo" aria-controls="equipo" role="tab" data-toggle="tab">Check</a>
				            </li>
				             <li role="presentation">
				                <a href="#checador" aria-controls="checador" role="tab" data-toggle="tab">Checador</a>
				            </li>
				              <li role="presentation">
				                <a href="#solicitud" aria-controls="solicitud" role="tab" data-toggle="tab">Solicitud</a>
				            </li>           
				        </ul>
				    </div>
				</div>
						<div class="tab-content">
						<!-- El contenido de cada pestaña tiene la clase "tab-pane". No confundir con role="tabpanel" -->
						<!-- Podemos agregar también efectos con la clase "fade". La primera pestaña (activa)
						deberá entonces tener también la clase "in" para aparecer -->
				   	 		<div role="tabpanel" class="tab-pane fade in active" id="general">
	 							<div class="form-group">
									
									<label for="pcurp">Curp</label>
									<input type="text" name="pcurp" class="form-control" value="<?php echo $pcurp; ?>" >
									
									<label for="prfc">RFC</label>
									<input type="text" name="prfc" class="form-control" value="<?php echo $prfc; ?>" >
									
									<label for="pssocial">Seguro Social</label>
									<input type="text" name="pssocial" class="form-control" value="<?php echo $pssocial; ?>" >

									<label for="pfecha_nac">Fecha de Nacimiento</label>
									<input type="text" name="pfecha_nac" class="form-control" value="<?php echo $pfecha_nac; ?>" >	

								</div>
								<div class="form-group">
									<label for="pdomi">Dirección</label>
									<textarea name="pdomi" class="form-control"><?php echo htmlentities($pdomi);?></textarea>
								</div> 
			    			</div>
						    <div role="tabpanel" class="tab-pane fade" id="nomina">
						        <h3 class="page-header">
						    <!--
						    <span class="glyphicon glyphicon-user" aria-hidden="true"></span> Tareas
						    -->
						        </h3>
						        <p>La tarea es un término empleado para referirse a la práctica de una obligación o a la realización de una actividad, en el ámbito laboral.</p>
						    </div>
						    <div role="tabpanel" class="tab-pane fade" id="Ojosymanos">
						        <h3 class="page-header">
						        <!--<span class="glyphicon glyphicon-inbox" aria-hidden="true"></span> Mensajes -->
						        </h3>
						        <p>Proin nec quam sed leo consequat bibendum. Aenean in semper eros,
						        id commodo libero. Nulla vestibulum sapien purus, ut ullamcorper ligula
						        condimentum ac! Ut eget ex nisi. Cras dignissim gravida venenatis. Class aptent
						        taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.
						        Vivamus pulvinar quam a elementum convallis.Cras fringilla aliquam velit. Donec
						        ultrices felis quis augue malesuada; ac scelerisque tortor laoreet. In dignissim
						        sem ac volutpat venenatis. Pellentesque tempus aliquam pellentesque. Aliquam
						        venenatis felis in interdum tristique. Quisque feugiat condimentum tortor eu
						        condimentum. Proin ac tempus purus, faucibus sollicitudin ligula. Integer dictum
						        maximus tortor sit amet mollis. Aliquam tincidunt lacus quis dictum luctus.</p>
						        </div>
						    <div role="tabpanel" class="tab-pane fade" id="equipo">
						        <h3 class="page-header">
						        <!--<span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Configuración-->
						        </h3>
						        <p>Fusce tempus et velit ac consectetur. Vivamus viverra turpis tellus, vitae
						        pharetra justo vestibulum ac.Sed tincidunt mi eget augue venenatis, ac vulputate
						        ligula bibendum! Phasellus vel elit a nunc sodales luctus quis sed lectus.
						        Curabitur purus ante, mollis non vehicula elementum, mattis cursus orci. Aenean
						        egestas congue odio a eleifend. Pellentesque aliquam mattis mi vel ornare.
						        Suspendisse aliquam malesuada nibh, vel tempus nibh porttitor et. Nunc leo eros,
						        laoreet nec diam vitae; consectetur rhoncus metus? Etiam non tempor nibh.</p>
						    </div>
						<!-- fin de tab-content -->
						</div>	
			<!-- fin de panel-body-->
	      	</div>
		<!-- fin de id="cuatro"-->
	    </div>
	<!-- fin de panel-default-->
  	</div>


 </div>


<!--
						<div class="form-group">
							<label for="address">Address</label>
							<textarea name="address" class="form-control"><?php echo htmlentities($addressp);?></textarea>
						</div>
						<div class="form-group">
							<label for="city">City</label>
							<input type="text" name="city" class="form-control" required="required"  value="<?php echo htmlentities($cityp);?>" >
						</div>
						<div class="form-group">
							<label for="gender">Gender</label>
							<input type="text" name="gender" class="form-control" required="required"  value="<?php echo htmlentities($genderp);?>">
						</div>
					-->

						<button type="submit" name="submit" class="btn btn-o btn-primary">
							Actualiza
						</button>
													</form>
											</div>
										</div>
											
											</div>
										</div>
									<div class="col-lg-12 col-md-12">
											<div class="panel panel-white">
												
												
											</div>
										</div>
									</div>
								</div>
						
						<!-- end: BASIC EXAMPLE -->
			
					
						<!-- end: SELECT BOXES -->
						
					</div>
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
		<!---->
		<script src="vendor/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
		
		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<!-- start: CLIP-TWO JAVASCRIPTS -->
		<script src="assets/js/main.js"></script>
		<!-- start: JavaScript Event Handlers for this page -->
		<script src="assets/js/form-elements.js"></script>

		<!--para llamar a las librerias-->
		<script type="text/javascript" src="assets/js/jquery.dataTables.min.js"></script>
		<script type="text/javascript" src="assets/js/regis.js"></script>

<!-- 		<script type="text/javascript">
			$('#demo9')({
				onSelect: function(selectedDate) {
				var dataString = 'date='+selectedDate;
				
				print_r(dataString);

				$.ajax({
						url: 'data/all_checador.php?date='+dataString,
						type: 'get',
						data: {
							date:dataString
						},
						success: function (data) {
							$('#all-checador').html(data);
						},
						error:function(){
							eMsg(474);
						}
					});	
				}
			});			

		</script>
 -->		<script>
			jQuery(document).ready(function() {
				Main.init();
				FormElements.init();
			});
		</script>
		<!-- end: JavaScript Event Handlers for this page -->
		<!-- end: CLIP-TWO JAVASCRIPTS -->
	</body>
</html>

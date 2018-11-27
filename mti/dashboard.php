<?php
session_start();
//error_reporting(0);
//include('include/config.php');
require_once('database/Database.php');
include('include/checklogin.php');
check_login();
$db = new Database();

$sql = "SELECT *
     FROM alumnos"
     ;
$resTotal = $db->getRows($sql);
$cnt = 0;
$cntA1 = 0;
$cntB2 = 0;
$cntC3 = 0;

//cnt Guarda Cantidad total de registros
//$cnt=mysql_num_rows('$resTotal');
foreach($resTotal as $x):
    $cnt++;
endforeach;

$sql = "SELECT *
     FROM alumnos
     where grupo='A'"
     ;
$resA1 = $db->getRows($sql);
//$cntA1=$resA1->num_rows;
foreach($resA1 as $x):
    $cntA1++;
endforeach;

//totalAx convierte la cantidad total de registros en %
$totalA1=$cntA1*100/$cnt;

$sql = "SELECT *
     FROM alumnos
     where grupo='B'"
     ;
$resB2 = $db->getRows($sql);
//$cntB2=$resB2->num_rows;
foreach($resB2 as $x):
    $cntB2++;
endforeach;

$totalB2=$cntB2*100/$cnt;

$sql = "SELECT *
     FROM alumnos
     where grupo='C'"
     ;
$resC3 = $db->getRows($sql);
//$cntC3=$resC3->num_rows;
foreach($resC3 as $x):
    $cntC3++;
endforeach;

$totalC3=$cntC3*100/$cnt;
//se recuperan los datos guardados y son representados en una cadena por medio de un while

foreach($resA1 as $res):
    $A1="{name:'".$res['nombre']."', y:".$totalA1."},";
endforeach;

foreach($resB2 as $res):
    $B2="{name:'".$res['nombre']."', y:".$totalB2."},";
endforeach;

foreach($resC3 as $res):
    $C3="{name:'".$res['nombre']."', y:".$totalC3."}";
endforeach;

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>MTI  | Inicio</title>
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
        <!--el inicio de todo el menu -->
<?php include('include/sidebar.php');?>
        <!--fin de todo el menu -->
			<div class="app-content">
				
						<?php include('include/header.php');?>
						
				<!-- end: TOP NAVBAR -->
				<div class="main-content" >
					<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE 
						<section id="page-title">
							<div class="row">
								<div class="col-sm-8">
									<h1 class="mainTitle">User | Tablero</h1>
																	</div>
								<ol class="breadcrumb">
									<li>
										<span>User</span>
									</li>
									<li class="active">
										<span>Dashboard</span>
									</li>
								</ol>
							</div>
						</section>-->
						<!-- end: PAGE TITLE -->
						<!-- start: BASIC EXAMPLE -->
<!-- 						<div class="container-fluid container-fullw bg-white">
							<div class="row">
								<div class="col-sm-4">
									<div class="panel panel-white no-radius text-center">
										<div class="panel-body">
											<span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-primary"></i> <i class="fa fa-smile-o fa-stack-1x fa-inverse"></i> </span>
											<h2 class="StepTitle">My Profile</h2>
											
											<p class="links cl-effect-1">
												<a href="edit-profile.php">
													Update Profile
												</a>
											</p>
										</div>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="panel panel-white no-radius text-center">
										<div class="panel-body">
											<span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-primary"></i> <i class="fa fa-paperclip fa-stack-1x fa-inverse"></i> </span>
											<h2 class="StepTitle">My Appointments</h2>
										
											<p class="cl-effect-1">
												<a href="appointment-history.php">
													View Appointment History
												</a>
											</p>
										</div>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="panel panel-white no-radius text-center">
										<div class="panel-body">
											<span class="fa-stack fa-2x"> <i class="fa fa-square fa-stack-2x text-primary"></i> <i class="fa fa-terminal fa-stack-1x fa-inverse"></i> </span>
											<h2 class="StepTitle"> Book My Appointment</h2>
											
											<p class="links cl-effect-1">
												<a href="book-appointment.php">
													Book Appointment
												</a>
											</p>
										</div>
									</div>
								</div>
							</div>
						</div> -->
			
<div class="container-fluid">
    <!--
    <h1>Pestañas (JS) en Bootstrap</h1>
    <div class="alert alert-info">Activar la consola web para ver mensajes de eventos</div>
    -->

    <div role="tabpanel">
        <!-- Elementos de navegación con pestañas-->
        <ul class="nav nav-tabs" id="pestanas" role="tablist">
            <li role="presentation" class="active">
                <a href="#grafica" aria-controls="grafica" role="tab" data-toggle="tab">Grafica</a>                
            </li>
            <li role="presentation">
                <a href="#tarea" aria-controls="tarea" role="tab" data-toggle="tab">Tareas</a>
            </li>
            <li role="presentation">
                <a href="#mensajes" aria-controls="mensajes" role="tab" data-toggle="tab">Mensajes</a>
            </li>
            <li role="presentation">
                <a href="#configuracion" aria-controls="configuracion" role="tab" data-toggle="tab">Otro</a>
            </li>
        </ul>
    </div>
</div>					
<!-- Contenedor global para todas las pestañas, con la clase "tab-content" -->
<div class="tab-content">
<!-- El contenido de cada pestaña tiene la clase "tab-pane". No confundir con role="tabpanel" -->
<!-- Podemos agregar también efectos con la clase "fade". La primera pestaña (activa)
deberá entonces tener también la clase "in" para aparecer -->
    <div role="tabpanel" class="tab-pane fade in active" id="grafica">
    <h3 class="page-header">
    <!--
    <span class="glyphicon glyphicon-home" aria-hidden="true"></span> Grafica
    -->
    </h3>
        <!--<h1 align="center">Graficas dinamicas(MTI)</h1>

        Se carga la grafica (debe de estar antes de la ESTRUCTURA de la GRAFICA-->
        <div id="containerg" style="min-width: 210px; height: 300px; max-width: 600px; margin: 0 auto"></div>
        
        <button type="button" class="btn btn-default" id="boton-config">Ir a Configuración</button>
    </div>
    <div role="tabpanel" class="tab-pane fade" id="tarea">
        <h3 class="page-header">
    <!--
    <span class="glyphicon glyphicon-user" aria-hidden="true"></span> Tareas
    -->
        </h3>
        <p>La tarea es un término empleado para referirse a la práctica de una obligación o a la realización de una actividad, en el ámbito laboral.</p>
    </div>
    <div role="tabpanel" class="tab-pane fade" id="mensajes">
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
    <div role="tabpanel" class="tab-pane fade" id="configuracion">
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
</div>						
					
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
		<script src="vendor/modernizr/modernizr.js"></script>
		<script src="vendor/jquery-cookie/jquery.cookie.js"></script>
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

	    <script src="Highcharts-6.0.4/code/highcharts.js"></script>
    	<script src="Highcharts-6.0.4/code/modules/exporting.js"></script>      

    <!--Script de graficas ESTRUCTURA dinamicas-->
    <script type="text/javascript">

    //Highcharts toma como referencia el div con el id 'container' para graficar 
    Highcharts.chart('containerg', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        //type: 'areaspline'
        //type: 'area',
        //type: 'pie',
        type: 'column',
        spacingBottom: 30
    },
     legend: {
        layout: 'vertical',
        align: 'left',
        verticalAlign: 'top',
        x: 150,
        y: 100,
        floating: true,
        borderWidth: 1,
        backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
    },
    title: {
        text: 'Ventas por Mes'
    },
     subtitle: {
        //text: 'Source: <a href="https://github.com/Simon1207">Github: Simon1207</a>'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                style: {
                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                }
            }
        //area: {
           // fillOpacity: 0.5
       // }         
        }
    },
        series: [
    {
        name:'Resultados',
        colorByPoint: true,
        data:[<?php echo $A1; echo $B2; echo $C3;?>]
    }],
   drilldown: {
        series: [{
            name: 'Microsoft Internet Explorer',
            id: 'Microsoft Internet Explorer',
            data: [
                [
                    'v11.0',
                    24.13
                ],
                [
                    'v8.0',
                    17.2
                ],
                [
                    'v9.0',
                    8.11
                ],
                [
                    'v10.0',
                    5.33
                ],
                [
                    'v6.0',
                    1.06
                ],
                [
                    'v7.0',
                    0.5
                ]
            ]
        }, {
            name: 'Chrome',
            id: 'Chrome',
            data: [
                [
                    'v40.0',
                    5
                ],
                [
                    'v41.0',
                    4.32
                ],
                [
                    'v42.0',
                    3.68
                ],
                [
                    'v39.0',
                    2.96
                ],
                [
                    'v36.0',
                    2.53
                ],
                [
                    'v43.0',
                    1.45
                ],
                [
                    'v31.0',
                    1.24
                ],
                [
                    'v35.0',
                    0.85
                ],
                [
                    'v38.0',
                    0.6
                ],
                [
                    'v32.0',
                    0.55
                ],
                [
                    'v37.0',
                    0.38
                ],
                [
                    'v33.0',
                    0.19
                ],
                [
                    'v34.0',
                    0.14
                ],
                [
                    'v30.0',
                    0.14
                ]
            ]
        }, {
            name: 'Firefox',
            id: 'Firefox',
            data: [
                [
                    'v35',
                    2.76
                ],
                [
                    'v36',
                    2.32
                ],
                [
                    'v37',
                    2.31
                ],
                [
                    'v34',
                    1.27
                ],
                [
                    'v38',
                    1.02
                ],
                [
                    'v31',
                    0.33
                ],
                [
                    'v33',
                    0.22
                ],
                [
                    'v32',
                    0.15
                ]
            ]
        }, {
            name: 'Safari',
            id: 'Safari',
            data: [
                [
                    'v8.0',
                    2.56
                ],
                [
                    'v7.1',
                    0.77
                ],
                [
                    'v5.1',
                    0.42
                ],
                [
                    'v5.0',
                    0.3
                ],
                [
                    'v6.1',
                    0.29
                ],
                [
                    'v7.0',
                    0.26
                ],
                [
                    'v6.2',
                    0.17
                ]
            ]
        }, {
            name: 'Opera',
            id: 'Opera',
            data: [
                [
                    'v12.x',
                    0.34
                ],
                [
                    'v28',
                    0.24
                ],
                [
                    'v27',
                    0.17
                ],
                [
                    'v29',
                    0.16
                ]
            ]
        }]
    }   
    });     
        

        </script>
        <!--fin de graficas-->
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

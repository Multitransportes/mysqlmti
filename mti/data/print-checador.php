<style type="text/css">
<!--
    table.page_header {width: 100%; border: none; background-color: #DDDDFF; border-bottom: solid 1mm #AAAADD; padding: 2mm }
    table.page_footer {width: 100%; border: none; background-color: #DDDDFF; border-top: solid 1mm #AAAADD; padding: 2mm}
-->
</style>
<script type="text/javascript">
    //print();
</script>

<?php 
    require_once('../class/checador.php');
   
    $fechaini = $_GET['fechaini'];
    $fechafin = $_GET['fechafin'];
    $dias = array(0=>"Dom","Lun", "Mar", "Mie", "Jue", "Vie", "Sab" );
    $month=date("n",strtotime($fechaini));
    $year=date("Y",strtotime($fechaini));
    $diaActual=(date("d",strtotime($fechaini)));

    #print_r($diaActual);
    #print_r($dias[$ndias]);
    $db = new Database();

    # Obtenemos el dia de la semana del primer dia
    # Devuelve 0 para domingo, 6 para sabado
    $diaSemana=date("w",mktime(0,0,0,$month,1,$year))+7;
    //print_r($diaSemana);
    # Obtenemos el ultimo dia del mes
    $ultimoDiaMes=date("d",(mktime(0,0,0,$month+1,1,$year)-1));
    //print_r($ultimoDiaMes);

    if($diaActual<=15){
      $timestamp = mktime(0, 0, 0, $month, 15, $year);
      #$fechafin = date('Y-m-d', $timestamp);
    }else{
      $timestamp = mktime(0, 0, 0, $month, $ultimoDiaMes, $year);    
      #$fechafin = date('Y-m-d', $timestamp);
    }
    #print_r($fechafin);
    //revisar para que salga con fecha o año
   $checas = $checador->daily_checadorxf($fechaini,$fechafin);
   
   #print_r($checas);

   $diax="";
   $i='';
   $nd=0;
   $quienes = 0;
   #para saber si tiene registro y no nos marque algun error
   $registros=0;
   $xdiasf="";
   #se ponen primero las cabeceras, de lo que va a llevar
   if($diaActual<=15){
    $cabecera=array("orden"=>0,"nombre" => "nombre","1" => "01","2" => "02","3" => "03","4" => "04","5" => "05","6" => "06","7" => "07","8" => "08","9" => "09","10" => "10","11" => "11","12" => "12","13" => "13","14" => "14","15" => "15","numunico" => "numunico");
    }else{
    $cabecera=array("nombre" => "nombre","16","17","18","19","20","21","22","23","24","25","26","27","28","29","30","31","numunico");
        #if($ultimoDiaMes)
    }
    $xcemple = 0;
    $nomx="";
    $sin="";
//     #pasamos los registros a un arreglo que es el que va a leer
//     foreach($checas as $it):
//         #$luis=array("Luis García","645395715","Trabajo");
//         $registros++;
//         $i=date("d",strtotime($it['checador_FECHA']));
//         if($i<>$diax){
//             $diax=$i;
//             $diab=ltrim($i,"0");
//             //$numr=0;
//         }
//         if ($it['checador_CEMPLE']<>$xcemple) {
//             # code...
//             $numr=0;
//             $xcemple=$it['checador_CEMPLE'];
//                 $checadors=$cabecera;
//             // for($nd=1;$nd<=15;$nd++) {
//             //     $timestamp = mktime(0, 0, 0, $month, $nd, $year);
//             //    }
//         }

//         if($diaActual<=15){
//              for($nd=1;$nd<=15;$nd++) {
//                 if($diab==$nd){ 
//                     $numr++;
//                     #$checadors[$it['Empleado_nombre']][$numr][$diab]=$it['checador_HORA'];
//                     $arraydos=array("orden"=>$numr,'nombre' => $it['Empleado_nombre'],$diab => $it['checador_HORA']);
//                     $checadors=$arraydos;
// }
//             }
//        }else{
//             for($nd=16;$nd<=$ultimoDiaMes;$nd++) {
//                 if($diab==$nd){ 
//                     $numr++;
//                     $checadors[$it['Empleado_nombre']][$numr][$diab]=$it['checador_HORA'];
//                     //$checadors[$numr][$it['checador_CEMPLE']][$diab]=$it['checador_HORA'];
//                }
//             }
//        }

    // endforeach;    
    // print_r($checadors);
    $ordenx=0;
    $xemple = 0;    
    $xdias=" ";
    $xhora="";
    $numemp=0;
    $numcol=0;
    $numren=0;
    $dia= array();
    $agenda[0]=$cabecera;
   foreach($checas as $it):
        $registros++;
        $i=date("d",strtotime($it['checador_FECHA']));
        if($xemple<>$it['checador_CEMPLE']){
            $xemple=$it['checador_CEMPLE'];
            $numemp++;
            $dia[$numemp][$numren][0]=$it['Empleado_nombre'];
            $ordenx++;
            if($xdias<>$i){
                $xdias=$i;
                if($xhora<>$it['checador_HORA']){
                    $xhora=$it['checador_HORA'];
                    $numren=1;
                    $dia[$numemp][$numren][$i]=$it['checador_HORA'];
                }
            }else{
                $numren++;
               $dia[$numemp][$numren][$i]=$it['checador_HORA'];
            }
            
        }else{
            if($xdias<>$i){
                $xdias=$i;
                
                if($xhora<>$it['checador_HORA']){
                    $xhora=$it['checador_HORA'];
                    $numcol=$i;
                    $numren=1;
                    $dia[$numemp][1][$i]=$it['checador_HORA'];
                }
            }else{
                if($xhora<>$it['checador_HORA']){
                    $xhora=$it['checador_HORA'];
                    $numren++;
                    $dia[$numemp][$numren][$i]=$it['checador_HORA'];
                }
            }
        }
    endforeach;    
   #print_r($dia);



    #$agenda=array($cabecera,$nomy);
 //print_r($agenda);
//    echo "<br>";

  $i=0;  

// // Mostramos mensaje con el índice de cada  array y los valores que contiene
  // $numunico="163E";
  // for($i=0; $i<count($agenda); $i++) {
  //   echo "<p>Índice  [$i]:<br>";
  //   for($x=0; $x<count($agenda[$i]); $x++) {
  //     if ($numunico==$agenda[$i][$x]) {
  //     echo "Elemento [$x]  -> {$agenda[$i][$x]}<br>";
  //       $ira=$i;
  //       }
  //   }
  //   echo "</p>";
  // }

#$cabecera=array("nombre","telefono","referencia");
#$luis=array("Luis García","645395715","Trabajo");
#$paco=array("Paco Salvatierra","625781225","Amigo");
#$sofia=array("Sofía López","664887221","cliente");
#$pilar=array("Pilar Martinez","674458115","familia");
#$agenda=array($cabecera,$luis,$paco,$sofia,$pilar);
#$agenda=array($cabecera,$nomx);
    // $xps1=1;
    // foreach($dia as $datos2)
    // {
    //     //echo "$datos2[1][$xps1] ";
    //     //$xps1++;
    // foreach($datos2 as $datos3)
    //     {
    //     #echo "$datos3 ";
    //     foreach($datos3 as $dato)
    //         {
    //         echo "$dato ";
    //         }
    //     echo "<br>";
    //     }
    // echo "<br>";
    // }    
    //  print_r($checadors);
// $DatoPersonales = array();
//  $DatoPersonales['Nombre'] = "Alberto";
//  $DatoPersonales['Edad'] = 19;
//  $DatoPersonales['Altura'] = 1.70;
//  $DatoPersonales['Ocupacion'] = "Programador";
 
//     //Otra forma de agregar dato a un arreglo
//     $TablaAlumnos["Persona1"] = array('Nombre' => "Jorge", 'Edad' => 18, 'Altura' => 1.78, 'Ocupacion' => "Dieseñador");
//     $TablaAlumnos["Persona2"] = array('Nombre' => "Luis", 'Edad' => 19, 'Altura' => 1.79, 'Ocupacion' => "Contador");
//     $TablaAlumnos["Persona3"] = array('Nombre' => "Maria", 'Edad' => 20, 'Altura' => 1.82, 'Ocupacion' => "Abogado");
//     $TablaAlumnos["Persona4"] = $DatoPersonales; //agregamos el arreglo anterior como nueva fila de la Tabla

    // foreach ($TablaAlumnos as $TempArray) {
    //  foreach ($TempArray as $key => $value) {
    //   echo $key .": ". $value." ";
    //  }
    //  echo "<br>";
    // }

  // foreach ($TablaAlumnos as $key => $tax) {
  //   foreach ($tax as $value) {
  //     if(array_search('Maria', $value)) $taxonomy = key($tax);
  //   }
  // }    
  //   echo($taxonomy); // this print "sgd" 
  //   $array = array("XSD250","DAO676","LOG543");
?>

<page backtop="14mm" backbottom="14mm" backleft="10mm" backright="10mm" pagegroup="new">
    <page_header>
        <table class="page_header">
            <tr>
                <td style="width: 100%; text-align: left">
                    <center>
                    <h1>Reporte diario de Asistencia</h1>
                    <h2>de</h2>
                    <h3><?= $fechaini; ?> al <?= $fechafin; ?></h3>
                     </center>
                </td>
            </tr>
        </table>

    </page_header>
    <page_footer>
        <table class="page_footer">
            <tr>
                <td style="width: 100%; text-align: right">
                    

<br />
<div class="table-responsive">
        <table id="myTable-checador" class="table table-bordered table-hover table-striped" border="1" width="90%" cellspacing="0">
            <thead>
                <tr>
                    <?php if($diaActual<=15){ ?>
                        <th>Nombre</th>
                        <th>1</th>
                        <th>2</th>
                        <th>3</th>
                        <th>4</th>
                        <th>5</th>
                        <th>6</th>
                        <th>7</th>
                        <th>8</th>
                        <th>9</th>
                        <th>10</th>
                        <th>11</th>
                        <th>12</th>
                        <th>13</th>
                        <th>14</th>
                        <th>15</th>
                    <?php }else{ ?>
                        <th>Nombre</th>
                        <th>16</th>
                        <th>17</th>
                        <th>18</th>
                        <th>19</th>
                        <th>20</th>
                        <th>21</th>
                        <th>22</th>
                        <th>23</th>
                        <th>24</th>
                        <th>25</th>
                        <th>26</th>
                        <th>27</th>
                        <th>28</th>
                        <th>29</th>
                        <?php if($ultimoDiaMes>=30){ ?>
                            <th>30</th>
                        <?php } ?>
                        <?php if($ultimoDiaMes>=31){ ?>
                            <th>31</th>
                        <?php } ?>
                        <?php if($ultimoDiaMes>=32){ ?>
                            <th>32</th>
                        <?php } ?>
                    <?php } ?>
                </th>
            </thead>
            <tbody>
             <?php $rg=0; ?>
                <?php if($registros>0){?>
               <?php foreach($dia as $it1): ?>
                <?php foreach($it1 as $it): ?>
                    <tr align="center" class="<?= $class; ?>">
                        <?php if($diaActual<=15){ ?>
                              <?php if(!empty($it['0'])){ ?>
                                   <td align="left"><?= $it['0']; ?></td>
                                <?php }else{ ?>
                                <td> </td>
                             <?php } ?>
                              <?php if(!empty($it['01'])){ ?>
                                   <td align="left"><?= $it['01']; ?></td>
                                <?php }else{ ?>
                                <td> </td>
                             <?php } ?>
                              <?php if(!empty($it['02'])){ ?>
                                   <td align="left"><?= $it['02']; ?></td>
                                <?php }else{ ?>
                                <td> </td>
                             <?php } ?>
                              <?php if(!empty($it['03'])){ ?>
                                   <td align="left"><?= $it['03']; ?></td>
                                <?php }else{ ?>
                                <td> </td>
                             <?php } ?>
                              <?php if(!empty($it['04'])){ ?>
                                   <td align="left"><?= $it['04']; ?></td>
                                <?php }else{ ?>
                                <td> </td>
                             <?php } ?>
                              <?php if(!empty($it['05'])){ ?>
                                   <td align="left"><?= $it['05']; ?></td>
                                <?php }else{ ?>
                                <td> </td>
                             <?php } ?>
                              <?php if(!empty($it['06'])){ ?>
                                   <td align="left"><?= $it['06']; ?></td>
                                <?php }else{ ?>
                                <td> </td>
                             <?php } ?>
                              <?php if(!empty($it['07'])){ ?>
                                   <td align="left"><?= $it['07']; ?></td>
                                <?php }else{ ?>
                                <td> </td>
                             <?php } ?>
                              <?php if(!empty($it['08'])){ ?>
                                   <td align="left"><?= $it['08']; ?></td>
                                <?php }else{ ?>
                                <td> </td>
                             <?php } ?>
                              <?php if(!empty($it['09'])){ ?>
                                   <td align="left"><?= $it['09']; ?></td>
                                <?php }else{ ?>
                                <td> </td>
                             <?php } ?>
                              <?php if(!empty($it['10'])){ ?>
                                   <td align="left"><?= $it['10']; ?></td>
                                <?php }else{ ?>
                                <td> </td>
                             <?php } ?>
                              <?php if(!empty($it['11'])){ ?>
                                   <td align="left"><?= $it['11']; ?></td>
                                <?php }else{ ?>
                                <td> </td>
                             <?php } ?>
                              <?php if(!empty($it['12'])){ ?>
                                   <td align="left"><?= $it['12']; ?></td>
                                <?php }else{ ?>
                                <td> </td>
                             <?php } ?>
                              <?php if(!empty($it['131'])){ ?>
                                   <td align="left"><?= $it['13']; ?></td>
                                <?php }else{ ?>
                                <td> </td>
                             <?php } ?>
                              <?php if(!empty($it['14'])){ ?>
                                   <td align="left"><?= $it['14']; ?></td>
                                <?php }else{ ?>
                                <td> </td>
                             <?php } ?>
                              <?php if(!empty($it['15'])){ ?>
                                   <td align="left"><?= $it['15']; ?></td>
                                <?php }else{ ?>
                                <td> </td>
                             <?php } ?>
                        <?php }else{ ?>
                              <?php if(!empty($it['0'])){ ?>
                                   <td align="left"><?= $it['0']; ?></td>
                                <?php }else{ ?>
                                <td> </td>
                             <?php } ?>
                              <?php if(!empty($it['16'])){ ?>
                                   <td align="left"><?= $it['16']; ?></td>
                                <?php }else{ ?>
                                <td> </td>
                             <?php } ?>
                              <?php if(!empty($it['17'])){ ?>
                                   <td align="left"><?= $it['17']; ?></td>
                                <?php }else{ ?>
                                <td> </td>
                             <?php } ?>
                              <?php if(!empty($it['18'])){ ?>
                                   <td align="left"><?= $it['18']; ?></td>
                                <?php }else{ ?>
                                <td> </td>
                             <?php } ?>
                              <?php if(!empty($it['19'])){ ?>
                                   <td align="left"><?= $it['19']; ?></td>
                                <?php }else{ ?>
                                <td> </td>
                             <?php } ?>
                              <?php if(!empty($it['20'])){ ?>
                                   <td align="left"><?= $it['20']; ?></td>
                                <?php }else{ ?>
                                <td> </td>
                             <?php } ?>
                              <?php if(!empty($it['21'])){ ?>
                                   <td align="left"><?= $it['21']; ?></td>
                                <?php }else{ ?>
                                <td> </td>
                             <?php } ?>
                              <?php if(!empty($it['22'])){ ?>
                                   <td align="left"><?= $it['22']; ?></td>
                                <?php }else{ ?>
                                <td> </td>
                             <?php } ?>
                              <?php if(!empty($it['23'])){ ?>
                                   <td align="left"><?= $it['23']; ?></td>
                                <?php }else{ ?>
                                <td> </td>
                             <?php } ?>
                              <?php if(!empty($it['24'])){ ?>
                                   <td align="left"><?= $it['24']; ?></td>
                                <?php }else{ ?>
                                <td> </td>
                             <?php } ?>
                              <?php if(!empty($it['25'])){ ?>
                                   <td align="left"><?= $it['25']; ?></td>
                                <?php }else{ ?>
                                <td> </td>
                             <?php } ?>
                              <?php if(!empty($it['26'])){ ?>
                                   <td align="left"><?= $it['26']; ?></td>
                                <?php }else{ ?>
                                <td> </td>
                             <?php } ?>
                              <?php if(!empty($it['27'])){ ?>
                                   <td align="left"><?= $it['27']; ?></td>
                                <?php }else{ ?>
                                <td> </td>
                             <?php } ?>
                              <?php if(!empty($it['28'])){ ?>
                                   <td align="left"><?= $it['28']; ?></td>
                                <?php }else{ ?>
                                <td> </td>
                             <?php } ?>
                              <?php if(!empty($it['29'])){ ?>
                                   <td align="left"><?= $it['29']; ?></td>
                                <?php }else{ ?>
                                <td> </td>
                             <?php } ?>
                              <?php if(!empty($it['30'])){ ?>
                                   <td align="left"><?= $it['30']; ?></td>
                                <?php }else{ ?>
                                <td> </td>
                             <?php } ?>
                              <?php if(!empty($it['31'])){ ?>
                                   <td align="left"><?= $it['31']; ?></td>
                                <?php }else{ ?>
                                <td> </td>
                             <?php } ?>
                          <!--fin del if diaactual-->
                          <?php } ?>
                    </tr>
                 <?php endforeach; ?>
                <?php endforeach; ?>
                <?php } ?>
            </tbody>
        </table>
</div>

                    page [[page_cu]]/[[page_nb]]
                </td>
            </tr>
        </table>
    </page_footer>
    <!--Ceci est la page 1 du groupe 1 nes-->
</page>
<page pageset="old">
    <!--Ceci est la page 2 du groupe 1 axel -->

</page>

<?php 
$checador->Disconnect();
 ?>
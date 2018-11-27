<?php 
    require_once('../class/checador.php');
    $fechaini = $_GET['fechaini'];
    #$fechafin = $_GET['fechafin'];
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
      $fechafin = date('Y-m-d', $timestamp);
    }else{
      $timestamp = mktime(0, 0, 0, $month, $ultimoDiaMes, $year);    
      $fechafin = date('Y-m-d', $timestamp);
    }
    #print_r($fechafin);
    //revisar para que salga con fecha o año
   $checas = $checador->daily_checadorxf($fechaini,$fechafin);
   
   #print_r($checas);
   $diax="";
   $i='';
   $nd=0;
   #para saber si tiene registro y no nos marque algun error
   $registros=0;
    foreach($checas as $it):
        $registros++;
    endforeach;

    for($nd=1;$nd<=15;$nd++) {
        $timestamp = mktime(0, 0, 0, $month, $nd, $year);
        $checadors[0][$nd]=date('Y-m-d', $timestamp);
        }

    #pasamos los registros a un arreglo que es el que va a leer
    foreach($checas as $it):
        $i=date("d",strtotime($it['checador_FECHA']));
        if($i<>$diax){
            $diax=$i;
            $diab=ltrim($i,"0");
            $numr=0;
        }

        if($diaActual<=15){
             for($nd=1;$nd<=15;$nd++) {
                if($diab==$nd){ 
                    $numr++;
                    $checadors[$numr][$diab]=$it['checador_HORA'];
               }
            }
       }else{
            for($nd=16;$nd<=$ultimoDiaMes;$nd++) {
                if($diab==$nd){ 
                    $numr++;
                    $checadors[$numr][$diab]=$it['checador_HORA'];
               }
            }
       }

    endforeach;

?>
 
 <center>
    <h1>Reporte diario de Asistencia</h1>
    <h2>de</h2>
    <h3><?= $fechaini; ?></h3>
 </center>
<br />
        <table id="myTable-checador" class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <?php if($diaActual<=15){ ?>
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
               <?php foreach($checadors as $it): ?>
                    <tr align="center" class="<?= $class; ?>">
                          <?php if($diaActual<=15){ ?>
                             <?php for($i=1;$i<=15;$i++) { ?>
                                <?php if(!empty($it[$i])){ ?>
                                    <td align="left"><?= $it[$i]; ?></td>
                                <?php }else{ ?>
                                    <td> </td>
                                <?php } ?>
                            <!--fin del for -->
                            <?php } ?>
                         <?php }else{ ?>
                            <?php for($i=16;$i<=$ultimoDiaMes;$i++) { ?>
                                <?php if(!empty($it[$i])){ ?>
                                    <td align="left"><?= $it[$i]; ?></td>
                                <?php }else{ ?>
                                    <td> </td>
                                <?php } ?>
                            <!--fin del for -->
                            <?php } ?>
                          <!--fin del if diaactual-->
                          <?php } ?>
                        <?php $rg++; ?>
                    </tr>
                <?php endforeach; ?>
                <?php } ?>
            </tbody>
        </table>

<?php 
$checador->Disconnect();
 ?>
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
   
   print_r($checas);
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

/**
 * Html2Pdf Library - example
 *
 * HTML => PDF converter
 * distributed under the OSL-3.0 License
 *
 * @package   Html2pdf
 * @author    Laurent MINGUET <webmaster@html2pdf.fr>
 * @copyright 2017 Laurent MINGUET
 */
require_once dirname(__FILE__).'/../vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

try {
    ob_start();
    include dirname(__FILE__).'../../data/print-checadordos.php';
    $content = ob_get_clean();

    $html2pdf = new Html2Pdf('P', 'Letter','fr');
    $html2pdf->writeHTML($content);
    $html2pdf->output('example13.pdf');
} catch (Html2PdfException $e) {
    $html2pdf->clean();

    $formatter = new ExceptionFormatter($e);
    echo $formatter->getHtmlMessage();
}

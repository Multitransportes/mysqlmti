<?
//Inicio Funciones
function fechaNumero($f,$opc){
    $f = preg_replace("#[,.\/ ]#","-",$f);
    if(!$opc){
        list($d,$m,$a) = explode("-",$f);
        $fecha = mktime(0,0,0,$m,$d,$a)/(60 * 60 * 24);
    }else
    $fecha = explode("-",$f);
    return $fecha;
}
 
function diasemana($d) {
    $sem = array("Do","Lu","Ma","Mi","Ju","Vi","Sa");
    return $sem[$d];
}
//Término Funciones
 
 
//Inicio Clase
class claseTablaDias {
    function validarDatos($fecha_inicio,$fecha_fin){
        $f1 = fechaNumero($fecha_inicio,0);
        $f2 = fechaNumero($fecha_fin,0);
        $this->fi = $fecha_inicio;
        $this->dif_dias = $f2 - $f1 + 1;
        if($this->dif_dias>0) {
            $this->crearTablaDias();
        }else{
            print "error datos";
        }
    }
    
    function crearTablaDias(){
        print "<table border=\"1\" cellpadding=\"2\" cellspacing=\"2\">\n";
        for($row=0;$row<3;$row++){
            list($d,$m,$a) = fechaNumero($this->fi,1);
            print "<tr>\n";
            for($i==0 ; $i<$this->dif_dias ;$i++){
                print "<td align=\"center\">";
                $dia = diasemana(date("w",mktime(0,0,0,$m,$d,$a)));
                $fechadia = date("j",mktime(0,0,0,$m,$d,$a));
                if($row==0)
                print $dia;
                elseif($row==1)
                print $fechadia;
                elseif($row==2){
                    ##################### CONECTAR BASE DATOS #####################
                    $consulta = "SELECT checador_fecha FROM checador WHERE checador_fecha='$a-$m-$d'";
                    $query = mysql_query($consulta);
                    if(mysql_num_rows($query))
                    $valor=1;
                    else
                    $valor=0;
                    ##################### DESCONECTAR BASE DATOS #####################
                    if($valor==1 && $dia!="Do")
                    print "x";
                    else
                    print "&nbsp;";
                }
                $d++;
                print "</td>";
            }
            print "</tr>\n";
            $i=0;
        }
        print "</table>";
    }
}
//Término Clase
 
 
 
//se crea el constructor
$const = new claseTablaDias;
//se ingresan los datos, fecha de incio, fecha de termino, array de asistencia
$const->validarDatos("01-9-2018","15-9-2018");
?>
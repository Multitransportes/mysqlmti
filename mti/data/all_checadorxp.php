<?php 
    require_once('../class/checador.php');

    date_default_timezone_set('America/Mexico_City');// change according timezone
    $currentTime = date( 'd-m-Y h:i:s A', time () );
    $date = $_GET['date'];
    //$datef = $_GET['datef'];

    //revisar para que salga con fecha o año
   //$checadors = $checador->daily_checadorxp($date,$datef);
   $checadors = $checador->daily_checadorxp($date);
   
   #print_r($checadors);

 ?>
<div class="table-responsive">
        <table id="myTable-checadorxp" class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th><center></center></th>
                    <th>empleado</th>
                    <th>Fecha</th>
                    <th>Nombre</th>
                    <th>Hora</th>
                </th>
            </thead>
            <tbody>
             <?php $rg=0; ?>
               <?php foreach($checadors as $it): ?>
                    <tr align="center" class="<?= $class; ?>">
                        <td><input type="checkbox" name="bodega" value="<?= $it['checador_ID']; ?>"></td>
                        <td align="left"><?= $it['checador_CEMPLE']; ?></td>
                        <td align="left"><?= $it['checador_FECHA']; ?></td>
                        <td align="left"><?= $it['Empleado_nombre']; ?></td>
                        <td align="left"><?= $it['checador_HORA']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
</div>

<br /><br /><br /><br /><br />

<!-- for the datatable of checador -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#myTable-checadorxp').DataTable();//para que salga el filtro y cuantos muestra en la tabla
    });
</script>

<?php 
$checador->Disconnect();
 ?>
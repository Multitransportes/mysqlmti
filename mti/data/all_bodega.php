<?php 
    require_once('../class/bodega.php');

    date_default_timezone_set('America/Mexico_City');// change according timezone
    $currentTime = date( 'd-m-Y h:i:s A', time () );
    $date = $_GET['date'];
    //ya se usa la fecha de busqueda
    //$dailySales = $sales->daily_sales($date);

    //revisar para que salga con fecha o año
   $bodegas = $bodega->daily_bodegas($date);

    //antes se buscaba todo lo que habia
    // $bodegas = $bodega->all_bodegas();

     //echo '<pre>'
     //print_r($date);
     //print_r($bodegas);
     //echo '</pre>';
 ?>
<div class="table-responsive">
        <table id="myTable-bodega" class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th><center></center></th>
                    <th>ID</th>
                    <th>Remitente</th>
                    <th>Consignatario</th>
                    <th><center>Bultos</center></th>
                    <th><center>volumen</center></th>
                    <th>Peso</th>
                    <th>
                        <center>Acciones</center>
                    </th>
            </thead>
            <tbody>
                <?php foreach($bodegas as $it): ?>

                    <tr align="center" class="<?= $class; ?>">
                        <td><input type="checkbox" name="bodega" value="<?= $it['bodegaed_ID']; ?>"></td>
                        <td align="left"><?= $it['bodegaed_ID']; ?></td>
                        <td align="left"><?= $it['bodegaed_remitente']; ?></td>
                        <td align="left"><?= $it['bodegaed_consigna']; ?></td>
                        <td><?= $it['bodegaed_n_bultos']; ?></td>
                        <td align="left"><?= $it['bodegaed_volumen']; ?></td>
                        <td><?= number_format($it['bodegaed_peso_bruto'], 2); ?></td>
                        <td>
                           <center>
                               <button onclick="editModalbodega('<?= $it['bodegaed_ID']; ?>');" type="button" class="btn btn-warning btn-xs">Editar
                                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                </button>
                           </center>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
</div>


<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />

<!-- for the datatable of bodega -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#myTable-bodega').DataTable();//para que salga el filtro y cuantos muestra en la tabla
    });
</script>

<?php 
$bodega->Disconnect();
 ?>
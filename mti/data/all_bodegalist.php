<?php 
require_once('../class/Bodega.php');
$stockList = $stock->all_BodegaList();

// echo '<pre>';
//     print_r($stockList);
// echo '</pre>';
 ?>
<br />
<div class="table-responsive">
        <table id="myTable-bodegalist" class="table table-bordered table-hover table-striped">
            <thead>
                <tr>
                    <th><center></center></th>
                    <th>Remitente</th>
                    <th>Carta de Porte</th>
                    <th>Consignatario</th>
                    <th><center>Manifiesto</center></th>
                    <th><center>Destino</center></th>
                    <th><center>Bultos</center></th>
                    <th><center>T.Bulto</center></th>
                    <th>Peso</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $dateNow = date('Y-m');
                    foreach($stockList as $sl): 
                    $xDate = strtotime($sl['stock_expiry']);
                    $xDate = date('Y-m', $xDate);
                    $class = "text-success";
                    if($xDate == $dateNow){ 
                        $class = "text-warning";
                    }
                ?>
                    <tr  align="center" class="<?= $class; ?>">
                        <td><input type="checkbox" name="stock" value="<?= $sl['stock_id']; ?>"></td>
                        <td align="left"><?= $sl['item_code']; ?></td>
                        <td align="left"><?= ucwords($sl['item_name']); ?></td>
                        <td align="left"><?= $sl['item_type_desc']; ?></td>
                        <td><?= $sl['stock_manufactured']; ?></td>
                        <td><?= $sl['stock_purchased']; ?></td>
                        <td><?= "$ ".number_format($sl['item_price'],2); ?></td>
                        <td><?= $sl['stock_qty']; ?></td>
                        <td align="left" width="110px;"><?= $sl['stock_expiry']; ?>
                            <?php if($xDate <= $dateNow): ?>
                                <span class="label label-danger">!</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
</div>


<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />

<!-- for the datatable of employee -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#myTable-stocklist').DataTable();
    });
</script>

<?php 
$stock->Disconnect();
 ?>
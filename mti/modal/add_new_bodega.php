<?php 
// require_once('database/Database.php');

//$types = $db->getRows($sql);
// echo '<pre>';
// 	print_r($types);
// echo '</pre>';
 ?>
				
			        <!-- add_new -->
					<div class="modal fade" id="modal-bodega">
						<div class="modal-dialog">
						<!--<div class="bs-bodega">-->
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									<h4 class="modal-title">Modal title</h4>
								</div>
								<div class="modal-body">
									<!--
									<form class="form-inline" role="form" id="form-bodega">
									-->
									<form class="form-horizontal" role="form" id="form-bodega">

									<input type="hidden" id="bode-id">

									  <div class="form-group">
									    <!---->
									    <label class="control-label col-sm-3" for="">Clave de Producto:</label>								    	
									    <div class="col-sm-9">
									      <input type="text" class="form-control" name="clavprod" id="bode-clavprod" placeholder="Ingresa la Clave de Producto" maxlength="20" autofocus="autofocus" onkeyup="javascript:this.value=this.value.toUpperCase();" autocomplete="off">
									    </div>
									  </div>

									  <div class="form-group">
									    <!---->
									    <label class="control-label col-sm-3" for="">Carta de Porte:</label>								    	
									    <div class="col-sm-9">
									      <input type="text" class="form-control" name="folioce" id="bode-folioce" placeholder="Ingresa la Carte de Porte" maxlength="20" autofocus="autofocus" onkeyup="javascript:this.value=this.value.toUpperCase();" autocomplete="off">
									    </div>
									  </div>

									  <div class="form-group">
									    <!---->
									    	<label class="control-label col-sm-3" for="">Remitente:</label>								    	
									    <div class="col-sm-9">
									      <input type="text" class="form-control" name="nombre" id="bode-remitente" placeholder="Ingresa el nombre del Remitente" required="" maxlength="50" autofocus="autofocus" onkeyup="javascript:this.value=this.value.toUpperCase(); autocompletar() " autocomplete="off">
									      <ul id="lista_id"></ul>
									    </div>
									  </div>

									  <div class="form-group">
									    <!---->
									    	<label class="control-label col-sm-3" for="">Consignatario:</label>
									    <div class="col-sm-9">
									      <input type="text"  class="form-control" id="bode-cons" placeholder="Ingresa el Consignatario" required="" autofocus="" onkeyup="javascript:this.value=this.value.toUpperCase();">
									    </div>
									  </div>		
									  			

									  <div class="form-group">
									    <!---->
									    	<label class="control-label col-sm-3" for="">Destino:</label>
									    <div class="col-sm-9">
									      <input type="text"  class="form-control" name="destino" id="bode-destino" placeholder="Ingresa el Destino" required="" autofocus="" onkeyup="javascript:this.value=this.value.toUpperCase();">
									    </div>
									  </div>										  							  
									  <div class="form-group">
									    <!---->
									    <label class="control-label col-sm-3" for="">Bultos:</label>
									    <div class="col-sm-9"> 
									      <input type="text" class="form-control" id="bode-nbultos" placeholder="Ingresa los bultos" required="" onKeyPress="return numeros(event)">
									    </div>
									  </div>

									  <div class="form-group">
									    <!---->
									    	<label class="control-label col-sm-3" for="">Volumen:</label>
									    <div class="col-sm-9">
									      <input type="text" class="form-control" id="bode-vol" placeholder="Ingresa el volumen" required="" autofocus="" onKeyPress="return numeros(event)">
									    </div>
									  </div>

									  <div class="form-group">
									    <!---->
									    	<label class="control-label col-sm-3" for="">Peso:</label>
									    <div class="col-sm-9">
									      <input type="text" class="form-control" id="bode-peso" placeholder="Ingresa el peso" required="" autofocus="" onKeyPress="return numeros(event)" >
									    </div>
									  </div>

									  <div class="form-group">
									    <!---->
									    <label class="control-label col-sm-3" for="">Mercancia:</label>
									    <div class="col-sm-9">
									      <input type="text"  class="form-control" id="bode-mercancia" placeholder="Ingresa Nombre de Mercancia" required="" autofocus="" onkeyup="javascript:this.value=this.value.toUpperCase();">
									    </div>
									  </div>										  

									  <div class="form-group">
									   	<label class="control-label col-sm-3" for="">Tipo de Bultos:</label>
									    <div class="col-sm-9">
									      <input type="text"  class="form-control" id="bode-tbultos" placeholder="Ingresa el tipo de bultos" required="" autofocus="" onkeyup="javascript:this.value=this.value.toUpperCase();">
									    </div>
									  </div>	

									  <div class="form-group">
									   	<label class="control-label col-sm-3" for="">Ubicación:</label>
									    <div class="col-sm-9">
									      <input type="text"  class="form-control" id="bode-ubica" placeholder="Ingresa la ubicación" autofocus="" onkeyup="javascript:this.value=this.value.toUpperCase();">
									    </div>
									  </div>	

									  <div class="form-group">
									   	<label class="control-label col-sm-3" for="">Medidas:</label>
									    <div class="col-sm-9">
									      <textarea class="form-control" id="bode-medida" placeholder="Ingresa las Medidas" name="Medidas">
									      </textarea>
									    </div>
									  </div>	

									  <div class="form-group">
									   	<label class="control-label col-sm-3" for="">Documento:</label>
									    <div class="col-sm-9">
									      <textarea class="form-control" id="bode-docu" placeholder="Ingresa la Documentación" name="Documento">
									      </textarea>
									    </div>
									  </div>	

<!-- 									  <div class="form-group">
									    <label class="control-label col-sm-3" for="">Lento Movimiento:</label>
									    <div class="col-sm-9"> 
									      <input type="text" class="form-control" id="bode-lento" placeholder="Ingresa lento Movimiento" required="" onKeyPress="return numeros(event)">
									    </div>
									  </div>
									  <div class="form-group">
									    <label class="control-label col-sm-3" for="">Peligroso:</label>
									    <div class="col-sm-9"> 
									      <input type="text" class="form-control" id="bode-peligro" placeholder="Ingresa peligroso" required="" onKeyPress="return numeros(event)">
									    </div>
									  </div>
									  <div class="form-group">
									    <label class="control-label col-sm-3" for="">Recolección:</label>
									    <div class="col-sm-9"> 
									      <input type="text" class="form-control" id="bode-recol" placeholder="Ingresa Recolección" required="" onKeyPress="return numeros(event)">
									    </div>
									  </div> -->

<!-- 									  <div class="form-group">
									    <div class="col-sm-9">
											<div>
												<input type="checkbox" name="checklent" id="bode-lento" class="badgebox"/>
	            								<label for="">Lento Movimiento</label>
												<input type="checkbox" name="checkpeli" id="bode-peligro" class="badgebox" value = "1"/>
	            								<label for="">Peligroso</label>
												<input type="checkbox" name="checkreco" id="bode-recol"/>
	            								<label for="">Recolección</label>
            								</div>
									    </div>
									  </div>	
 -->
<!--      <div> 
            <label for="mes" name="">Mes de temporada:</label> <br /> 
                <input type='checkbox' name="mes[]"* value="enero">Enero 
                <input type='checkbox' name="mes[]"* value="febrero">Febrero 
                <input type='checkbox' name="mes[]"* value="marzo">Marzo 
                <input type='checkbox' name="mes[]"* value="abril">Abril 
                <input type='checkbox' name="mes[]"* value="abril">Mayo 
                <input type='checkbox' name="mes[]"* value="abril">Junio 
                <input type='checkbox' name="mes[]"* value="abril">Julio 
                <input type='checkbox' name="mes[]"* value="abril">Agosto 
                <input type='checkbox' name="mes[]"* value="abril">Septiembre 
                <input type='checkbox' name="mes[]"* value="abril">Octubre 
                <input type='checkbox' name="mes[]"* value="abril">Noviembre 
                <input type='checkbox' name="mes[]"* value="abril">Diciembre 
        </div>  -->

									  <!--
									  <div class="form-group">
									    <label class="control-label col-sm-3" for="">Tipo:</label>
									    <div class="col-sm-9"> 
									      <select id="bodega-type" class="btn btn-default">
									      	<?php foreach($types as $t): ?>
									      		<option value="<?= $t['bodega_type_id']; ?>"><?= ucwords($t['bodega_type_desc']); ?></option>
									      	<?php endforeach; ?>
									      </select>
									    </div>
									  </div>
									-->

									  <div class="form-group"> 
									    <div class="col-sm-offset-2 col-sm-10">
									      <button type="submit" id="submit-bodega" value="add" class="btn btn-default">Guardar datos
									      <span class="glyphicon glyphicon-save" aria-hidden="true"></span>
									      </button>
									    </div>
									  </div>
									</form>
									
								</div>
								<div class="modal-footer">
								</div>
							</div>
						</div>
					</div>


<?php 
$db->Disconnect();
 ?>
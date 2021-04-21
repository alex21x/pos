  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Registrar Rubro</h4>
      </div>
      <div class="modal-body">
       <form id="formRubro">
       	<input type="hidden" id="id" name="id" value="<?php echo $tipo_cliente_rubro->tcr_id?>">
       	<div class="row">
       		<div class="col-md-12">
       			<div class="form-group">
       				<label for="nombre">Nombre</label>
       				<input type="text" id="nombre" name="nombre" class="form-control input-sm" value="<?php echo $tipo_cliente_rubro->tcr_nombre?>">
       			</div>
       		</div>
       	</div><br><br>
        <div class="col-md-12">
           <table class="table table-condensed table-xs">
                <thead>
                  <tr class="info">
                    <th>Precio01</th>
                    <th>Precio02</th>
                    <th>Precio03</th>
                    <th>Precio04</th>
                    <th>Precio05</th>                    
                  </tr>
                </thead>
                <tbody>
                  <?PHP 
                    switch ($tipo_cliente_rubro->tcr_precio_text) {
                      case 'prod_precio_publico':
                              $prod_precio_publico = 'CHECKED';
                        break;
                      case 'prod_precio_2':
                              $prod_precio_2 = 'CHECKED';
                        break;
                      case 'prod_precio_3':
                              $prod_precio_3 = 'CHECKED';
                        break;
                      case 'prod_precio_4':
                              $prod_precio_4 = 'CHECKED';
                        break;
                      case 'prod_precio_5':
                              $prod_precio_5 = 'CHECKED';
                        break;                      
                      default:
                        # code...
                        break;
                    }
                  ?>
                  <tr>
                    <td><div class="custom-control custom-checkbox">
                        <input type="radio" class="custom-control-input" id="prod_precio_publico" name="precio" value="prod_precio_publico" <?= $prod_precio_publico ?>>
                        <label class="custom-control-label" for="defaultIndeterminate2"></label></div>
                    </td>                    
                    <td><div class="custom-control custom-checkbox">
                        <input type="radio" class="custom-control-input" id="prod_precio_2" name="precio" value="prod_precio_2" <?= $prod_precio_2 ?>>
                        <label class="custom-control-label" for="defaultIndeterminate2"></div>
                    </td>
                    <td><div class="custom-control custom-checkbox">
                        <input type="radio" class="custom-control-input" id="prod_precio_3" name="precio" value="prod_precio_3" <?= $prod_precio_3 ?>>
                        <label class="custom-control-label" for="defaultIndeterminate2"></label></div>
                    </td>
                    <td><div class="custom-control custom-checkbox">
                        <input type="radio" class="custom-control-input" id="prod_precio_4" name="precio" value="prod_precio_4" <?= $prod_precio_4 ?>>
                        <label class="custom-control-label" for="defaultIndeterminate2"></label></div>
                    </td>
                    <td><div class="custom-control custom-checkbox">
                        <input type="radio" class="custom-control-input" id="prod_precio_5" name="precio" value="prod_precio_5" <?= $prod_precio_5 ?>>
                        <label class="custom-control-label" for="defaultIndeterminate2"></label></div>
                    </td>                    
                  </tr>
                  <?php //endforeach?>
                </tbody>
              </table>
        </div>

       </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="btn_guardar_tcRubro">Guardar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
  <script>
  	$(document).ready(function(e){

  		//guardar
  		$("#btn_guardar_tcRubro").click(function(e){
  			e.preventDefault();
  			$(".has-error").removeClass('has-error');  			
  			$.ajax({
  				url:'<?php echo base_url()?>index.php/tipo_cliente_rubros/guardarTipoClienteRubro',
  				dataType:'json',
  				data:$("#formRubro").serialize(),
  				method:'post',
  				success:function(response){
  					if(response.status == STATUS_FAIL)
  					{
  						if(response.tipo == '1')
  						{
  							var errores = response.errores;
  							toast('error', 1500, 'Faltan ingresar datos.');
  							$.each(errores, function(index, value){
  								$("#"+index).parent().addClass('has-error');
  							});
  						}
  					}
  					if(response.status == STATUS_OK)
  					{
  						toast('success', 1500, 'se registro la rubro');
  						dataSource.read();
  						$("#myModal").modal('hide');
  					}
  				}
  			});  					
  		});
  	});
  </script>

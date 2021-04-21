
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Registrar Tipo de Enfermedad</h4>
      </div>
      <div class="modal-body" style="height:200px;">
       <form id="formEspecialidad">
       	<input type="hidden" id="id" name="id" value="<?php echo $cie->id;?>">
       	<div class="row">
       		<div class="col-md-12">       			
            <div class="form-group">
              <label for="descripcion">Descripcion</label>
              <input type="text" id="descripcion" name="descripcion" class="form-control input-sm" value="<?php echo $cie->descripcion;?>">
              
            </div>                                    
       		</div>
       	</div>
        <div class="row">
          <div class="col-md-12">             
            <div class="form-group">
              <label for="descripcion">Codigo</label>
              <input type="text" id="codigo" name="codigo" class="form-control input-sm" value="<?php echo $cie->codigo;?>">
            </div>                                    
          </div>
        </div>
       </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" id="btn_guardar_especialidad">Guardar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
  <script>
  	$(document).ready(function(e){
  		//guardar
  		$("#btn_guardar_especialidad").click(function(e){
  			e.preventDefault();
  			$(".has-error").removeClass('has-error');

  			$.ajax({
  				url:'<?php echo base_url()?>index.php/cie/guardarCie',
  				dataType:'json',
  				data: $("#formEspecialidad").serialize(),
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
  						toast('success', 1500, 'se registro la especialidad');
  						dataSource.read();
  						$("#myModal").modal('hide');
  					}
  				}
  			});  					
  		});
  	});
  </script>

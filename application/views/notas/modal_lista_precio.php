<!--metodo implementado-->
<div class="modal-dialog" id="myModal01" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Seleccione Precio</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          
          <form>
	       	<div class="row">
	       		<div class="col-md-12">
              <?php if(count($producto)>0):?>
              <table class="table table-bordered table-xs">
                <thead>
                  <tr>
                    <th>Precio01</th>
                    <th>Precio02</th>
                    <th>Precio03</th>
                    <th>Precio04</th>
                    <th>Precio05</th>                    
                  </tr>
                </thead>
                <tbody>
                  <?php //foreach($producto as $precio):?>
                  <tr>
                    <td><div class="custom-control custom-checkbox">
                        <input type="radio" class="custom-control-input" id="precio_1" name="precio" value="<?php echo $producto->prod_precio_publico;?>" checked="">
                        <label class="custom-control-label" for="defaultIndeterminate2"><?php echo $producto->prod_precio_publico;?></label></div>
                    </td>                    
                    <td><div class="custom-control custom-checkbox">
                        <input type="radio" class="custom-control-input" id="precio_2" name="precio" value="<?php echo $producto->prod_precio_2?>">
                        <label class="custom-control-label" for="defaultIndeterminate2"><?php echo $producto->prod_precio_2?></label></div>
                    </td>
                    <td><div class="custom-control custom-checkbox">
                        <input type="radio" class="custom-control-input" id="precio_3" name="precio" value="<?php echo $producto->prod_precio_3?>">
                        <label class="custom-control-label" for="defaultIndeterminate2"><?php echo $producto->prod_precio_3?></label></div>
                    </td>
                    <td><div class="custom-control custom-checkbox">
                        <input type="radio" class="custom-control-input" id="precio_4" name="precio" value="<?php echo $producto->prod_precio_4?>">
                        <label class="custom-control-label" for="defaultIndeterminate2"><?php echo $producto->prod_precio_4?></label></div>
                    </td>
                    <td><div class="custom-control custom-checkbox">
                        <input type="radio" class="custom-control-input" id="precio_5" name="precio" value="<?php echo $producto->prod_precio_5?>">
                        <label class="custom-control-label" for="defaultIndeterminate2"><?php echo $producto->prod_precio_5?></label></div>
                    </td>                    
                  </tr>
                  <?php //endforeach?>
                </tbody>
              </table>
              

              <div class="text-center">
                  <div id="images_gallery">
                      <div class='col-md-12' align='center'>
                      <a class='example-image-link' href='"+objeto_url+"' data-lightbox='example-1'>
                          <img src="<?= base_url().'images/productos/'.$producto->prod_imagen;?>">
                    </a>
                    </div>
                  </div>
                </div>
                <div class="col-md-4"></div>  
               <div class="col-md-4" class="text-center" style="margin-top: 30px">
                  <label class="text-center">Categoria</label>
                   <input type="text" class="form-control" name="" id="" value="<?= $producto->cat_nombre?>" maxlength="9" required="" readonly>
               </div>
               <div class="col-md-4"></div>
               <div class="col-md-6" style="margin-top: 10px">
                <label class="text-center">Linea</label>
                   <input type="text" class="form-control" name="" id="" value="<?= $producto->lin_nombre?>" maxlength="9" required="" readonly>
               </div>
               <div class="col-md-6" style="margin-top: 10px">
                 <label class="text-center">Marca</label>
                   <input type="text" class="form-control" name="" id="" value="<?= $producto->mar_nombre?>" maxlength="9" required="" readonly>
               </div>
                <div class="col-md-12" style="margin-top: 10px">
                 <label class="text-center">Observaciones</label>
                 <textarea class="form-control" name="" rows="4" cols="50" required="" readonly><?=$producto->prod_observaciones?></textarea>
                   
               </div>
              
              <?php else:?>
              <h3>El producto no cuenta con otros precios.</h3>
              <?php endif?>
              <!--<button type="button" class="btn btn-primary" id="btn_ant_agregar_anticipo">Agregar</button>-->
            </div>

          </div>          

      	</form>
                 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn_cerrar" data-dismiss="modal">Volver</button>
        <button type="button" class="btn btn-primary btn_agrega_precio">Seleccionar Precio</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
 $(".btn_agrega_precio").on("click", function(){
    //console.log(_item);
        
    var precio = $("input[name='precio']:checked").val();        
    //$("#importe").val(precio);     
    
    $(".precioSelected").val(precio);
    
    var _item = $(".precioSelected").parents('.cont-item');
    cmp.calcular(_item);    
    $(".precioSelected").removeClass("precioSelected");
    $("#myModalPrecio").modal('hide');
});

$(".close,.btn_cerrar").on("click", function(){
    $(".precioSelected").removeClass("precioSelected");
}); 

  
</script>
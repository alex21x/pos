<style type="text/css">

@media (min-width:0px) {
 .imgListaProducto{
  width: 150px;
  height: 150px;
  }
  #listaProductos{
    height: 650px;
  }
  .total_a_pagarPos{
    font-size: 50px;
    font-weight: bold;
  }
  .generarComprobante{
    font-size: 35px;
    font-weight: bold;
  }
  .items{
    height: 650px;  
}}   

@media (min-width: 768px) {
  .imgListaProducto{
  width: 150px;
  height: 150px;
  }
  #listaProductos{
    height: 650px;
  }
  .total_a_pagarPos{
    font-size: 50px;
    font-weight: bold;
  }
  .generarComprobante{
    font-size: 35px;
    font-weight: bold;
  }
  .items{
    height: 650px;  
}}

@media (min-width: 992px) {
  .imgListaProducto{
  width: 150px;
  height: 150px;
  }
  #listaProductos{
    height: 650px;
  }
  .total_a_pagarPos{
    font-size: 50px;
    font-weight: bold;
  }
  .generarComprobante{
    font-size: 35px;
    font-weight: bold;
  }
  .items{
    height: 650px;  
}}      

@media (min-width: 1200px) {
  .imgListaProducto{
  width: 150px;
  height: 150px;
  }
  #listaProductos{
    height: 650px;
  }
  .total_a_pagarPos{
    font-size: 50px;
    font-weight: bold;
  }
  .generarComprobante{
    font-size: 35px;
    font-weight: bold;
  }
  .items{
    height: 650px;  
}}      
@media (min-width: 1500px) {
  .imgListaProducto{
    width: 150px;
    height: 150px;
  }
  #listaProductos{
    height: 650px;
  }
  .total_a_pagarPos{
    font-size: 50px;
    font-weight: bold;
  }
  .generarComprobante{
    font-size: 35px;
    font-weight: bold;
  }
  .items{
    height: 650px; 
}}

</style>
<script type="text/javascript">  
  /* DETALLE DE CAMBIO      / AUTOR               / FECHA
     *-----------------------------------------------------------   
     * PRODUCTO POS        / ALEXADER FERNANDEZ / 20-04-2021 */

     listaProductos(1);         
      $(document).on("change","#producto",function(){        
          listaProductos(1);          
     });     

     $(document).on("change","#categoria",function(){
          listaProductos(1);
     });

    $(document).on('click','.pagination li a', function(){
        //$('.items').html('<div class="loading"><img src="images/loading.gif" width="70px" height="70px"/><br/>Un momento por favor...</div>');
        var page = $(this).attr('data');  
        listaProductos(page);

    });


     //LECTOR DE CODIGO DE BARRAS ALEXANDER FERNANDEZ 10-11-2020      
    function agregarItem(productoId,qty,stock,blur){
        
        var qty = qty;
        var cantidad_1 = 0;
        var repetidos = 0;
        var ele = '';
        var itemListHeight = '';

         if(stock <= 0) {//PRODUCTO SIN SOTCK                                               
                  cmp.playSound('error.mp3');
                  cantidad_1 = 1;
                  toast('error', 1500, 'Producto sin Stock!');
                  //window.toastr.error("This product is out of stock!", "Warning!");
                  return false;                  
         }
                        
            var tabla = $('#tabla > tbody > tr');

            if(typeof(tabla.length) !== 'undefined'){
              $.each(tabla,function(indice,value){   
              
              var codProducto =  $(this).find('#item_id').val();              
              
                //$scope.itemQuantity = stock - $scope.prevQuantity;
                //if ((qty > stock || $scope.itemQuantity >= stock)) {                            
              if(codProducto == productoId){
                var cantidad =  $(this).find('#cantidad').val();
                var ele = $(this);

                //console.log($(this));
                prevCantidad = parseFloat(cantidad) + parseFloat(qty);
                if(qty > stock || prevCantidad > stock) {                                                
                  cmp.playSound('error.mp3');
                  cantidad_1 = cantidad;                  
                  toast('error', 1500, 'Producto sin Stock!');
                  $(this).find('#cantidad').val(stock);
                  var parent = $(this);
                  cmp.calcular(parent);                
                  //window.toastr.error("This product is out of stock!", "Warning!");
                  return false;                  
                }
                  //cantidad++;
                  if(blur == 1) qty--;
                  cantidad = parseFloat(cantidad) + parseFloat(qty);
                  $(this).find('#cantidad').val(cantidad);
                  repetidos++;
                  if(blur != 1)cmp.playSound('access.mp3');
                  $('#producto').val('');
                  $('#producto').focus();              

                if(repetidos > 0) cantidad = 1;
                var parent = $(this);
                cmp.calcular(parent);
                cantidad_1 = cantidad;                
              }
            });              
              if(cantidad_1 > 0) productoId = '';             
          }

         //var ele = $("#invoice-item-"+response.data.p_id).parent();  
                if (ele.length) {
                    itemListHeight = ele.position().top;
                } else {
                    itemListHeight += 61;
                }    
                //$("#tabla").animate({ scrollTop: itemListHeight }, 1).perfectScrollbar("update");
                setTimeout(function() {
                    if (!ele.length) {
                        ele = $("#tabla tr:last");
                    }
                    var flashColor = "#d9edf7";
                    //var flashColor = "#19c2f9";                    
                    var originalColor = ele.css("backgroundColor");
                    ele.css("backgroundColor", flashColor);
                    setTimeout(function (){
                      ele.css("backgroundColor", originalColor);
                    }, 300);
          }, 100);

        if (cantidad_1 < 1){
            $('#agrega').trigger('click');

            _item  = $('#tabla tr:last');
            //console.log(_item);
            _item.find('#producto').focus();
            _item.find('#producto').val(productoId);

            //bar = barcode;
            $.post('<?PHP echo base_url();?>index.php/productos/selectPrecioCodProducto',{
                codProducto : productoId             
                },function(data){               
                
                var data_item = '<input class="val-descrip"  type="hidden" value="'+ data.prod_id + '" name = "item_id[]" id = "item_id" >';
                _item.find('#data_item').html(data_item);                
                _item.find('#descripcion').attr("readonly",true);
                _item.find('.descripcion-item').val(data.prod_nombre);
                _item.find('#medida').val(data.prod_medida);                
                //_item.find('#codBarra').val(bar);
                _item.find('.importe').val(data.prod_precio_publico);
                _item.find('.importeCosto').val(data.prod_precio_compra);

                //PRESENTACION PRODUCTO - ALEXANDER FERNANDEZ 27-10-2020
                $.ajax({
                    url: '<?= base_url();?>index.php/productos/selectPresentacionVenta/'+data.prod_id,
                    dataType: 'HTML',
                    method: 'GET',
                    success: function(data){
                        _item.find('#presentacion').append(data);                        
                        presentacion(parent);
                    }
                });

                $('#producto').val('');
                $('#producto').focus();                                                                                                      
                var parent = _item.find('.descripcion-item').parents().parents().get(0);                             
                cmp.calcular(parent);                                           
                },'json');


             cmp.playSound('access.mp3');
             barcode = '';
        }
        else if(code==9)// Tab key hit
        {         
        }else if(code==13 && (barcode.length == 0)){
            barcode = '';
        }
        else
        {          
          barcode=barcode+String.fromCharCode(code);
        }    
    }

     function listaProductos(page){
        var page = page;
        //$page = NUM_ITEMS_BY_PAGE;        
        var pageSize = 20;
        var skip = (page - 1) * pageSize;
        var productoText =  $("#producto").val();
        var categoria = $("#categoria").val();

        $.ajax({
          url: '<?= base_url()?>index.php/comprobantes/listaProductosPos',
          method: 'POST',
          dataType: 'HTML',
          data: {productoText : productoText,categoria: categoria,pageSize: pageSize,page:page,skip:skip},
          success: function(response){
              
              $('#listaProductos').fadeIn(2000).html(response);
              $('.pagination li').removeClass('active');
              $('.pagination li a[data="'+skip+'"]').parent().addClass('active');              

              var rowProducto = $("#rowProducto").val();
              var codProducto = $("#codProducto").val();              
              var stockProducto = $("#stockProducto").val();
              if(rowProducto == 1){
                agregarItem(codProducto,1,stockProducto);
              }
          }
      })
     }


     function addItemPos(productoId,blur){

        $.ajax({
          url: '<?= base_url()?>index.php/comprobantes/addItemPos',
          method: 'POST',
          dataType: 'JSON',
          data: {productoId : productoId},
          success: function(response){              
                agregarItem(response.prod_id,1,response.prod_stock,blur);
          }
      })
     }     

     $(document).on('click','.addItem',function(){
        var productoId = $(this).parent().parent().find('#item_id').val();
        //var cantidad = $(this).parent().parent().find('#cantidad').val();
        
        addItemPos(productoId,0);
     });

     $(document).on('blur','.cantidad',function(){
        var productoId = $(this).parent().parent().find('#item_id').val();
        var cantidad = $(this).parent().parent().find('#cantidad').val();        
        addItemPos(productoId,1);
     });


     $(document).on('click','.decreaseItem',function(){
        var cantidad = $(this).parent().parent().find('#cantidad').val();

        cantidad--;
        if(cantidad >=1){
            $(this).parent().parent().find('#cantidad').val(cantidad);            
            cmp.playSound('modify.mp3');                       
            refescar();
        }else{
            cmp.playSound('error.mp3');
            toast('error', 1500, 'Error! cantidad');
        }             
    });

</script>

<!-- COMPROBANTE CSS -->
<link rel="stylesheet" href="<?PHP echo base_url()?>assets/css/comprobante.css">
<div id="mensaje"></div>
     
<div class="container-fluid">
<div class="col-xs-6 col-md-6 col-lg-6">
  <div class="row">
    <div class="col-xs-4 col-md-offset-8 col-lg-4">
      <label for="prod_categoria">Categoria</label>
      <select class="form-control col-lg-6" id="categoria" name="prod_categoria">
                  <option value="">Seleccione</option>
                  <?php foreach ($categoria as $value): ?>
                    <option value="<?php echo $value->cat_id;?>" <?php if($value->cat_id == $producto->prod_categoria_id):?> selected <?php endif?> > <?php echo $value->cat_nombre;?></option>  
                  <?php endforeach ?>                              
      </select>
    </div><br><br><br><br><br>
  </div>
  <div class="row">
    <div class="col-xs-12 col-md-12 col-lg-12">
      <input type="text" class="form-control" name="producto" id="producto" placeholder="BUSCAR PRODUCTO"> 
        <div id="listaProductos"></div>
      <button href="#" id="total_a_pagarPos" name="total_a_pagarPos" class="btn btn-info btn-block total_a_pagarPos"></button>
    </div>

  </div>  
</div>  
<div class="col-xs-6 col-md-6 col-lg-6">
<input type="hidden" id="auto" value="<?php echo $configuracion->facturador_auto;?>">

<form id="formComprobante" class="form-horizontal" autocomplete="off">
    <input type="hidden" id="pse_token" name="pse_token" value="<?= $empresa['pse_token']?>">
    <input type="hidden" name="igvActivo" id="igvActivo" value="<?= $rowIgvActivo->valor?>">
    <input type="hidden" name="anticipo" id="anticipo" value="0">
    <input type="hidden" name="precio_text" id="precio_text">    
<div class="row">        
        <div class="col-md-12">
            <!--<div style="text-align: center"><h3>COMPROBANTE DE PAGO - <b><?= $empresa['empresa']?></b></h3></div>-->
            <div style="text-align: left" id="mensaje"></div>            
            
            <div class="panel panel-info" >
                <div class="panel-heading" >
                    <div class="panel-title">COMPLETE DATOS DEL COMPROBANTE</div>                        
                </div>
                <div class="panel-body items">                     
                    <div class="form-group" style="padding-top:20px;">    
                        <div class="col-md-12 form-inline col-lg-12">                            
                             <select class="form-control" name="operacion" id="operacion" style="display: none;">
                                <?php if($adjunto_estado!=0){ ?>
                                  <option value="0101" <?php echo ($adjunto_datos->tipo_operacion=="0101")?"SELECTED":"";?>>Venta Interna</option> 
                                  <option value="0200" <?php echo ($adjunto_datos->tipo_operacion=="0200")?"SELECTED":"";?>>Exportación</option>
                                <?php }else{ ?>
                                   <option value="0101" >Venta Interna</option> 
                                   <option value="0200" >Exportación</option>
                                <?php } ?>
                             </select>                            
                        </div>                    
                        <div class="col-md-3 col-lg-2 input_cliente">
                             <label class="control-label" style="width: 100%;text-align: left;">Cliente:</label>                     

                             <?php if($adjunto_estado!=0){ 
                                  if($adjunto_datos->tipo_cliente_id==1){$tdoc="DNI";}else if($adjunto_datos->tipo_cliente_id==2){$tdoc="RUC";}else{$tdoc="SIN DOC";}
                             ?>
                                <input type="text" class="form-control " list="lista_clientes" id="cliente" onkeyup="buscar_cliente()" onchange="seleccionar_cliente()" value="<?php echo $tdoc.' '.$adjunto_datos->ruc.' '.$adjunto_datos->razon_social;?>">
                                <input type="hidden" name="cliente_id" id="cliente_id" required="" value="<?php echo $adjunto_datos->cliente_id;?>">
                             <?php }else{ ?>  
                                <input type="text" class="form-control"  id="cliente" value="CLIENTES VARIOS">
                                <div id="data_cli"><input type="hidden" name="cliente_id" id="cliente_id" required="" value="1"></div>
                             <?php } ?>                                   
                                <input type="hidden" name="ruc_sunat" id="ruc_sunat">
                                <input type="hidden" name="razon_sunat" id="razon_sunat">
                                <input type="hidden" name="pago_monto" id="pago_monto">                     
                        </div>
                        <div class="col-xs-12 col-sm-3 col-md-2 col-lg-1 input_busqueda"><br>
                            <button type="button" id="nuevo_cliente" class="btn btn-primary btn-sm btn_buscar" data-toggle='modal' data-target='#myModalNuevoCliente'>NUEVO</button>                        
                            <button type="button" id="nuevo_cliente" class="btn btn-primary btn-sm btn_buscar" onclick="consulta_sunat()">BUSCAR</button> 
                        </div>                          
                        <div class="col-xs-12 col-md-3 col-lg-3" style="display: none">
                            <label class="control-label">Dirección:</label>
                            <?php if($adjunto_estado!=0){ ?>
                                <input type="text" class="form-control" name="direccion" id="direccion" value="<?php echo $adjunto_datos->direccion_cliente;?>"> 
                            <?php }else{ ?>
                                <input type="text" class="form-control" name="direccion" id="direccion" value="LIMA">
                            <?php } ?>      
                            
                        </div>                                                                              
                    </div>  

                    <div class="row" id="valida">
                                <div class="col-xs-12 col-md-12 col-lg-12" id="invoice-item-list">
                                    <table id="tabla" class="table" border="0">
                                        <thead>
                                            <tr style="background-color: #848484;color: #FFF">
                                                <th class="col-sm-1">Cant.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                                                <th class="col-sm-1" style="display: none;">Unid. Medida</th>
                                                <!--<th class="col-sm-1">Serie .&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>-->
                                                
                                                <th colspan="2" class="col-sm-2">Descripcion</th>
                                                <th class="col-sm-3">Tipo Igv&nbsp;&nbsp;</th>
                                                <th class="col-sm-1">Precio&nbsp;&nbsp;</th> 
                                                <th class="col-sm-1">&nbsp;</th>    
                                                <!--<th>Sub Total</th>  -->                                                
                                                <?php
                                                 if ($configuracion->descuento) {
                                                    echo "<th>Descuento</th>";
                                                 } else {
                                                    echo "<th style='display:none;'> Descuento</th>";
                                                 }?>                                                                          
                                                <th class="col-sm-2">Total</th>
                                                <th></th>  
                                            </tr>
                                        </thead>                    
                                        <tbody>                                                      
                                        </tbody>                    
                                        </table>   
                                    <button type="button" id="agrega" class="btn btn-primary btn-sm">Agregar Item</button>
                                    <button type="button" id="agrega_sin" onclick="agregar_fila_sin_stock()" class="btn btn-primary btn-sm" style="background: #E67E22;border:0;">Agregar sin stock</button>
                                    <button type="button" id="btn_buscar_producto" class="btn btn-info btn-sm"  data-toggle="modal" data-target="#myModalProducto" data-keyboard='false' data-backdrop='static'>Buscar Producto</button>
                                </div> 
                            </div>            
                            <div id="mostrar"></div>
                            <div id="uu"></div>

                </div>        
            </div>            
        </div>
    </div>




    <div class="row" style="padding-top:20px;">
        <div class="col-md-12 col-lg-12">                
                    <input type="hidden" name="ajaxId" id="ajaxId" value="<?= $ajaxId;?>"/>
                    <button type="button" id="guardar"  class="btn btn-primary btn-lg btn-block generarComprobante" style="background: #1ABC9C;border:0;" data-toggle='modal' data-target='#myModalPagoMonto' data-keyboard='false' data-backdrop='static'>Generar Comprobante de Pago</button>                                    
        </div> 
    </div> 
    </form>
    </div>
</div> 



<script src="<?PHP echo base_url(); ?>assets/js/libComprobante.js"></script>
<script src="<?PHP echo base_url(); ?>assets/js/comprobante.js"></script>
<script src="<?PHP echo base_url(); ?>assets/js/validar.js"></script>

<script type="text/javascript"> 

    function consulta_sunat(){
        var num = $("#cliente").val();

        if(num!=''){
        if(num.length == 8){//DNI
            $.getJSON('https://mundosoftperu.com/reniec/consulta_reniec.php',{dni:num})
             .done(function(json){                
                if(json[0].length!=undefined){
                    var dni = json[0];
                    var nombres = json[2]+' '+json[3]+' '+json[1];
                    $("#cliente_id").val('nApi');
                    $("#cliente").val("DNI "+ dni +" "+ nombres);
                    $("#direccion").val('LIMA');
                    $("#ruc_sunat").val(dni);
                    $("#razon_sunat").val(nombres);                     
                    toast("success", 1500, 'Datos encontrados con exito');
                 }else{
                    toast("error",3000, 'Número no existe');
                 }
             });     
        }else if(num.length == 11){//RUC
            toast("info",4000, 'Buscando . . .');
            $.getJSON('https://mundosoftperu.com/sunat/sunat/consulta.php',{nruc:num})
             .done(function(json){
      
                 if(json.result.RUC.length!=undefined){
                    $("#cliente_id").val('jApi');
                    $("#cliente").val("RUC "+json.result.RUC+" "+json.result.RazonSocial);
                    $("#direccion").val(json.result.Direccion);
                    $("#ruc_sunat").val(json.result.RUC);
                    $("#razon_sunat").val(json.result.RazonSocial);                     
                    toast("success", 1500, 'Datos encontrados con exito');
                 }else{
                    toast("error",3000, 'Número no existe en SUNAT');
                 }
             });
        }else{
            toast("error",3000, 'DEBE DE INGRESAR UN DNI/RUC CORRECTO');            
        }} else{         
             toast("error",3000, 'Ingrese número de documento de búsqueda');
        }
    }
    

    var array_adelanto_items = [];

    $("#btn_buscar_guia").click(function(){
         var guia = $("#numero_guia").val();
         $.getJSON("<?PHP echo base_url()?>index.php/comprobantes/buscar_guia",{guia})
          .done(function(json){
               
               $("#tabla > tbody tr").remove();

             if(json.det.length>0){  
               $.each(json.det,function(index,value){
                  array_adelanto_items.push(value.notapd_producto_id);
                  var fila = '<tr class="cont-item">';     
                      fila += '<td class="col-sm-4"> <input class="form-control descripcion-item" rows="2" id="descripcion" name="descripcion[]" required="" value="'+ value.notapd_descripcion +'" readonly><div id="data_item"><input type="hidden" name="item_id[]" id="item_id" value="'+ value.notapd_producto_id +'"></div> </td>';   


                 
                  fila += '<td style="border:0;"><input type="text" class="form-control" readonly name="medida[]" id="medida" value="'+ value.notapd_medida +'"></td>';

                      
                      fila += '<td><input type="number" id="cantidad" name="cantidad[]"  class="form-control cantidad" value="'+ value.notapd_cantidad +'"></td>';
                      fila += '<td class="col-sm-2">';
                      fila += '<select class="form-control tipo_igv" id="tipo_igv" name="tipo_igv[]">';
                        <?php foreach($tipo_igv as $value):?>
                          
                           fila += '<option value = "<?PHP echo $value['id'];?>"><?PHP echo $value['tipo_igv']?></option>';
                         
                        <?php endforeach?>
                      fila += '</select>'
                      fila += '</td>';
                      fila += '<td><input type="number" id="importe" name="importe[]" required="" class="form-control importe" value="'+ value.notapd_precio_unitario +'"></td>';
                          /*fila += '<td><input type="text" id="subtotal" name="subtotal[]" class="form-control" readonly=""></td>';*/
                        fila += '<input type="hidden" id="igv"  name="igv[]" class="form-control"  readonly="" >';
                            <?php if ($configuracion->descuento): ?>                    
                                fila += '<td><input type="text" id="desc_uni"  name="descuento[]" class="form-control"   ></td>';
                            <?php else: ?>
                                fila += '<td style="display:none;"><input type="text" id="desc_uni"  name="descuento[]" class="form-control"   ></td>';
                            <?php endif ?>

                        fila += '<td><input type="text" id="total" name="total[]" class="form-control totalp" value="'+ value.notapd_subtotal +'" readonly=""></td>';
                        fila += '<td class="eliminar"><span class="glyphicon glyphicon-remove"></span></td>';
                        fila += '</tr>';
                     
                     $("#tabla").css("display","block");  
                     $("#tabla > tbody").append(fila);
                     calcular(); 
               });

               if(json.ade==1){
                 $("#adelanto_items").val(JSON.stringify(array_adelanto_items));
               }
               
               $("#cliente").val(json.cli.razon_social);
               $("#cliente_id").val(json.cli.id);
               $("#direccion").val(json.doc.notap_cliente_direccion);

            }else{
                 toast("error", 1500, "Documento ya fue usado o no se encuentra");
                 $("#cliente").val('');
                 $("#cliente_id").val('');
                 $("#direccion").val('');
                 $("#adelanto_items").val('');
            }              
          });
    });
   
    // GUARDAR COMPROBANTE 03-08-2020 ALEXANDER FERNANDEZ
    $("#guardarComprobante").click(function(e){

        $('#guardarComprobante').prop('disabled',true);
        $('.btn_cerrar').prop('disabled',true);        
        $.ajax({
            method:'post',
            url:'<?PHP echo base_url()?>index.php/comprobantes/guardar_comprobante',
            data:$("#formComprobante").serialize(),
            dataType:'json',
            success:function(response){
                if(response.status == STATUS_FAIL)
                {
                    toast("error",3000, response.msg);
                    $('#guardarComprobante').prop('disabled',false);
                    $('.btn_cerrar').prop('disabled',false);
                }
                if(response.status == STATUS_OK)
                {
                    
                    if($("#auto").val() == 1) { 
                         send_xml(response.cpe_id);
                    }else{     
                         toast("success", 1500, 'Comprobante registrado');                         
                         setTimeout(function() { 
                           location.href='<?PHP echo base_url()?>index.php/comprobantes/index/'+response.cpe_id;
                         }, 2000);
                    }       
                }
            }
        });        
    });   

    //CLOSE MODALPAGO
    $(".close,.btn_cerrar").on("click", function(){
        $(".precioSelected").removeClass("precioSelected");
        $('#guardarComprobante').prop('disabled',false);
    });     

    function send_xml(comprobante_id){
            toast("info",10000, 'Enviando a SUNAT . . .');
            $.getJSON("<?PHP echo base_url(); ?>index.php/comprobantes/getDatosXML",{comprobante_id})
            .done(function(json){
                var datosJSON = JSON.stringify(json);
                $.post("<?php echo RUTA_API?>index.php/Sunat/send_xml",{datosJSON})
                 .done(function(res){
                    var response;
                    try{
                             response = JSON.parse(res);
                             if(response.res == 1){
                                
                                     $.post("<?PHP echo base_url(); ?>index.php/comprobantes/updateEstadoCDR",{comprobante:comprobante_id,firma:response.firma})
                                     .done(function(res){
                                          toast("success", 4000, response.msg); 
                                          setTimeout(function() { 
                                             location.href='<?PHP echo base_url()?>index.php/comprobantes/index/'+comprobante_id;
                                          }, 2000);
                                     })
                             }

                    }catch(e){
                            console.log(res);
                            toast("error",6000,res);
                            location.href='<?PHP echo base_url()?>index.php/comprobantes';
                          
                    }

                           
                })

            });
    }

    jQuery(document).ready(function($) {
 
        $("#fecha_de_emision").change(function(event) {
            /* Act on the event */
            var fecha = $(this).val();
            $("#fecha_de_vencimiento").val(fecha);
            //console.log(fecha);
        });

        $("#datos").hide();
        $("#limitado_detalle").hide();

        $("#tipo_cliente").change(function () {
            var op = $("#tipo_cliente option:selected").val();
            var array = op.split('xx-xx-xx');
            $("#datos").show();
            if (array[0] == 1) {
                $("#lbl_DNI_RUC").html('DNI <label style="color: red;">(*)</label>');
                $("#ruc").attr("placeholder","DNI");
                $("#ruc").attr("maxlength","8");

                $("#lbl_RAZ_APE").html('Nombres <label style="color: red;">(*)</label>');
                $("#razon_social").attr("placeholder","Nombres");
                $("#nombres").show();
                $(".dni_auto").show();
            }else{
                $("#lbl_DNI_RUC").html('RUC <label style="color: red;">(*)</label>');
                $("#ruc").attr("placeholder","RUC");
                $("#ruc").attr("maxlength","11");
                
                $("#lbl_RAZ_APE").html('Razon Social <label style="color: red;">(*)</label>');
                $("#razon_social").attr("placeholder","razon social");
                $("#nombres").hide();
                $(".dni_auto").hide();
            }

        });        
        //// FALSE : NO IGV; TRUE : SI IGV
        //cmp.incluyeIgv=false;
        <?php 
            $configuracion = $this->db->from('comprobantes_ventas')->get()->row();
            if ($configuracion->pu_igv==1) {
                echo "  cmp.incluyeIgv = true;
                        console.log(cmp.incluyeIgv);
                        calcular(); ";
            } else {
                echo "  cmp.incluyeIgv = false;
                         console.log(cmp.incluyeIgv);
                        calcular();";
            }
        ?>

        $('#conte-ntarjeta').hide();

        $('#tipo_pago').change(function(event) {
            if ($(this).val()==1) {
                $('#conte-ntarjeta').hide();
            }else {
                $('#conte-ntarjeta').hide();
            }
        });

       

    });
    function refescar() {
        var tabla = $('#tabla > tbody > tr');
        $.each(tabla,function(indice,value){   
            var parent = $(this); 
            console.log(parent);    
            cmp.calcular(parent);    
        });
    }
    //es anticipo
    var _es_anticipo = false;    
    var textoReferenciaNotas = "";
    $("#chkNotas").change(function(e){
        if($(this).is(":checked"))
        {
            $("#notas").removeAttr("disabled");
            $("#notas").val(textoReferenciaNotas);
        }else{
             $("#notas").attr("disabled","tue");
             $("#notas").val("");           
        }
    });

    $("#moneda_id").change(function(e){
        e.preventDefault();
        var moneda = $(this).val();//1:sol,2dolares,3euro
        var simbolo = '';
        if(moneda=='1')
            simbolo = 'S/.';
        if(moneda == '2')
            simbolo = '$';
        if(moneda == '3')
            simbolo = '€'; 

        $(".selec_moneda").html(simbolo);           
    });
    

    /* DETALLE DE CAMBIO      / AUTOR               / FECHA
     *-----------------------------------------------------------   
     * PRECIO TEXT          / ALEXADER FERNANDEZ / 15-04-202 */
    $(function(){
        $("#fecha_de_emision").datepicker();
        $("#fecha_de_vencimiento").datepicker();                
        $('#cliente').autocomplete({
            source : '<?PHP echo base_url();?>index.php/comprobantes/buscador_cliente',
            minLength : 2,
            select : function (event,ui){  
                                        
                var data_cli = '<input type="hidden" value="'+ ui.item.id + '" name = "cliente_id" id = "cliente_id" >';
                $('#data_cli').html(data_cli);
                $("#direccion").val(ui.item.domicilio1);
                $("#placa").val(ui.item.placa);
                $("#precio_text").val(ui.item.precio_text);

                if($('#tipo_documento option:selected').val() == "7"){
                    updateDocumentoNotaCredito();
                }
            }
        });
    });
    
    /* DETALLE DE CAMBIO      / AUTOR               / FECHA
     *-----------------------------------------------------------   
     * TIPO RUBRO CAMBIO     / ALEXADER FERNANDEZ / 15-04-202 */

    $('body').delegate('.descripcion-item', 'keydown', function() {
      precio_text = ($("#precio_text").val() != '') ? $("#precio_text").val() : 'prod_precio_publico';

        $('.descripcion-item').autocomplete({
            source : '<?PHP echo base_url();?>index.php/comprobantes/buscador_item',
            minLength : 2,
            select : function (event,ui){
                var _item = $(this).closest('.cont-item');
                var data_item = '<input class="val-descrip"  type="hidden" value="'+ ui.item.id + '" name = "item_id[]" id = "item_id">';
                _item.find('#data_item').html(data_item);

                _item.find('#descripcion').attr("readonly",true);
                _item.find('#medida').val(ui.item.medida);  
                
                _item.find('.importe').val(ui.item[precio_text]);
                _item.find('.importeCosto').val(ui.item.precioCosto);
                
                var parent = $(this).parents().parents().get(0);
                
                _item.find('.totalp').val(ui.item.precio);
                cmp.calcular(parent);
                calcular();
            
                
            },
            change : function(event,ui){
              if ((ui.item.prod_medida_id != 59) && (ui.item.prod_stock == 0)){
                var tipoDocumento = $("#tipo_documento").val();
                    if(tipoDocumento==1 || tipoDocumento==3)
                    {
                      toast("error",1200,"Producto sin stock");
                       $(this).closest('.cont-item').remove();

                       if($("#tabla tbody tr").length === 0)
                          $("#tabla").css("display","none");      
                          calcular();                            
                    }                          
              }                
            }                
        });
    });
    
    function updateDocumentoNotaCredito(){        
        $('#mostrarDetraccion').css('display','none');
        $('#mostrarCompNota').css('display','block');
                    
        var facturas_cliente =
                '<label class="control-label">Documento a Modificar</label>' +
                '<select class="form-control input-sm" name="comp_adjunto" id="comp_adjunto">' +
                '</select>';
        $('#div_facturas_cliente').html(facturas_cliente);
        $("#comp_adjunto").load('<?PHP echo base_url(); ?>index.php/comprobantes/comprobantesNotasCredito/' + <?= $empresa['id']?> + '/' + $('#cliente_id').val() + '/' + $('#serie option:selected').val());
        $('#tipo_ncredito').prop('disabled',false);
        $('#tipo_ndebito').prop('disabled',true);
    }     

   
    function agregar_fila_sin_stock(){
       
        var fila = '<tr class="cont-item">';                               
                fila += '<td class="col-sm-3" style="border:0;"> <textarea class="form-control" rows="2" id="descripcion" name="descripcion[]" required=""></textarea><div id="data_item"><input type="hidden" name="item_id[]" id="item_id" value="0"></div></td>';

                fila += '<td class="col-sm-1" style="border:0;"><select class="form-control" id="medida" name="medida[]"><option value="">Seleccione</option>';
                <?php foreach ($medida as $valor):?>
                    fila += '<option value="<?php echo $valor->medida_id;?>"><?php echo $valor->medida_nombre;?></option>';  
                <?php endforeach ?>                            
                fila += '</select></td>';                                                
                //fila += '<td><input type="text" id="serie_detalle" name="serie_detalle[]"  class="form-control serie_detalle"></td>';
                fila += '<td><input type="number" id="cantidad" name="cantidad[]"  class="form-control cantidad" value="1"></td>';

                fila += '<td class="col-sm-2" style="border:0;">';
                fila += '<select class="form-control tipo_igv" id="tipo_igv" name="tipo_igv[]">';
                <?php foreach($tipo_igv as $value):?>                  
                   fila += '<option value = "<?PHP echo $value['id'];?>"><?PHP echo $value['tipo_igv']?></option>';                 
                <?php endforeach?>
                fila += '</select>'
                fila += '</td>';
                
                fila += '<td style="border:0;"><input type="number" id="importe" name="importe[]" required="" class="form-control importe">'+
                        '<input type="hidden" id="importeCosto" name="importeCosto[]" required="" class="form-control importeCosto" ></td>';

                fila += '<td class="precios">'+
                        '<span class="glyphicon glyphicon-new-window btn_agregar_precio" id="btn_1" data-toggle="modal" data-target="#myModalPrecio"></span>'+
                          '<input type="hidden" id="igv"  name="igv[]" class="form-control"  readonly=""></td>';

                <?php if ($configuracion->descuento): ?>                    
                    fila += '<td><input type="text" id="desc_uni"  name="descuento[]" class="form-control"></td>';
                <?php else: ?>
                    fila += '<td style="display:none;"><input type="text" id="desc_uni"  name="descuento[]" class="form-control"></td>';
                <?php endif ?>

                fila += '<td style="border:0;">'+
                        '<input type="hidden" id="subtotal" name="subtotal[]" class="form-control" readonly="">'+
                        '<input type="text" id="total" name="total[]" class="form-control totalp" value ="0.00" readonly="">'+
                        '<input type="hidden" id="totalVenta" name="totalVenta[]" class="form-control totalVenta" value ="0.00" readonly="">'+
                        '<input type="hidden" id="totalCosto" name="totalCosto[]" class="form-control totalCosto" value ="0.00" readonly=""></td>';                
                fila += '<td class="eliminar" style="border:0;"><span class="glyphicon glyphicon-remove" style="color:#F44336;font-size:20px;cursor:pointer;"></span></td>';
            fila += '</tr>';

            $("#tabla").css("display","block");
               $("#tabla tbody").append(fila);
               calcular();                            
               //Llamada Evento Chosen
               $('.tipo_igv').chosen({                
                   search_contains : true,
                   no_results_text : 'No se encontraton estos tags',                
               });  
    }

        //AGREGANDO FILA
        $(function(){       
          $("#agrega").on('click', function(){           
            agregarFila();
        });          
        //REMOVIENDO ITEMS
        $(document).on("click",".eliminar",function(){
        //$(this).parents().get(0).remove();
                $(this).parent().remove();
                if($("#tabla tbody tr").length === 0)
                    $("#tabla").css("display","none");      
                    calcular();     
        });

       
        //Entrada Solo numeros
        $('#cantidad,#numero,#desc_uni').on('keydown',function(e){
            validNumericos(e);
        });
        //Serir entrada Alfanumerico
        $('#serie').on('keydown',function(e){
            validAlfaNumerico(e);
        });

       //RECIBIENDO DATOS COMPROBANTE A FACTURAR
        if('<?= $valida;?>' === '1'){
            $.ajax({
                url : '<?= base_url()?>index.php/comprobantes/jsonComprobante/<?= $ajaxId;?>',
                type : 'GET',
                success : function(data){
                    var comprobante_id,moneda_id,cliente_id,razon_social,moneda,fecha,item;
                    $.each(data, function(i,msg){
                        comprobante_id = msg.comprobante_id;
                        moneda_id = msg.moneda_id;
                        cliente_id = msg.cliente_id;
                        razon_social = msg.razon_social;
                        moneda = msg.moneda;
                        fecha = msg.fecha;
                        item = msg.item;
                    });
                    $('#fecha_de_emision').val(fecha);
                    $('#cliente_id').val(cliente_id);
                    $('#cliente').val(razon_social);

                    console.log(comprobante_id +'/'+cliente_id +'/'+ fecha);
                    console.log(item);
                    //tipoMoneda(moneda_id);
                    $('#moneda_id').append('<option value='+moneda_id+' SELECTED>'+moneda+'</option>');

                    agregarFila();
                    $('#descripcion').val(item.descripcion);
                    $('#importe').val(item.importe);

                    var parent = $('table tbody tr');
                    cmp.calcular(parent);
                    tipoCambio();
                },
                dataType : 'JSON'
            });
        }
        //FUNCION AGREGAR FILA
        function agregarFila(){    
            var fila = '<tr class="cont-item" class="invoice-item">';

             fila += '<td>&nbsp;&nbsp;&nbsp;&nbsp;\
                                <button type="button" class="btn btn-xs btn-up addItem">\
                                  <span class="glyphicon glyphicon-triangle-top"></span>\
                                </button>\
                        <input type="number" id="cantidad" name="cantidad[]"  class="form-control cantidad text-center" value="1" style="width:60px;max-width:60px;border-radius: 20px;border: 1px solid #ddd;padding-top:0;padding-bottom:0;">&nbsp;&nbsp;&nbsp;&nbsp;\
                        <button type="button" class="btn btn-xs btn-down decreaseItem">\
                              <span class="glyphicon glyphicon-triangle-bottom"></span>\
                            </button>\
                        </td>';                
                               
                fila += '<td colspan="2" class="col-sm-4" style="border:0;">'+                        
                        '<input class="form-control descripcion-item" rows="2" id="descripcion" name="descripcion[]" required="">'+                        
                        '<div id="data_item"><input type="hidden" name="item_id[]" id="item_id"></div></td>';

                fila += '<td style="border:0;display: none;"><input type="text" class="form-control" readonly id="medida" name="medida[]"></td>' 
                //fila += '<td><input type="text" id="serie_detalle" name="serie_detalle[]"  class="form-control serie_detalle"></td>';
               

                fila += '<td class="col-sm-2" style="border:0;">'+
                        '<select class="form-control tipo_igv" id="tipo_igv" name="tipo_igv[]">';
                          <?php foreach($tipo_igv as $value):?>
                                fila += '<option value = "<?PHP echo $value['id'];?>"><?PHP echo $value['tipo_igv']?></option>';
                          <?php endforeach?>
                fila += '</select></td>';                
                
                fila += '<td style="border:0;">'+
                        '<input type="number" id="importe" name="importe[]" required="" class="form-control importe" >'+
                        '<input type="hidden" id="importeCosto" name="importeCosto[]" required="" class="form-control importeCosto" ></td>';
                //fila += '<td></td>';
                fila += '<td class="precios">'+
                        '<span class="glyphicon glyphicon-new-window btn_agregar_precio" id="btn_1" data-toggle="modal" data-target="#myModalPrecio"></span>'+
                          '<input type="hidden" id="igv"  name="igv[]" class="form-control"  readonly=""></td>';                
                fila += '<input type="hidden" id="icbper"  name="icbper[]" class="form-control"  readonly="">';

                <?php if ($configuracion->descuento): ?>                    
                    fila += '<td><input type="text" id="desc_uni"  name="descuento[]" class="form-control"></td>';
                <?php else: ?>
                    fila += '<td style="display:none;"><input type="text" id="desc_uni"  name="descuento[]" class="form-control"></td>';
                <?php endif ?>

                fila += '<td style="border:0;">'+                        
                        '<input type="hidden" id="codBarra" name="codBarra[]" class="form-control">'+
                        '<input type="hidden" id="subtotal" name="subtotal[]" class="form-control" readonly="">'+
                        '<input type="text" id="total" name="total[]" class="form-control totalp" value ="0.00">'+
                        '<input type="hidden" id="totalVenta" name="totalVenta[]" class="form-control totalVenta" value ="0.00" readonly="">'+
                        '<input type="hidden" id="totalCosto" name="totalCosto[]" class="form-control totalCosto" value ="0.00" readonly=""></td>';
                fila += '<td class="eliminar" style="border:0;">'+
                        '<span class="glyphicon glyphicon-remove" style="color:#F44336;font-size:20px;cursor:pointer;"></span></td>';
                fila += '</tr>';
            $("#tabla").css("display","block");
               $("#tabla tbody").append(fila);
               calcular();                            
               //Llamada Evento Chosen
               $('.tipo_igv').chosen({                
                   search_contains : true,
                   no_results_text : 'No se encontraton estos tags',                
               });    
        }
        

        //COMPROBANTE ADJUNTO 
        $("#comp_adjunto").chosen({
           search_contains : true,
           no_results_text : 'No se encontraton estos tags'        
       });
        
       $("#btn_es_anticipo").click(function(e){
            e.preventDefault();
            var anticipo = 0;
            if(!_es_anticipo)
            {
                _es_anticipo = true;
                $(this).addClass("btn-success");
                $("#anticipo").val('1');
                $("#panel_anticipos").hide();
            }else{
                _es_anticipo = false;
                $(this).removeClass("btn-success");
                $("#anticipo").val('0');
                $("#panel_anticipos").show();
            }
            calcular();
      });

        

       //carga documentos para Notas de credito
        function cargaDocumentosNotasCredito(){
            var serie_selec = $('#serie option:selected').val();
            var cliente_id = $('#cliente_id').val();

            console.log(serie_selec);
            console.log(cliente_id);
            var facturas_cliente =
                   '<label class="control-label">Documento a Modificar</label>' +
                   '<select class="form-control input-sm" name="comp_adjunto" id="comp_adjunto">' +
                   '</select>';
            $('#div_facturas_cliente').html(facturas_cliente);
            //$("#comp_adjunto").load('<?PHP echo base_url(); ?>index.php/comprobantes/comprobantesNotasCredito/' + 1 + '/' + cliente_id + '/' + serie_selec);

            <?php if($adjunto_estado!=0){ ?>
                console.log("estado 1");
                var url = '<?PHP echo base_url(); ?>index.php/comprobantes/comprobantesNotasCredito/' + <?= $empresa['id']?> + '/' + cliente_id + '/' + serie_selec + '/' + <?php echo $adjunto_id?>;
                select_documento_adjunto(<?php echo $adjunto_id?>);
            <?php }else{ ?> 
                console.log("estado 0");
                var url = '<?PHP echo base_url(); ?>index.php/comprobantes/comprobantesNotasCredito/' + <?= $empresa['id']?> + '/' + cliente_id + '/' + serie_selec;
            <?php } ?> 

            $("#comp_adjunto").load(url);            
        }

        /////SELECCION DE DOCUMENTO A MODIFICAR
        $(document).on("change","#comp_adjunto",function(){
            var comprobante_id = $(this).val();
            $.getJSON("<?PHP echo base_url(); ?>index.php/comprobantes/obtener_documento_relacionado",{id:comprobante_id})
             .done(function(json){
                 $("#tabla tbody").html("");
                $.each(json,function(index,value){
                    var fila = '<tr class="cont-item" >';        

                    if(value.producto_id!=0){
                        fila += '<td class="col-sm-4" style="border:0;"> <input class="form-control descripcion-item" rows="2" id="descripcion" name="descripcion[]" required="" value="'+ value.descripcion +'" readonly><div id="data_item"><input type="hidden" name="item_id[]" id="item_id" value="'+ value.producto_id +'"></div> </td>';
                        fila += '<td class= "col-sm-1" style="border:0; "><input type="text" class="form-control" readonly id="medida" name="medida[]" value="'+ value.medida_nombre +'"></td>';
                    }else{
                        fila += '<td class="col-sm-4" style="border:0;"> <textarea class="form-control" rows="2" id="descripcion" name="descripcion[]" required="">'+ value.descripcion +'</textarea><div id="data_item"><input type="hidden" name="item_id[]" id="item_id" value="0"></div> </td>';    

                        fila += '<td style="border:0;"><select class="form-control" id="medida" name="medida[]"><option value="">Seleccione</option>';
                        <?php foreach ($medida as $valor):?>

                            if(value.unidad_id==<?php echo $valor->medida_id?>){
                                fila += '<option value="<?php echo $valor->medida_id;?>" selected><?php echo $valor->medida_nombre;?></option>';  
                            }else{
                                fila += '<option value="<?php echo $valor->medida_id;?>"><?php echo $valor->medida_nombre;?></option>';  
                            }                            
                        <?php endforeach ?>                            
                        fila += '</select></td>';
                    }

                                    
                        fila += '<td style="border:0;"><input type="number" id="cantidad" name="cantidad[]"  class="form-control cantidad" value="'+ value.cantidad +'" ></td>';

                        fila += '<td class="col-sm-2" style="border:0;">';
                        fila += '<select class="form-control tipo_igv" id="tipo_igv" name="tipo_igv[]">';
                        <?php foreach($tipo_igv as $value):?>
                          
                           fila += '<option value = "<?PHP echo $value['id'];?>"><?PHP echo $value['tipo_igv']?></option>';
                         
                        <?php endforeach?>
                        fila += '</select>'
                        fila += '</td>';
                        
                        fila += '<td style="border:0;"><input type="number" id="importe" name="importe[]" required="" class="form-control importe" value="'+ value.importe +'"></td>';
                        fila += '<input type="hidden" id="igv"  name="igv[]" class="form-control"  readonly="" value="'+ value.igv +'">';
                        <?php if ($configuracion->descuento): ?>                    
                            fila += '<td><input type="text" id="desc_uni"  name="descuento[]" class="form-control"   ></td>';
                        <?php else: ?>
                            fila += '<td style="display:none;"><input type="text" id="desc_uni"  name="descuento[]" class="form-control"   ></td>';
                        <?php endif ?>

                        fila += '<td style="border:0;"><input type="text" id="total" name="total[]" class="form-control totalp" value="'+ value.total +'" readonly=""></td>';
                        fila += '<td class="eliminar" style="border:0;"><span class="glyphicon glyphicon-remove" style="color:#F44336;font-size:20px;cursor:pointer;"></span></td>';
                     fila += '</tr>';
               $("#tabla").css("display","block");
               $("#tabla tbody").append(fila);
               calcular(); 

                });

             });        
        })
        function select_documento_adjunto(comprobante_id){                    
            $.getJSON("<?PHP echo base_url(); ?>index.php/comprobantes/obtener_documento_relacionado",{id:comprobante_id})
             .done(function(json){
                 $("#tabla tbody").html("");
                $.each(json,function(index,value){
                    var fila = '<tr class="cont-item" >';        

                    if(value.producto_id!=0){
                        fila += '<td class="col-sm-4" style="border:0;"> <input class="form-control descripcion-item" rows="2" id="descripcion" name="descripcion[]" required="" value="'+ value.descripcion +'" readonly><div id="data_item"><input type="hidden" name="item_id[]" id="item_id" value="'+ value.producto_id +'"></div> </td>';
                        fila += '<td style="border:0;"><input type="text" class="form-control" readonly id="medida" name="medida[]"></td>';
                    }else{
                        fila += '<td class="col-sm-4" style="border:0;"> <textarea class="form-control" rows="2" id="descripcion" name="descripcion[]" required="">'+ value.descripcion +'</textarea><div id="data_item"><input type="hidden" name="item_id[]" id="item_id" value="0"></div> </td>';    

                        fila += '<td style="border:0;"><select class="form-control" id="medida" name="medida[]"><option value="">Seleccione</option>';
                        <?php foreach ($medida as $valor):?>

                            if(value.unidad_id==<?php echo $valor->medida_id?>){
                                fila += '<option value="<?php echo $valor->medida_id;?>" selected><?php echo $valor->medida_nombre;?></option>';  
                            }else{
                                fila += '<option value="<?php echo $valor->medida_id;?>"><?php echo $valor->medida_nombre;?></option>';  
                            }
                            
                        <?php endforeach ?>                            
                        fila += '</select></td>';
                    }

                                    
                        fila += '<td style="border:0;"><input type="number" id="cantidad" name="cantidad[]"  class="form-control cantidad" value="'+ value.cantidad +'" ></td>';

                        fila += '<td class="col-sm-2" style="border:0;">';
                        fila += '<select class="form-control tipo_igv" id="tipo_igv" name="tipo_igv[]">';
                        <?php foreach($tipo_igv as $value):?>
                          
                           fila += '<option value = "<?PHP echo $value['id'];?>"><?PHP echo $value['tipo_igv']?></option>';
                         
                        <?php endforeach?>
                        fila += '</select>'
                        fila += '</td>';
                        
                        fila += '<td style="border:0;"><input type="number" id="importe" name="importe[]" required="" class="form-control importe" value="'+ value.importe +'"></td>';
                        fila += '<input type="hidden" id="igv"  name="igv[]" class="form-control"  readonly="" value="'+ value.igv +'">';
                        <?php if ($configuracion->descuento): ?>                    
                            fila += '<td><input type="text" id="desc_uni"  name="descuento[]" class="form-control"   ></td>';
                        <?php else: ?>
                            fila += '<td style="display:none;"><input type="text" id="desc_uni"  name="descuento[]" class="form-control"   ></td>';
                        <?php endif ?>

                        fila += '<td style="border:0;"><input type="text" id="total" name="total[]" class="form-control totalp" value="'+ value.total +'" readonly=""></td>';
                        fila += '<td class="eliminar" style="border:0;"><span class="glyphicon glyphicon-remove" style="color:#F44336;font-size:20px;cursor:pointer;"></span></td>';
                     fila += '</tr>';
               $("#tabla").css("display","block");
               $("#tabla tbody").append(fila);
               calcular();
                });
             });                    
         }
        //MODAL PARA SELECCIONAR PRECIO//03-08-2019
        $(document).on("click",".btn_agregar_precio",function(){                        
            var _item = $(this).parents('.cont-item');                    
            var productoId = _item.find('#item_id').val();                  
            
            _item.find('#importe').addClass( "precioSelected" );
                        
            var datos = {
                        productoId: productoId                        
                    };
            $("#myModalPrecio").load('<?php echo base_url()?>index.php/comprobantes/SeleccionaListaPrecio',datos);
        });
       
        //modal para agregar anticipo
        $("#btn_agregar_anticipo").click(function(e){
            var datos = {
                            cliente:$("#cliente_id").val()
                        };
            $("#myModal").load('<?php echo base_url()?>index.php/comprobantes/agregarAnticipoUi',datos);
        });
    });

    function obtenerAnticipos()
    {
        //obtenemos los anticipos agregadp en session
        $.ajax({
            url:'<?php echo base_url()?>index.php/comprobantes/getListaAnticiposAgregados',
            method:'post',
            dataType:'json',
            success:function(response){
                if(response.status == STATUS_OK)
                {
                    $("#lista_anticipos").html("");
                    var anticipos = response.data;
                    var _html = '<table class="table table-bordered table-xs" style="width:500px">';
                    _html += '<thead><tr><th>Nº Documento</th><th>Importe</th><th></th></tr></thead>';
                    _html += '<tbody>';
                    $.each(anticipos, function(index, value){
                        _html += '<tr>';
                        _html += '<td>'+value.anticipo_numero+'</td>';
                        _html += '<td>'+value.anticipo_total+'</td>';
                        _html += '<td>'+value.eliminar+'</td>';
                        _html += '</tr>';
                    });
                    _html += '<tbody>';
                    _html += '</table>';
                    $("#lista_anticipos").html(_html);
                    //eliminar anticipo
                    $(".btn-eliminar_anticipo").unbind('click');
                    $(".btn-eliminar_anticipo").click(function(e){
                        e.preventDefault();
                        var datos = {
                                        anticipo:$(this).data('anticipo'),
                                        total_a_pagar:$("#total_a_pagar").val()
                                    };
                        $.ajax({
                            url:'<?php echo base_url()?>index.php/comprobantes/eliminarAnticipo',
                            method:'post',
                            data:datos,
                            dataType:'json',
                            success:function(response){
                                if(response.status == STATUS_OK)
                                {
                                    toast('success', 1500, 'Anticipo quitado');
                                    var totalAnticipo = parseFloat(response.totalAnticipo);
                                    var gravadas = parseFloat(response.gravadas);
                                    var igv = parseFloat(response.igv);
                                    var totalPagar = parseFloat(response.totalPagar);
                                    $("#total_anticipos").val(totalAnticipo.toFixed(2));
                                    $("#total_gravada").val(gravadas.toFixed(2));
                                    $("#total_igv").val(igv.toFixed(2));
                                    obtenerAnticipos();
                                    calcular();
                                }else{
                                    toast('error', 1500, 'No se pudo quitar anticipo');
                                }
                            }
                        });            
                    });
                }
            }
        });
    }
    //DNI AUTOMATICO
    $(document).on("click",'#dni_auto',function(){            
        if($('#dni_auto').prop('checked')){           
            $.ajax({
                url: '<?= base_url()?>index.php/clientes/dni_auto',
                dataType : 'JSON',
                method: 'POST',
                success: function(response){                  
                  if(response.status == STATUS_OK){                    
                      $("#ruc").val(response.dni_auto);
                  }
                }
            })
        }else{
          $("#ruc").val('');
        }        
    });
    //CARGAR MODAL BUSCAR PRODUCTO
    $(document).on("click",'#btn_buscar_producto',function(e){
        e.preventDefault();
        $("#myModalProducto").load("<?= base_url()?>index.php/productos/modal_buscarProducto",{});
    });
    //CARGAR MODAL NUEVO CLIENTE
    $(".btn_buscar").on('click',function(e){
        e.preventDefault();
        $("#myModalNuevoCliente").load("<?= base_url()?>index.php/clientes/modal_nuevoCliente",{});
    });
    //CARGAR MODAL PAGO PAGO_MONTO 14-10-2020 
    $("#guardar").on('click',function(e){      
        e.preventDefault();
        $("#myModalPagoMonto").load("<?= base_url()?>index.php/comprobantes/modal_pagoMonto",{});
    });

    //PSE TOKEN 10-01-2021
    function send_xmlPSE(comprobante_id){
            toast("info",10000, 'Enviando a SUNAT . . .');
            $.getJSON("<?PHP echo base_url(); ?>index.php/comprobantes/getDatosXML_PSE",{comprobante_id})
            .done(function(json){
                var datosJSON = JSON.stringify(json);                
                //JAVASCRIPT JQUERY 04-01-2021
                var settings = {
                  "url": "<?= base_url()?>index.php/comprobantes/send_xmlPSE",
                  "method": "POST",
                  "dataType": "json",                  
                  "data": {"json": datosJSON}
                };                
                $.ajax(settings).done(function(response){
                    try{     

                        if(response.codigo != '' && response.codigo == 21 && response.codigo == 50){
                            toast("error", 9000, "<div style='font-size:16px'>"+response.errors+"</div>");
                            //location.href='<?PHP echo base_url()?>index.php/comprobantes/index';
                        } else {
                          if(response.sunat_responsecode == "0" || response.enlace != ""){
                            $.post("<?PHP echo base_url(); ?>index.php/comprobantes/updateEstadoCDR_PSE",{comprobante:comprobante_id,firma:response.codigo_hash,enlace_del_xml:response.enlace_del_xml,enlace_del_cdr:response.enlace_del_cdr})
                                     .done(function(res){
                                      response.sunat_description = 'Enviado';
                                          toast("success", 4000, response.sunat_description); 
                                          setTimeout(function() { 
                                             location.href='<?PHP echo base_url()?>index.php/comprobantes/index/'+comprobante_id;
                                             //location.href='<?PHP echo base_url()?>index.php/comprobantes/index/';
                                          }, 2000);
                               })
                             }
                        }     
                    } catch(e){                            
                            toast("error",6000,res.errors);
                          
                    }
                });
            });
    }  

    $('#producto').focus();
</script>
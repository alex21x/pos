<style type="text/css">
@media (min-width:0px) {
  .modal-dialog-pagoMonto{
    width: 600px;
    margin: 10px auto 20px auto;        
}}    

@media (min-width: 768px) {
  .modal-dialog-pagoMonto{
    width: 800px;
    margin: 10px auto 20px auto;        
}}

@media (min-width: 992px) {
  .modal-dialog-pagoMonto{
    width: 1000px;
    margin: 10px auto 20px auto;        
}}      

@media (min-width: 1200px) {
  .modal-dialog-pagoMonto{
    width: 800px;
    margin: 10px auto 20px auto;        
}}     

@media (min-width: 1300px) {
  .modal-dialog-pagoMonto{
    width: 1800px;
    margin: 10px auto 20px auto;        
}}

@media (min-width: 1500px) {
  .modal-dialog-pagoMonto{
    width: 1800px;
    margin: 10px auto 20px auto;        
}}   
    
@media (min-width: 1600px) {
  .modal-dialog-pagoMonto{
    width: 1800px;
    margin: 10px auto 20px auto;        
}} 

@media (min-width: 1900px) {
  .modal-dialog-pagoMonto{
    width: 1800px;
    margin: 10px auto 20px auto;        
}}   
</style>

<form id="formPagoMonto">
<div class="col-xs-12 col-md-12 col-lg-12">
    <div class="modal-dialog modal-lg modal-dialog-pagoMonto" role="document">
        <div class="modal-content">
            <div class="modal-header">                
                <div class="modal-title">PAGÓ
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <div class="modal-body">


                <div class="col-xs-6 col-md-6 col-lg-6">

                    <div class="panel panel-info" >
                <div class="panel-heading" >
                    <div class="panel-title">COMPLETE DATOS DEL COMPROBANTE</div>                        
                </div>
                <div class="panel-body">                     
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

                             <label class="control-label">Tipo Documento:</label>        
                            <select  class="form-control" name="tipo_documento" id="tipo_documento">
                            <?PHP foreach ($tipo_documentos as $value) { ?>   
                               <?php if($value['id']!=11) {?>  
                                    <?php if($adjunto_estado!=0){ ?>
                                        <option value = "<?PHP echo $value['id'];?>" <?php echo ($value['id']==$adjunto_tipo_documento)?"selected":"";?>><?PHP echo $value['tipo_documento']?></option> 
                                    <?php }else{ ?>
                                         <option value = "<?PHP echo $value['id'];?>" <?php echo ($value['id']==3)?"selected":"";?>><?PHP echo $value['tipo_documento']?></option>
                                    <?php } ?>  

                               
                               <?php } ?> 
                            <?PHP }?>                              
                            </select>    
                        </div>                                           
                        <div class="col-xs-6 col-md-3 col-lg-3">
                            <label class="control-label">Serie:</label>                            
                            <div id="div_serie_actual">
                                <select readonly class="form-control disabled " name="serie" id="serie">
                                    <?PHP foreach ($ser_nums as $value) {?>                
                                    <option value = "<?= $value['serie']?>"><?= $value['serie']?></option>
                                    <?PHP }?>
                                </select>
                            </div>
                            <div id="div_serie_antiguo">
                                <input type="text" class="form-control" name="serie_antiguo" id="serie_antiguo" value="" />
                            </div>
                        </div>
                        <div class="col-xs-6 col-md-3 col-lg-3">
                            <label class=" control-label">Numero:</label>
                            <input type="text" class="form-control" name="numero" id="numero" maxlength="9" required="" readonly>
                        </div>
                        <div class="col-xs-6 col-md-3 col-lg-3">
                            <label class=" control-label">Fecha emision:</label>
                            <input type="text" class="form-control" name="fecha_de_emision" id="fecha_de_emision" value="<?PHP
                            if(isset($_POST['fecha_de_emision']))
                                echo $_POST['fecha_de_emision'];
                            else
                                echo date('d-m-Y');
                            ?>" placeholder="Fecha Emision">
                        </div>    
                        <div class="col-xs-6 col-md-3 col-lg-3">
                            <label class="control-label">Moneda:</label>        
                            <select class="form-control" name="moneda_id" id="moneda_id">
                           <?PHP foreach ($monedas as $value) { ?>   
                                <?php if($adjunto_estado!=0){ ?>
                                    <option value = "<?PHP echo $value->id;?>" <?php echo ($value->id==$adjunto_datos->moneda_id)?"SELECTED":"";?>><?PHP echo $value->moneda?></option>
                                <?php }else{ ?>
                                    <option value = "<?PHP echo $value->id;?>"><?PHP echo $value->moneda?></option>
                                <?php } ?>                         
                               
                           <?PHP }?>    
                           </select>
                        </div>       
                        <div class="col-xs-6 col-md-3 col-lg-3">
                            <label class="control-label">Tip. Cambio:</label>        
                            <input type="text" class="form-control" name="tipo_de_cambio" id="tipo_de_cambio" disabled="">
                        </div>
                        <div class="col-xs-6 col-md-3 col-lg-3">
                            <label class=" control-label">Fecha de Venc:</label>
                            <input type="text" class="form-control" name="fecha_de_vencimiento" id="fecha_de_vencimiento" value="<?PHP
                                if(isset($_POST['fecha_de_vencimiento']))
                                    echo $_POST['fecha_de_vencimiento'];
                                else
                                    echo date('d-m-Y');
                                ?>" placeholder="Fechad de vencimiento">
                        </div>                         
                        <div class="col-xs-6 col-md-3">
                                    <label class=" control-label"># Guía</label>
                                    <div class="input-group">
                                        <input type="text" name="numero_guia" id="numero_guia" class="form-control" value="">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" type="button" id="btn_buscar_guia"><i class="glyphicon glyphicon-search"></i></button>
                                        </span>
                                    </div>                                  
                               </div>
        <!-- ARRAY ADELANTO DE ITEMS              --->
        <input type="hidden" value="[]" id="adelanto_items" name="adelanto_items">
                         <!-- numero pedido -->
                         <?php if ($configuracion->numero_pedido): ?>
                            <div class="col-xs-3">
                                <label class="control-label">N° pedido </label>
                                <input type="text" name="numero_pedido" class="form-control">
                            </div>      
                         <?php endif ?>
                         <div class="col-xs-12 col-md-3 col-lg-3">
                            <label class="control-label">Transportistas:</label>        
                            <select class="form-control" name="transportista" id="transportista">
                           <?PHP foreach ($transportistas as $value) { ?>                          
                               <option value = "<?PHP echo $value->transp_id;?>"><?PHP echo $value->transp_nombre.'-'.$value->transp_tipounidad?></option>
                           <?PHP }?>    
                           </select>
                        </div>   
                        <div class="col-xs-12 col-md-3 col-lg-3">
                            <label class="control-label">Placa:</label>
                            <input type= "text" class="form-control" id="placa" name="placa" value="<?= $value->placa;?>">
                        </div>
                         <!-- orden de compra -->
                        <?php if ($configuracion->orden_compra): ?>                            
                            <div class="col-xs-6 col-md-3">
                                <label class="control-label"> Orden de Compra </label>
                                <input type="text" name="orden_compra" class="form-control">
                            </div>
                        <?php endif ?>
                        <!-- numero de guia remision -->    
                        <?php if ($configuracion->numero_guia): ?>                            
                            <div class="col-xs-3">
                                <label class="control-label"> N° guia remision </label>
                                <input type="text"  class="form-control">
                            </div>                            
                        <?php endif ?>                         
                        <!-- anticipos -->
                        <?php if ($configuracion->anticipo): ?>
                            <div class="col-xs-1">
                                <label>&nbsp;</label>
                                <br>
                                <button type="button" class="btn" id="btn_es_anticipo">Anticipo</button>
                            </div> 
                        <?php endif ?>
                        <!-- condicion de venta -->
                        <?php if ($configuracion->condicion_venta): ?>                            
                            <div class="col-xs-6 col-md-4 col-lg-4">
                                <label>Otros</label>
                                <input type="text" name="condicion_venta" class="form-control">
                            </div>
                        <?php endif ?>
                                                                                
                    </div>  
                </div>        
            </div>
                </div>




            <div class="col-xs-6 col-md-6 col-lg-6">              
                <div class="form-group">
                <table id="tablaPago" class="table" style="display:block;" border="0">                                                      
                                        <tbody>                                                      
                                        </tbody>                    
                                        </table>   
                                    <button type="button" id="agregarFilaPagoMonto" class="btn btn-primary btn-sm">Agregar Pago</button>
                </div><br><br>      
                <div class="form-group">
                    <div class="col-xs-12 col-md-4 col-lg-4">
                        <label>Total a Pagar</label>
                    </div>    
                    <div class="col-xs-12 col-md-6 col-lg-6">
                        <input type="text" class="form-control" name="total_pago" id="total_pago" readonly="">
                    </div>                    
                </div>
                <div class="form-group">
                    <div class="col-xs-12 col-md-4 col-lg-4">
                        <label>Pago</label>
                    </div>
                    <div class="col-xs-12 col-md-6 col-lg-6">
                        <input type="number" class="form-control" name="pago" id="pago" readonly="">
                    </div>                        
                </div>
                <div class="form-group">
                    <div class="col-xs-12 col-md-4 col-lg-4">
                        <label>Vuelto</label>
                    </div>    
                    <div class="col-xs-12 col-md-6 col-lg-6">
                        <input type="text" class="form-control" name="cambio" id="cambio" readonly="">
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-md-6 col-lg-6">
            <!-- MOSTRAR NOTA DE CREDITO, NOTA DE DEBITO --> 
              <div id="mostrarCompNota">
                  <div class="panel panel-info" id="panelDetraccion">
                  <div class="panel-heading">
                      <div class="panel-title">ADJUNTA A COMPROBANTE</div>
                  </div>
                  
                  <div class="panel-body" >
                      <div class="form-group">                                                                    
                          <div class="col-xs-4 col-md-4 col-lg-4" id="div_facturas_cliente">                                      

                          </div>
                          
                          <div class="col-xs-4 col-md-4 col-lg-4">
                              <label class="control-label">Tipo Nota de Crédito</label>
                              <select class="form-control" id ="tipo_ncredito" name="tipo_ncredito">
                                  <?PHP foreach ($tipo_ncreditos as $value) { ?>
                                        <option value="<?PHP echo $value['id'].'*'.$value['codigo']?>"><?PHP echo $value['tipo_ncredito']?></option>
                                  <?PHP }?>
                              </select>                                      
                          </div>
                           
                           <div class="col-xs-4 col-md-4 col-lg-4">
                              <label class="control-label">Tipo Nota de Débito</label>
                              <select class="form-control" id ="tipo_ndebito" name="tipo_ndebito">
                                  <?PHP foreach ($tipo_ndebitos as $value) { ?>
                                        <option value="<?PHP echo $value['id'].'*'.$value['codigo']?>"><?PHP echo $value['tipo_ndebito']?></option>
                                  <?PHP }?>
                              </select>                                      
                          </div>        
                      </div>                                                                                           
                  </div>                          
              </div>                                                
            </div>



             <!-- MUESTRA DETRACCION , FACTURA O BOLETA -->                                    
            <div class="panel panel-info" style="display: none">                    
                <div class="panel-heading">
                    <div class="panel-title">METODO DE PAGO</div>
                </div>
                <div class="panel-body">
                    <div class="row" style="width: 100%; margin: 0 auto;">
                        <div class="col-sm-4 form-group"> 
                            <label class="control-label">Tipo de Pago:</label>
                            <select class="form-control" name="tipo_pago" id="tipo_pago">
                            <?PHP foreach ($tipo_pagos as $value) { ?>                          
                                <option value = "<?PHP echo $value->id;?>"><?PHP echo $value->tipo_pago?></option>
                            <?PHP }?>
                            </select>                                
                        </div>
                        <div class="col-md-3" id="conte-ntarjeta" style="display: none;">
                            <label>Numero tarjeta </label>
                            <input type="text" name="ntarjeta" placeholder="******1234" value="000000" class="form-control">
                        </div> 
                    </div>
                </div> 
            </div> 
            <!-- anticipos -->
            <?php if ($configuracion->anticipo): ?>                
                <div class="panel panel-info" id="panel_anticipos">
                    <div class="panel-heading">
                        <div class="panel-title">ANTICIPOS</div>
                    </div>
                    <div class="panel-body">
                        <button type="button" class="btn btn-primary btn-sm" id="btn_agregar_anticipo" data-toggle="modal" data-target="#myModal">Agregar Anticipo</button>
                        <br>
                        <br>
                        <div id="lista_anticipos"></div>                    
                    </div>
                </div>
            <?php endif ?>
            <!-- notas -->
            <!--<?php if ($configuracion->notas): ?>                -->
                <div class="panel panel-info" id="panel_otros">
                    <div class="panel-heading">
                        <div class="panel-title">OBSERVACIONES</div>
                    </div>
                    <div class="panel-body">
                        <textarea name="notas" id="notas" rows="3" cols="100" disabled></textarea>
                    </div>
                </div>            
            <!--<?php endif ?>-->
            <div class="panel panel-info" id="panel_otros">
                    <div class="panel-heading">
                        <div class="panel-title">OBSERVACIONES</div>
                    </div>
                    <div class="panel-body">
                        <textarea name="notas" id="notas" rows="3" cols="100" style="width: 100%;"></textarea>
                    </div>
            </div>
        </div>
    </div>
    <div class="col-xs-6 col-md-6 col-lg-6"><br><br><br><br><br><br>        
        <div class="col-xs-6 col-lg-offset-6 col-md-6 col-lg-6">
           
                <div class="panel panel-body" style="border:1px solid #7FB3D5;border-radius:6px;">
                    <div class="input-group">        
                        <span class="input-group-addon" style="border:1px solid #ABB2B9;border-bottom: 0;border-right: 0;">Total Descuento: <span class="selec_moneda">S/.</span></span>                
                        <input type="text" id="descuento_global" name="descuento_global" class="form-control" style="border:1px solid #ABB2B9;border-bottom:0;" value="0.00">
                    </div>

                    <div class="input-group">        
                        <span class="input-group-addon" style="border:1px solid #ABB2B9;border-bottom: 0;border-right: 0;">Total Ope. Inafecta: <span class="selec_moneda">S/.</span></span>                
                        <input type="text" id="total_inafecta" name="total_inafecta" class="form-control" readonly="" style="border:1px solid #ABB2B9;border-bottom:0;">
                    </div>
                     <div class="input-group" style="display: none;">        
                        <span class="input-group-addon">Anticipos: <span class="selec_moneda">S/.</span></span>                
                        <input type="text" id="total_anticipos" name="total_anticipos" class="form-control" readonly="" style="border:1px solid #ABB2B9;border-bottom:0;">
                    </div> 
                    <div class="input-group" >        
                        <span class="input-group-addon" style="border:1px solid #ABB2B9;border-bottom: 0;border-right: 0;">Total Op. Exonerada: <span class="selec_moneda">S/.</span></span>                
                        <input type="text" id="total_exonerada" name="total_exonerada" class="form-control" readonly="" style="border:1px solid #ABB2B9;border-bottom:0;">
                    </div>
  
                    <div class="input-group">        
                        <span class="input-group-addon" style="border:1px solid #ABB2B9;border-bottom: 0;border-right: 0;">Total Ope. Gravada: <span class="selec_moneda">S/.</span></span>                
                        <input type="text" id="total_gravada" name="total_gravada" class="form-control" readonly="" style="border:1px solid #ABB2B9;border-bottom:0;">
                    </div>

                    <div class="input-group">        
                        <span class="input-group-addon" style="border:1px solid #ABB2B9;border-bottom: 0;border-right: 0;">Total IGV (18%): <span class="selec_moneda">S/.</span></span>                
                        <input type="text" id="total_igv" name="total_igv" class="form-control" readonly="" style="border:1px solid #ABB2B9;border-bottom:0;">
                    </div>
                     <div class="input-group">        
                        <span class="input-group-addon" style="border:1px solid #ABB2B9;border-bottom: 0;border-right: 0;">ICBPER: <span class="selec_moneda">S/.</span></span>                
                        <input type="text" id="total_icbper" name="total_icbper" class="form-control" readonly="" style="border:1px solid #ABB2B9;border-bottom:0;">
                    </div>

                    <div class="input-group">        
                        <span class="input-group-addon" style="border:1px solid #ABB2B9;border-bottom: 0;border-right: 0;">Total Ope. Gratuita: <span class="selec_moneda">S/.</span></span>                
                        <input type="text" id="total_gratuita" name="total_gratuita" class="form-control" readonly="" style="border:1px solid #ABB2B9;border-bottom:0;">
                    </div>
   
                    <div class="input-group">        
                        <span class="input-group-addon" style="border:1px solid #ABB2B9;border-bottom: 0;border-right: 0;">Otros Cargos: <span class="selec_moneda">S/.</span></span>                
                        <input type="text" id="total_otros_cargos" name="total_otros_cargos" class="form-control" style="border:1px solid #ABB2B9;border-bottom:0;">
                    </div>


                    <div class="input-group" style="display: none;">        
                        <span class="input-group-addon">Descuento Total: <span class="selec_moneda">S/.</span></span>                
                        <input type="text" id="total_descuentos" name="total_descuentos" class="form-control" value="0.00" readonly="" style="border:1px solid #ABB2B9;border-bottom:0;">
                    </div>    
                    <div class="input-group">                
                        <span class="input-group-addon" style="border:1px solid #ABB2B9;border-right: 0;">Importe Total: <span class="selec_moneda">S/.</span></span>                
                        <input type="text" id="total_a_pagar" name="total_a_pagar" class="form-control" readonly="" style="border:1px solid #ABB2B9;">
                    </div>    
                </div>           
        </div>
               
<!-- ICBPER -->
<input type="hidden" id="valorIcbper" value="<?php echo $rowIcbPerActivo->icbPer_valor;?>">



            </div>




            <br><br><br><br> 
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn_cerrar" data-dismiss="modal">Volver</button>
                <button class="btn btn-primary" id="guardarComprobante">Guardar</button>
            </div>    
        </div>
     </div>   
</div>  
<script type="text/javascript">
  //CÁLCULO DE MONTOS A PAGAR
  cmp.calcular();

    //FUNCION AGREGAR PAGO MONTO 10-10-2020
        function agregarFilaPagoMonto(){ 
            var rowMontoPago = $(".montoPago").toArray().length;                        
                    importe_pagoMonto = (rowMontoPago == 0) ? $("#total_a_pagar").val() : '';
                    moneda = $("#moneda_id option:selected").text();                    

            var  fila = '<div class="panel panel-default cont-item montoPago">';
                 fila += '<div class="panel-heading">Medio Pago '+moneda.toUpperCase()+'</div>'
                 fila += '<div class="panel-body">'
                 fila += '<div class="col-xs-12 col-md-6 col-lg-6">'
                 fila += '<label class="tipo_pagoMonto">Tipo Pago '+
                         '<select class="form-control tipo_pagoMonto" id="tipo_pagoMonto" name="tipo_pagoMonto[]">';
                          <?php foreach($tipo_pagos as $value):?>
                           fila += '<option value = "<?PHP echo $value->id;?>"><?PHP echo $value->tipo_pago?></option>';
                          <?php endforeach?>
                fila +=  '</select></label></div>';
                fila += '<div class="col-xs-12 col-md-6 col-lg-6">'
                fila += '<label>Monto'+
                        '<input type="number" id="importe_pagoMonto" name="importe_pagoMonto[]" required="" class="form-control importe_pagoMonto" value="'+importe_pagoMonto+'"></label></div>';   
                fila += '<div class="col-xs-12 col-md-6 col-lg-6">'                     
                fila += '<label>Observacion'+
                        '<input type="text" id="observacion_pagoMonto" name="observacion_pagoMonto[]" required="" class="form-control observacion_pagoMonto"></label></div>';
                fila += '<div class="col-xs-12 col-md-6 col-lg-6">'
                fila +=  '<span class="glyphicon glyphicon-remove eliminarPagoMonto" style="color:#F44336;font-size:20px;cursor:pointer;"></span></td>';
                fila +=  '</div></div></div>';
                fila +=  '</tr>';
                $("#tablaPago").css("display","block");
                $("#tablaPago tbody").append(fila);
                calcularPago();
                //calcular();               
        }

        agregarFilaPagoMonto();
        //AGREGANDO PAGO MONTO 14-10-2020  
        $("#agregarFilaPagoMonto").on('click', function(){
            agregarFilaPagoMonto();
        });
        //REMOVIENDO ITEMS PAGO MONTO 14-10-2020
        $(document).on("click",".eliminarPagoMonto",function(){          
            $(this).parent().parent().parent(0).remove();                
            calcularPago();
            //calcular();     
        });

    //GUARDAR COMPROBANTE 03-08-2020 ALEXANDER FERNANDEZ
    $("#guardarComprobante").click(function(e){

        cambio  = calcularPago();
        var rowMontoPago = $(".montoPago").toArray().length;        
        if(cambio < 0){
            alert('INGRESE MONTO CORRECTOS');
        } else if(rowMontoPago > 0){
            $('#guardarComprobante').prop('disabled',true);
            $('.btn_cerrar').prop('disabled',true);        
            guardarComprobante();
        }else {
            alert('DEBE DE INGRESAR AL MENOS UN METODO DE PAGO');
        }        
    });     

    function guardarComprobante(){        
        $.ajax({
            method:'post',
            url:'<?PHP echo base_url()?>index.php/comprobantes/guardar_comprobante',
            data:$("#formComprobante,#formPagoMonto").serialize(),
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
                        if($("#pse_token").val() == 'activo'){
                            send_xmlPSE(response.cpe_id);
                        } else{
                            send_xml(response.cpe_id);
                        }
                    }else{     
                         toast("success", 1500, 'Comprobante registrado');                         
                         setTimeout(function() { 
                           location.href='<?PHP echo base_url()?>index.php/comprobantes/index/'+response.cpe_id;
                         }, 2000);
                    }       
                }
            }
        });        
    }

    //ALEXANDER FERNANDEZ DE LA CRUZ 15-10-2020
    $('#total_pago').val($('#total_a_pagar').val());
    $('#pago').val($('#total_a_pagar').val());
    calcularPago();   

    //EVENTO TEXTOBOX MODAL PAGO_CAMBIO 11-12-2019
    $(document).on('keyup','.importe_pagoMonto',function(){
        calcularPago();
    });

   //CALCULAR PAGO
   function calcularPago(){
        var total_a_pagar = $('#total_a_pagar').val();

        var sumImporte_pagoMonto = 0;
        //var importe_pagoMonto = $('.importe_pagoMonto').val();    
             $(".importe_pagoMonto").each(function(){                
                importe_pagoMonto = ($(this).val() != '') ? $(this).val() : 0;
                sumImporte_pagoMonto += parseFloat(importe_pagoMonto);
            });
        
        var pago = sumImporte_pagoMonto.toFixed(2);        
        var cambio = parseFloat(pago - total_a_pagar).toFixed(2);
            $("#pago").val(pago);
            $('#pago_monto').val(pago);
            $('#cambio').val(cambio);        

        return cambio;
   }    



    $('#mostrarCompNota').css('display', 'none');

        //OBTENIENDO SERIE,NUMERO
        function documentoChange(){
            var selec = $('#tipo_documento option:selected').val();
            //solo para boletas, facturas, notas de credito y debito,
            //obviamos la opcion: facturas antiguas y boletas antiguas
            console.log(selec);
            if((selec == 1) || (selec == 3) || (selec == 7) || (selec == 8) || (selec == 9) || (selec == 10)){
                $.ajax({
                    url : '<?= base_url()?>index.php/serNums/selectSerie/<?= $empresa['id']?>',
                    type: 'POST',
                    data: {tipo_documento_id : selec},
                    dataType : 'HTML',
                    success :  function(data){
                        $('#serie').html(data);
                        serieChange();
                    }
                });

                var serie_selec = $('#serie option:selected').val();                
                
                $('#div_serie_actual').show();
                $('#div_serie_antiguo').hide();
                //$("#numero").attr("readonly", true);
                //seteo el valor de la serie antiguo (serie manual).
                $('#serie_antiguo').val('');
                
            }else{
                $('#div_serie_actual').hide();
                $('#div_serie_antiguo').show();
                //$("#numero").attr("readonly", false);
                $("#numero").val('');
            }
        }


        function serieChange(){
            var selec  = $("#serie option:selected").val();
          
            var tipo_documento = $('#tipo_documento option:selected').val();
            var url_ser = '<?= base_url()?>index.php/comprobantes/selectUltimoReg/<?= $empresa['id']?>/'+tipo_documento+'/'+selec;
            //alert(url_ser);
            //console.log(selec);
            $.ajax({
                url : url_ser,
                type: 'POST',
                data: {serieId : selec},
                dataType : 'JSON',
                success :  function(data){
                    $('#numero').val(parseInt(data.numero));
                }
            });          

            if(tipo_documento <= 3){
                    $('#mostrarCompNota').css('display','none');
                    if(tipo_documento == 1){
                        $('#mostrarDetraccion').css('display','block');
                    }
                    if(tipo_documento == 3){
                        $('#mostrarDetraccion').css('display','none');
                    }
                } else {
                    $('#mostrarDetraccion').css('display','none');
                    $('#mostrarCompNota').css('display','block');
                    if(tipo_documento == 7 || tipo_documento == 9){
                        cargaDocumentosNotasCredito();
                        $('#tipo_ncredito').prop('disabled',false);
                        $('#tipo_ndebito').prop('disabled',true);
                    }
                    if(tipo_documento == 8 || tipo_documento == 10){
                        cargaDocumentosNotasCredito();
                        $('#tipo_ncredito').prop('disabled',true);
                        $('#tipo_ndebito').prop('disabled',false);
                    }
                }
        }


        //EVENTO COMBOBOX TIPO DE CAMBIO
        function tipoCambio(){     
         var selec = $('#moneda_id option:selected').val();
               if(selec > 1){
                   $('#tipo_de_cambio').prop('disabled',false);
                   $.ajax({
                   url : "<?= base_url()?>index.php/comprobantes/tipoCambio",
                   method : "POST",
                   data : {moneda_id : selec},
                   dataType : 'JSON',
                   success : function(data){                    
                               $('#tipo_de_cambio').val(data.tipo_cambio);
                               calcular();
                       }
                   });                    
               } else {
                   $('#tipo_de_cambio').val('');
                   $('#tipo_de_cambio').prop('disabled',true);
                   calcular();
               }                                       
        }


    // EVENTO COMBOBOX NOTA DE CREDITO , DEBITO
        $('#tipo_documento').on('change',function(){    
           documentoChange();                
       });

        $('#serie').on('click',function(){
           serieChange();
        });
        documentoChange();

        serieChange();


        //EVENTO COMBOBOX TIPO DE CAMBIO
        $(document).on('change','#moneda_id',function(){
         tipoCambio();                                                  
        });
        
        //CAPTURANDO EVENTOS
        $('#tipo_de_detraccion').prop('disabled',true);
        //Operacion Gratuita
        $('#operacion_gratuita').on('change',function(){
            operacion_gratuita();
        });   
   
</script>
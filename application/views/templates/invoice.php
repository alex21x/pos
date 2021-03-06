<?PHP
    $anulado = ''; 
        if($comprobante->anulado == 1){
            $anulado = 'background-image: url("images/anulado/anulado.png")';         
}?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <style>

    html{ margin: 20px 20px}
    .bold,b,strong{font-weight:700}
    .tabla_borde{border:2px solid #aaa;border-radius:8px}      

    hr{height:0;-webkit-box-sizing:content-box;-moz-box-sizing:content-box;box-sizing:content-box;margin-top:20px;margin-bottom:20px;border-top:1px solid #eee;}  
    table{font-size:10px;line-height:0.4;border-spacing:0;border-collapse:collapse}

    h6{font-family:inherit;line-height:1.1;color:inherit;margin-top:10px;margin-bottom:10px}  
    p{margin:0 0 10px}  
    
    body{<?= $anulado?>;background-repeat:no-repeat;background-position:center top;font-family:"open sans","Helvetica Neue",Helvetica,Arial,sans-serif;background-color:#2f4050;font-size:13px;color:#676a6c;overflow-x:hidden;}  
    .table>tbody>tr>td{border-top:1px solid #e7eaec;padding:5px}  
    .white-bg{background-color:#fff}        
    .table-cabecera {line-height:1.3}
    .producto_cabecera{ background-color: #58ACFA;color: #FFF; text-align: center;font-weight: bold;}
    .border_bottom{text-align: right;}
    .valores_totales{line-height:1.1;padding:2px;border-collapse:collapse}
    .pie_de_pagina{line-height: 1.1; text-align: right;}
    .monto_a_pagar{font-weight: bold;font-size: 12px}
    .producto_detalle{line-height: 0.9}
    </style>
</head>
<body class="white-bg" style="background-color: #fff;">
<table width="100%" border="0">
    <tbody><tr>
        <td>
            <table width="100%" height="220px" border="0" aling="center" cellpadding="0" cellspacing="0" class="table-cabecera">
                <tbody>
                    <tr>
                    <td width="54%"  align="left">                        
                      <img src="<?PHP FCPATH;?>images/<?php echo $empresa->foto;?>" height="160" width="380" style="text-align:center;" ><br>
                        <div style="height: 2px"></div>
                        <span><strong><?php echo $empresa->empresa?></strong></span><br>
                        <span><strong>Direcci??n: </strong><?php echo $empresa->domicilio_fiscal?></span><br>                                                
                    </td>
                    <td width="2%"  align="center"></td>
                    <td width="44%"  valign="bottom" style="padding-left:0;">
                        <div  style="border:2px solid #aaa;border-radius:10px;height: 160px">
                            <table width="100%" border="0"  cellpadding="14" cellspacing="0">
                                <tr>
                                    <td align="center"><br><br><br><br>
                                        <span style="font-size:25px" text-align="center">R.U.C.: <?php echo $empresa->ruc?></span>
                                    </td>
                                </tr>  
                                <tr>
                                    <td align="center">
                                      <?php if($comprobante->tipo_documento_id == 9 or $comprobante->tipo_documento_id == 7){?>
                                           <span style="font-family:Tahoma, Geneva, sans-serif; font-size:20px" text-align="center">NOTA DE CREDITO</span>
                                      <?php }else if($comprobante->tipo_documento_id==10 or $comprobante->tipo_documento_id==8){ ?>  
                                             <span style="font-family:Tahoma, Geneva, sans-serif; font-size:20px" text-align="center">NOTA DE DEBITO</span>
                                      <?php }else{ ?>  
                                         <span style="font-family:Tahoma, Geneva, sans-serif; font-size:20px" text-align="center"><?php echo strtoupper($comprobante->tipo_documento) ?></span>
                                      <?php } ?>  
                                        <br><br><br><br><br><br>
                                        <span style="font-family:Tahoma, Geneva, sans-serif; font-size:20px" text-align="center">E L E C T R ?? N I C A</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center">
                                         <span style="font-family:Tahoma, Geneva, sans-serif; font-size:20px" text-align="center">No.: <?php echo $comprobante->serie?>-    <?php echo str_pad($comprobante->numero, 8, "0", STR_PAD_LEFT)?></span>
                                    </td>
                                </tr>                                
                               </table>
                        </div>
                        <div style="height: 25px;"></div> 
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <span><strong>Telf: </strong><?php echo $empresa->telefono_fijo?> / <?php echo $empresa->telefono_movil?></span><br>
                        <?php
                            if($almacen_principal->ver_direccion_comprobante == 1){?>
                            <span><strong>Direcci??n almac??n:</strong><?php echo $almacen_principal->alm_direccion?></span><br>
                        <?php }?> 
                    </td>
                </tr>
                </tbody></table>
                <br><br>
            <div class="tabla_borde" >                
                <table width="100%" border="0" cellpadding="6" cellspacing="0" style="padding-top: 5px">
                    <tbody>
                    <tr>
                        <td width="60%" align="left" colspan="2"><strong>Raz??n Social:</strong>  <?php echo $comprobante->razon_social?> <?php echo $comprobante->nombres?></td>
                        <td width="40%" align="left"><strong><?php if($comprobante->tipo_cliente_id==1):?>D.N.I<?php else:?>R.U.C<?php endif?></strong>  <?php echo $comprobante->ruc?> </td>
                    </tr>
                    <tr>
                        <td width="40%" align="left" colspan="3"><strong>Direcci??n: </strong>  <?php echo $comprobante->direccion_cliente?></td>
                    </tr>
                    <tr>
                        <td width="60%" align="left">
                            <strong>Fecha Emisi??n: </strong><?php echo $comprobante->fecha_de_emision?>                                                        
                        </td>
                        <td width="60%" align="left">
                            <strong>Fecha Vencimiento: </strong><?php echo $comprobante->fecha_de_vencimiento?>           
                        </td>                        
                        <td>
                        <?php if($comprobante->placa != '') {?><strong>Placa: </strong> <?php echo $comprobante->placa?></td><?php } ?>
                        
                    </tr>
                    <?php if($relacionado->id>0):?>
                    <tr>
                        <td width="60%" align="left"><strong>Tipo Doc. Ref.: </strong> <?php echo ($relacionado->tipo_documento_id==1)?"FACTURA":"BOLETA";?> </td>                        
                        <td width="40%" align="left"><strong>Documento Ref.: </strong>  <?php echo $relacionado->serie?>-<?php echo $relacionado->numero?></td>
                        <td width="60%" align="left"><strong>Fecha Doc. Ref.: </strong> <?php echo (new DateTime($relacionado->fecha_de_emision))->format("d/m/Y");?> </td>
                        <td width="40%" align="left"></td>
                    </tr>                    
                    <?php endif?>
                    
                    <tr>
                        <td width="60%" align="left"><strong>Tipo Moneda: </strong> <?php echo strtoupper($comprobante->moneda)?></td>
                        <td width="60%" align="left"><strong>Transportista: </strong> <?php echo strtoupper($comprobante->transp_nombre)?></td> 
                        <td width="60%" align="left"><strong>Vendedor : </strong> <?php echo $this->session->userdata('usuario'). " ". $this->session->userdata('apellido_paterno'); ?></td>                           
                    </tr>                    
                    <tr>
                    <!--<?php if ($configuracion->numero_guia): ?>                            
                        <td width="60%" align="left"><strong>Guia: </strong><?php echo $comprobante->numero_guia_remision?></td>
                    <?php endif ?>-->
                    <?php if ($comprobante->numero_guia_remision!=''): ?>
                        <td width="60%" align="left"><strong>N?? Guia: </strong><?php echo strtoupper($comprobante->numero_guia_remision);?></td>
                    <?php endif ?>
                    <?php if ($configuracion->numero_pedido): ?>                            
                        <td width="40%" align="left"><strong>N?? Pedido: </strong><?php echo $comprobante->numero_pedido?></td>
                    <?php endif ?>
                    <?php if ($configuracion->condicion_venta): ?>     
                        <?php if($comprobante->condicion_venta!=''): ?>                       
                            <td width="60%" align="left"><strong>Condici??n de Venta: </strong><?php echo $comprobante->condicion_venta?>
                         <?php endif ?>
                    <?php endif ?>                    
                         <?php if ($configuracion->orden_compra): ?>
                            <?php if($comprobante->orden_compra!=''):?>
                            <td width="40%" align="left"><strong>O/C: </strong>  <?php echo $comprobante->orden_compra?></td>
                            <?php endif ?>
                        <?php endif ?>
                        </td>
                        <td width="40%" align="left"></td>
                    </tr>                    
                    
                    </tbody></table>
            </div><br>
            
            <div class="">
                <table width="750px" border="0" cellpadding="7" cellspacing="0">
                    <tbody>
                        <tr class="producto_cabecera">
                            <td>Cantidad</td>
                            <td>Unid. Med.</td>
                            <!--<td align="center" class="bold">C??digo</td>-->
                            <td>Descripci??n</td>                            
                            <td>V.Uni</td>
                            <!--<td align="center" class="bold">Desc. Uni.</td>-->
                            <td>Valor Total</td>
                        </tr>
                        <?php foreach($detalles as $item):?>
                        <tr class="border_top">
                            <td align="center" width="10%">
                                <?php echo $item->cantidad?>
                            </td>
                            <td align="center" width="10%">
                                <?php echo $item->medida_codigo_unidad?>
                            </td>                         
                            <td align="left" width="50%" class="producto_detalle">                              
                               <?php $lineas = count(explode("\n", $item->descripcion));?>
                               <?php echo $item->descripcion.' '.$item->serie_detalle?>
                            </td>                            
                            <td align="right" width="10%">
                            	<?php echo $comprobante->simbolo?> <?php echo $item->importe?>
                            </td>                            
                            <td align="right" width="10%">
                                <!--<?php $total = ($comprobante->incluye_igv==1) ? $item->total : $item->subtotal ; ?>-->
                                 <?php $total = $item->total; ?>
                            	<?php echo $comprobante->simbolo?> <?php echo $total?>
                            </td>
                        </tr>
                   		<?php endforeach?>
                    </tbody>
                </table></div><br>
                <hr style="height: 1px; border: 0; border-top: 1px solid #666; margin: 0px 0;">
                <div class="">
            <table width="100%" border="0" cellpadding="6" cellspacing="0" >
                <tbody><tr>
                    <td width="100%" valign="top" colspan="3">
                        <table width="100%" border="0" cellpadding="2" cellspacing="0">
                            <tbody>
                            <tr>
                                <td width="50%">
                                    <br>                                    
                                    <span style="font-family:Tahoma, Geneva, sans-serif; font-size:12px" text-align="center"><strong>SON: <?php echo $comprobante->total_letras?></strong></span>
                                </td>                               
                                <td width="50%" style="text-align: right;">    
                                   <table border="0" width="100%">
                                        <tbody>                                    
                                    <tr>                           
                                        <td>                        
                                    <table width="100%" border="0" class="pie_de_pagina">
                                        <tbody>
                                     <?php if($comprobante->tipo_documento_id != 0){?>      
                                        <?php if($comprobante->total_anticipos > 0):?>
                                        <tr>
                                            <td><strong>Total Anticipo:</strong></td>
                                            <td><span><?php echo $comprobante->simbolo?> <?php echo $comprobante->total_anticipos?></span></td>
                                        </tr>
                                        <?php endif?>
                                        <?php if($comprobante->descuento_global > 0):?>
                                        <tr >
                                            <td><strong>Descuento Global:</strong></td>
                                            <td><span><?php echo $comprobante->simbolo?> <?php echo $comprobante->descuento_global?></span></td>
                                        </tr>
                                        <?php endif?>                                                       
                                        <tr >
                                            <td><strong>Op. Gravadas:</strong></td>
                                            <td><span><?php echo $comprobante->simbolo?> <?php echo $comprobante->total_gravada?></span></td>
                                        </tr>                            
                                        <tr >
                                            <td><strong>Op. Inafectas:</strong></td>
                                            <td ><span><?php echo $comprobante->simbolo?> <?php echo $comprobante->total_inafecta?></span></td>
                                        </tr>
                                        <tr >
                                            <td><strong>Op. Exoneradas:</strong></td>
                                            <td ><span><?php echo $comprobante->simbolo?> <?php echo $comprobante->total_exonerada?></span></td>
                                        </tr>                            
                                        <?php if($comprobante->total_igv > 0):?>
                                        <tr >
                                            <td><strong>IGV:</strong></td>
                                            <td ><span><?php echo $comprobante->simbolo?> <?php echo $comprobante->total_igv?></span></td>
                                        </tr>
                                        <?php endif?>
                                        <?php if($comprobante->total_icbper > 0):?>
                                        <tr>
                                            <td><strong>ICBPER:</strong></td>
                                            <td><span><?php echo $comprobante->simbolo?> <?php echo $comprobante->total_icbper?></span></td>
                                        </tr>
                                        <?php endif?>                            
                                        <?php if($comprobante->total_otros_cargos > 0):?>
                                        <tr>
                                            <td><strong>Otros Cargos:</strong></td>
                                            <td><span><?php echo $comprobante->simbolo?> <?php echo $comprobante->total_otros_cargos?></span></td>
                                        </tr>
                                        <?php endif?>
                                    <?php } ?>
                                        <tr class="border_bottom monto_a_pagar">
                                            <td><strong>Total a Pagar:</strong></td>
                                            <td><span><?php echo $comprobante->simbolo?> <?php echo $comprobante->total_a_pagar?></span></td>
                                        </tr>   
                                        <tr class="border_bottom">
                                            <td>&nbsp;</td>
                                            <td><hr style="height: 1px; border: 0; border-top: 1px solid #666; margin: 0px 0;"></td>                                            
                                        </tr>                                        
                                        </tbody>
                                    </table>
                                </td>
                                    </tr>                                                                
                                </tbody>
                            </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>                    
                        <?php if(count($anticipos)>0):?>
                        <table width="100%" border="0" cellpadding="5" cellspacing="0">
                            <tbody>
                            <tr>
                                <td>
                                    <br>
                                    <strong>Anticipo</strong>
                                    <br>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <table width="100%" border="0" cellpadding="5" cellspacing="0" style="font-size: 10px;">
                            <tbody>
                            <tr>
                                <td width="30%"><b>Nro. Doc.</b></td>
                                <td width="70%"><b>Total</b></td>
                            </tr>
                            <?php foreach($anticipos as $item):?>
                            <tr class="border_top">
                                <td width="30%"><?php echo $item->serie?>-<?php echo $item->numero?></td>
                                <td width="70%"><?php echo $comprobante->simbolo?> <?php echo $item->total_a_pagar?></td>
                            </tr>
                        	<?php endforeach?>
                            </tbody>
                        </table>
                    	<?php endif?>
                    </td>                    
                </tr>
                <tr> 
                    <td style="text-align: center;">
                        <img src="<?PHP echo $rutaqr?>" style="width:2cm;height: 1.8cm; padding-top: 1.8px">
                                <br>
                                <div style="font-size: 8px">
                                    <?php echo $certificado?>
                                </div>
                    </td>
                    <td style="text-align: left;"  class="valores_totales"> 
                                <strong><?php echo $empresa->empresa?></strong><br><br>
                                <?php echo $empresa->numero_de_cuenta?>                                                               
                    </td>    
                                                          
                    <td>                        
                        <div>  
                        <b>MEDIO PAGO</b><br><br>
                         <?PHP foreach($pagoMonto as $value){?>                                        
                                                <table style="text-align: left;" border="0" class="pie_de_pagina">
                                                    <tr>
                                                        <td width="50"><b><?= $value->tipo_pago?></b></td>
                                                        <td width="50"><b><?= $value->monto?></b></td>                                                
                                                    </tr>
                                                </table>
                                            <?PHP }?>                                    
                        <?php if(count($anticipos)>0):?>
                            <strong>Informaci??n Adicional</strong>
                        <?php endif?>                        
                        </div>
                    </td>                    
                </tr>
                <tr> 
                    <td>&nbsp;</td>
                    <td style="text-align: left;"  class="valores_totales"> 
                                <strong>Consultar en :</strong><br>
                                <?php echo base_url();?>                                                               
                    </td> 
                </tr>
                <tr style="margin-top: 10px">
                    <td colspan="3">
                        <div align="center"><br><br>
                            EMITIDO MEDIANTE PROVEEDOR
                            AUTORIZADO POR LA SUNAT
                            RESOLUCION N.?? 097- 2012/SUNAT
                        </div><br>
                    </td>                    
                </tr></tbody></table>
                <hr style="height: 1px; border: 0; border-top: 1px solid #666; margin: 1px 0;">
                <table width="100%">
                    <tbody>
                <tr>                                                           
                    <td align="left" colspan="3"><br>  
                        <b>OBSERVACIONES:</b> <?php $lineas = count(explode("\n", $comprobante->notas));?>
                            <?php echo $comprobante->notas?>                                        
                    </td>
                </tr>                                                      
                <tr class="pie_de_pagina">
                    <td colspan="3" align="center"><h3><center></center><?= $this->session->userdata('empresa_pie_pagina')?></center></h3></td>
                </tr>    
                </tbody></table></div>  
        </body>
        </html>
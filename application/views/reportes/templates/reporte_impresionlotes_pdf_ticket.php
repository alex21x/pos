<html>
    <head>
        <style>
            html, body {
                margin: 0 2px;
                padding: 0;
                font-family: sans-serif;
            }
            span #height-container { position: absolute; left: 0px; right: 0px; top: 0px; }
            .datos_titulo1{
                font-size: 5px;
                text-align: center;
                line-height: 1em;                
            }            

            .datos_titulo2{
                margin: 0 4px;
                font-size: 4px;
                text-align: center;
                line-height: 1em;
            }            
            .tabla_cabecera{
                font-size: 5px;                
            }
            .tabla_datos{
                font-size: 4px;
                text-align: center;
            }
            .tabla_datos_cantidad{
                font-size: 5px;
                text-align: center;
            }
            .datos_totales{
                font-size: 5px;                                
            }
            .datos_totales_bold{
                font-size: 6px;
                font-weight: bold;                  
            }
            .datos_cabecera{
                font-size: 4.3px;                
                text-align: center;       
                line-height: 1em;         
            }            
            .datos_cabecera_bold{
                font-weight: bold;
            }
            .datos_cliente{
                text-align: left;
                margin-left: 4px;                
                font-size: 4.5px;                
                line-height: 1em;                
            }
        </style>
        <title>Sistema de Ventas</title>
    </head>
    <body>
<?php 
 switch ($comprobante->tipo_documento_id) {
    case 1:
        $tipo_documento = "FACTURA";
        break;
    case 3:
        $tipo_documento = "BOLETA";
        break;
    case 7:
        $tipo_documento = "NOTA DE CREDITO";
        $data['tipo_nota'] = $this->tipo_ncreditos_model->select($data['comprobante']['tipo_nota_id']);
        $data['comp_adjunto'] = $this->comprobantes_model->select($data['comprobante']['com_adjunto_id']);
        break;
    case 8:
        $tipo_documento = "NOTA DE DEBITO";
        $data['tipo_nota'] = $this->tipo_ndebitos_model->select($data['comprobante']['tipo_nota_id']);
        $data['comp_adjunto'] = $this->comprobantes_model->select($data['comprobante']['com_adjunto_id']);
        break;
    }
    $tipopago ="";
    $data['tipo_documento'] = $tipo_documento;  
    $ruta_foto = base_url()."images/".$empresa->foto;
 ?>
        
        <?PHP $i=1;foreach($rsReporteLotes as $rsReporteLote) {?>
        <img src="<?php echo 'images/'.$empresa->foto;?>" height="80" width="100%" style="text-align:center;" border="0">
        
        <span id="height-container">
            <p class ="datos_titulo1 cabecera">
                <span class="datos_cabecera_bold"><?php echo $empresa->empresa?></span><br>
                RUC : <?php echo $empresa->ruc?><br>
                <?php echo $empresa->domicilio_fiscal?><br>
                <?php
                if($almacen_principal->ver_direccion_comprobante == 1){?>
                <span>Dirección almacén: <?php echo $almacen_principal->alm_direccion?></span><br>
                <?php }?>                
                -------------------------------------------------------<br>
                <b><?php echo $data['tipo_documento']; ?>&nbsp;&nbsp;<?php echo $rsReporteLote->nserie?>-<?php echo str_pad($rsReporteLote->nDocumento, 8, "0", STR_PAD_LEFT)?></b><br>
                Fecha/hora emision: <?php echo $rsReporteLote->fecha_de_emision;?><br>                
                Fecha vencimiento: <?php echo $comprobante->fecha_de_vencimiento;?><br>                
                Vendedor : <?php echo $this->session->userdata('usuario'). " ". $this->session->userdata('apellido_paterno'); ?><br>
                <!--Transportista : <?php echo$comprobante->transp_nombre?> <br>-->
                -------------------------------------------------------<br></p>
                <p class="datos_cliente"> CLIENTE<br>
                <?php echo $rsReporteLote->razon_social_cliente?></br><br><?php echo "  ". $rsReporteLote->cliente_ruc?><br>
                DIRECCION:<?php echo "  ". $rsReporteLote->cliente_domicilio?><br>
                ----------------------------------------------------------------------<br>                
                </p>                
            </p>            
            <table width="100%">
                <thead>
                    <tr>
                        <th width="8" align="center" class="tabla_cabecera">CANT.</th>
                        <th class="tabla_cabecera">PRODUCTO</th>
                        <th width="13" align="center" class="tabla_cabecera">P/U</th>
                        <th width="13" align="center" class="tabla_cabecera">TOTAL</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($rsReporteLote->detalles as $item){
                            //$total = ($comprobante->incluye_igv==1) ? $item->total : $item->subtotal ;
                        $total = $item->total;
                            $tipopago = $item->tipo_pago;?>
                    <tr>
                        <td class="tabla_datos_cantidad"><?php echo $item->cantidad?></td>
                        <td class="tabla_cabecera"><?php echo $item->descripcion?></td>
                        <td class="tabla_datos_cantidad"><?php  echo $item->importe?></td>
                        <td class="tabla_datos_cantidad"><?php  echo $total?></td>
                    </tr>
                    <?PHP }?>                    
                </tbody>
            </table>
            <p align="center" class ="datos_titulo1">
            -------------------------------------------------------<br>
            </p>
            <table>

                <?PHP if($rsReporteLote->tipo_comprobante == 2){?>
                <tr>
                    <td class="datos_totales">Op. Gravadas:</td>
                    <td class="datos_totales"><?php echo $rsReporteLote->simbolo?> <?php echo $rsReporteLote->total_gravada?></td>
                </tr>
                <tr>
                    <td class="datos_totales">Op. Inafectas:</td>
                    <td class="datos_totales"><?php echo $rsReporteLote->simbolo." ".$rsReporteLote->total_inafecta?></td>
                </tr>
                <tr>
                    <td class="datos_totales">Op. Exonerada:</td>
                    <td class="datos_totales"><?php echo $rsReporteLote->simbolo." ".$rsReporteLote->total_exonerada?></td>
                </tr>

                <tr>
                    <td class="datos_totales">IGV (18%):</td>
                    <td class="datos_totales"><?php echo $rsReporteLote->simbolo." ".$rsReporteLote->total_igv?></td>
                </tr>
                <?php if($comprobante->total_icbper > 0):?>
                 <tr>
                    <td class="datos_totales">ICBPER:</td>
                    <td class="datos_totales"><?php echo $rsReporteLote->simbolo?> <?php echo $rsReporteLote->total_icbper?></td>
                </tr>  
                <?php endif?>
                <tr>
                    <td class="datos_totales_bold">IMPORTE TOTAL:</td>
                    <td class="datos_totales_bold"><?php echo $rsReporteLote->simbolo." ".$rsReporteLote->total_a_pagar?></td>
                </tr>
                <tr>
                    <td class="datos_totales_bold">MEDIO PAGO</td>
                </tr>
                <?PHP } else{?>
                    <tr>
                        <td class="datos_totales_bold">IMPORTE TOTAL :</td>
                        <td class="datos_totales_bold"><?php echo $rsReporteLote->simbolo." ".$rsReporteLote->total_a_pagar?></td>
                    </tr>
                <?PHP }?>

                <?PHP foreach($rsReporteLote->pagoMonto as $value){?>                                                                                
                    <tr>
                        <td class="datos_totales"><?= $value->tipo_pago?></td>
                        <td class="datos_totales"><?= $value->monto?></td>
                    </tr>                                        
                <?PHP }?>
                <!--<tr>
                    <td class="datos_totales">Tipo Pago:</td>
                    <td class="datos_totales"><?php echo $comprobante->tipo_pago;?></td>
                </tr>-->
                <?PHP if($comprobante->placa != NULL){?>                
                <tr>
                    <td class="datos_totales">PLACA :</td>
                    <td class="datos_totales"><?php echo $comprobante->placa?></td>
                </tr>
                <?PHP }?>
                <tr>
                    <td class="datos_totales">SON :</td>
                    <td class="datos_totales"><?php echo $rsReporteLote->total_letras?></td>
                </tr>
                <tr>
                    <td class="datos_totales">OBSERVACIONES :</td>
                    <td class="datos_totales"><?php echo $rsReporteLote->notas?></td>
                </tr>                
                <tr>                    
                    <td class="datos_titulo2" colspan="2"><?php echo $rsReporteLote->firma_sunat?></td>
                </tr>                
            </table>            
            <p align="center"><img width="40" height="40" src="<?PHP echo $rutaqr?>"></p>            
        </span>
        <div align="center" class="datos_totales">
                    EMITIDO MEDIANTE PROVEEDOR
                    AUTORIZADO POR LA SUNAT
                    RESOLUCION N.° 097- 2012/SUNAT
        </div>
        <div align="center" class="datos_totales">
            <h3><center><?= $this->session->userdata('empresa_pie_pagina')?></center></h3>
        </div>

        <?PHP if($i != count($rsReporteLotes)){?>
        <div style="page-break-after: always"></div>
        <?PHP } $i++;}?>
    </body>
</html>


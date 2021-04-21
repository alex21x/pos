<style type="text/css">
	
	label{
		width: 100%;
	}
	fieldset 
  {
    border: 1px solid #ddd !important;
    margin: 0;
    xmin-width: 0;
    padding: 10px;       
    position: relative;
    border-radius:4px;
    background-color:#f5f5f5;
    padding-left:10px!important;
  } 
  
    legend
    {
      font-size:15px;
      font-weight:bold;
      margin-bottom: 0px; 
      width: 35%; 
      border: 1px solid #ddd;
      border-radius: 4px; 
      padding: 5px 5px 5px 10px; 
      background-color: #ffffff;
    }


</style>

<br><br>



<script type="text/javascript">
	
	$(document).ready(function(){
		$("#fecha_desde").datepicker();
		$("#fecha_hasta").datepicker();	

		$("#categoria").autocomplete({
			source: '<?= base_url()?>index.php/categoria/selectAutocomplete',
			minLength : 2,
	            select : function (event,ui){                                         
	                var data_cat = '<input type="hidden" value="'+ ui.item.id + '" name = "categoria_id" id = "categoria_id">';
	                $('#data_cat').html(data_cat);                               
	            }        
		});

		$("#linea").autocomplete({
			source: '<?= base_url()?>index.php/lineas/selectAutocomplete',
			minLength : 2,
	            select : function (event,ui){                                     
	                var data_lin = '<input type="hidden" value="'+ ui.item.id + '" name = "linea_id" id = "linea_id">';
	                $('#data_lin').html(data_lin);                               
	            }        
		});

		$("#marca").autocomplete({
			source: '<?= base_url()?>index.php/marcas/selectAutocomplete',
			minLength : 2,
	            select : function (event,ui){                                     
	                var data_mar = '<input type="hidden" value="'+ ui.item.id + '" name = "marca_id" id = "marca_id">';
	                $('#data_mar').html(data_mar);                               
	            }        
		});

		$("#producto").autocomplete({			
			source: '<?= base_url()?>index.php/productos/selectAutocomplete?almacen='+$("#almacen option:selected").val(),
			minLength : 2,
	            select : function (event,ui){                                     
	                var data_pro = '<input type="hidden" value="'+ ui.item.id + '" name = "producto_id" id = "producto_id">';
	                $('#data_pro').html(data_pro);                               
	            }        
		});		
	});
</script>
<div class="container">
	<h3>IMPRESION POR LOTES</h3><br>
	<form id="formReporte">
		<input type="hidden" id="busqueda" name="busqueda" value="<?= $busqueda?>">
	<div class="row">
		<fieldset class="border p-1">
		<div class="col-xs-6 col-md-4 col-lg-3">
			<label>Fecha Desde
				<input class="form-control" name="fecha_desde" id="fecha_desde">
			</label>
		</div>	
		<div class="col-xs-6 col-md-4 col-lg-3">
			<label>Fecha Hasta
				<input class="form-control" name="fecha_hasta" id="fecha_hasta">
			</label>
		</div>	
		<div class="col-xs-6 col-md-3 col-lg-3">
			<div class="radio">
			  <label>
			    <input type="radio" name="tipo_comprobante" id="tipo_comprobante" value="<?= ST_NOTA_PEDIDO?>" checked>
			    NOTA VENTA
			  </label>
			</div>
			<div class="radio">
			  <label>
			    <input type="radio" name="tipo_comprobante" id="tipo_comprobante" value="<?= ST_COMPROBANTE?>">
			    COMPROBANTE
			  </label>
			</div>	
		</div>	
		<div class="col-xs-6 col-md-4 col-lg-3 tipo_documento" style="display: none">
			<label>Tipo Documento
				<select class="form-control" name="tipo_documento" id="tipo_documento">
					<option value="">Seleccione</option>
					<?PHP foreach($tipo_documentos as $value){?>
					<option value="<?= $value['id']?>"><?= $value['tipo_documento']?></option>
					<?PHP }?>	
				</select>				
			</label>
		</div>
		<!--
		<div class="col-xs-6 col-md-4 col-lg-3">
			<label>Tipo Pago
				<select class="form-control" name="tipo_pago" id="tipo_pago">
					<?PHP foreach($tipo_pago as $value){?>
					<option value="<?= $value->id?>"><?= $value->tipo_pago?></option>
					<?PHP }?>	
				</select>				
			</label>
		</div>-->
	</fieldset><br>
	</div>
	<div class="row">
	<fieldset class="border p-1">
		<!--<div class="col-xs-6 col-md-4 col-lg-3">
			<label>Numero:
				<input class="form-control" name="linea" id="linea">
				<div id="data_lin"><input type="hidden" name="linea_id" id="linea_id"></div>
			</label>
		</div>-->
		<div class="col-xs-3 col-md-4 col-lg-3">
			<label>N° Inicial
				<input class="form-control" name="numero_inicial" id="numero_inicial">				
			</label>
		</div>	
		<div class="col-xs-3 col-md-4 col-lg-3">
			<label>N° Final
				<input class="form-control" name="numero_final" id="numero_final">				
			</label>
		</div>
		<div class="col-xs-6 col-md-4 col-lg-3">
			<label>Vendedor
				<select class="form-control" name="vendedor" id="vendedor">
					<option value="">Seleccionar</option>
				<?PHP foreach($vendedores as $empleado){?>			
					<option value="<?php echo $empleado['id']?>"><?php echo $empleado['apellido_paterno']." ".$empleado['apellido_materno'].", ".$empleado['nombre'] ?></option>
				<?PHP }?>
				</select>	
			</label>
		</div>		
		</fieldset><br>
		<div class="col-xs-12 col-md-6 col-lg-6">
				<a id="buscarReporte" href="#" class="btn btn-primary btn-sm colbg">Buscar</a>
				<a id="btn_limpiar" href="#" class="btn btn-primary btn-sm colbg" >Limpiar</a>				
				<a id="exportar_repo_pdf" href="#" class="btn btn-danger btn-sm colbg">&nbsp;&nbsp;&nbsp;&nbsp; PDF/A4&nbsp;&nbsp;&nbsp;</a>
				<a id="exportar_repo_pdf_" href="#" class="btn btn-danger btn-sm colbg">&nbsp;&nbsp;&nbsp;&nbsp;TICKET&nbsp;&nbsp;&nbsp;</a>
				
				
			</label>
		</div>			
	</div>		
	</form>
</div>
<div class="container-fluid"> 
	<br><br>
	<div id="grid"></div>
</div>


<script type="text/javascript">
	
$(document).ready(function(){		
	function buscarReporte(){
		$("#busqueda").val('');        
			dataSource.read();	
	}
	$('#buscarReporte').click(function(e) {
		e.preventDefault();
		buscarReporte();	
    });			

	/* BOTON LIMPIAR */
	$(document).on("click","#btn_limpiar",function(){
	        $("#formReporte")[0].reset();	      
	        $("#producto_id").val('');
	        $("#categoria_id").val('');
	        $("#linea_id").val('');
	        $("#marca_id").val('');
	        $("#marca_id").val('');
	        $("#tipo_documento").val('');
 			$("#tipo_pago").val('');
 			$("#vendedor").val('');
	        buscarReporte();
	}); 
         
        // Exportar reporte pdf-a4
        $('#exportar_repo_pdf').click(function() {
        datos = $("#formReporte").serialize();       
               
        var url ='<?PHP echo base_url() ?>index.php/reportes/impresionLotes_pdf?'+datos;
        window.open(url, '_blank');

        });
        // Exportar reporte Ticket
	    $('#exportar_repo_pdf_').click(function() {
        datos = $("#formReporte").serialize();       
               
        var url ='<?PHP echo base_url() ?>index.php/reportes/impresionLotes_pdf_ticket?'+datos;
        window.open(url, '_blank');

        });

	   //CHECKED TIPO COMPROBANTE
	   $("[name=tipo_comprobante]").on("click",function(){
	   		var tipo_comprobante = $(this).val();
	   		if(tipo_comprobante == 3){
	   			$(".tipo_documento").css("display","block");
	   			$("#numero_inicial").prop("readonly",true);
	   			$("#numero_final").prop("readonly",true);
	   		} else{
				$(".tipo_documento").css("display","none");								
				$("#numero_inicial").prop("readonly",false);
	   			$("#numero_final").prop("readonly",false);
	   		}
	   });	   

	   $("[name=tipo_documento]").on("change",function(){
	   		if($("[name=tipo_documento] option:selected").val() != ''){
	   			$("#numero_inicial").prop("readonly",false);
	   			$("#numero_final").prop("readonly",false);
	   		} else{
	   			$("#numero_inicial").prop("readonly",true);
	   			$("#numero_final").prop("readonly", true);
	   		}
	   })
	});

	//PAGINAS COMPROBANTES 11-03-2021
	var dataSource = new kendo.data.DataSource({
             transport: {
                read: {
                    url:"<?php echo base_url()?>index.php/reportes/reporte_impresionLotes/",
                    dataType:"json",
                    method:'post',
                    data:function(){
                        return {
                        	busqueda : function(){
                        		return $("[name=busqueda]").val();
                        	},
                            tipo_comprobante:function(){
                                return $("[name=tipo_comprobante]:checked").val();
                            },                                                                                 
                            fecha_desde:function(){
                            return $("[name=fecha_desde]").val();
                            },
                            fecha_hasta:function(){
                            return $("[name=fecha_hasta]").val();
                            },
                            tipo_documento:function(){
                                return $("[name=tipo_documento] option:selected").val();
                            },                                                                                 
                            numero_inicial:function(){
                            return $("[name=numero_inicial]").val();
                            },
                            numero_final:function(){
                            return $("[name=numero_final]").val();
                            },
                            vendedor: function(){
                            return $("[name= vendedor] option:selected").val();
                            }
                        }
                    }
                }
            },
            schema:{
                data:'data',
                total:'rows'
            },
            pageSize: 10,
            serverPaging: true,
            serverFiltering: true,
            serverSorting: true
                             
    });
    $("#grid").kendoGrid({
        dataSource: dataSource,
        height: 550,
        sortable: true,
        pageable: true,
        columns: [
                    {field:'documento_id',title:'ID',width:'60px'},
                    {field:'nDocumento',title:'CORRELATIVO',width:'60px'},
                    {field:'fecha_de_emision',title:'FECHA EMISION',width:'70px'},
                    {field:'razon_social_cliente',title:'CLIENTE',width:'60px'},
                    {field:'total_a_pagar',title:'TOTAL',width:'60px'},
                    {field:'vendedor',title:'USUARIO',width:'60px'},                    
                    {field:'alm_nombre', title:'ALMACEN',width:'40px'}
                                
        ],
        dataBound:function(e){           
        }
    }); 

</script>
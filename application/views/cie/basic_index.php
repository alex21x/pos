<h2 align="center"><strong>TIPO DE ENFERMEDADES CIE</strong></h2>
<br>
<div class="container">
	<div class="row">
		<div class="col-md-6">
			<button id="btn_nueva_especialidad" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal">Nueva Enfermedad</button>
			<button id="btn_subir_producto"  class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">Importar CIE</button>
			<button id="exportarExcel"  class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">Exportar CIE</button>  
			<a href="<?php echo base_url()?>files/xlsx/descargar_formato/formato_cie.xlsx" class="btn btn-default btn-sm">Descargar Formato xls</a>
		</div>
		<div class="col-md-4 col-md-offset-2">
			<div class="form">
				<div class="input-group">
					<input type="text" class="form-control" id="search" placeholder="Buscar por nombre">
					<span class="input-group-btn">
						<button class="btn btn-default" type="button" id="btn_buscar_habitacion"><span class="glyphicon glyphicon-search"></span></button>
					</span>
				</div>
			</div>
		</div>
		
	</div>
	<br>
	<div class="row">
	
	</div>
		
	<br>
</div>
<div class="container-fluid">
	<div id="grid"></div>
</div>	
<script>

	 jQuery(document).ready(function($){
        $('#exportarExcel').click(function() {
            var descripcion = $('#search').val();           

            if(descripcion  ==''){
                cliente =0;
            }
                        
            var url ='<?PHP echo base_url() ?>index.php/cie/exportarExcel/'+descripcion;
            window.open(url, '_blank');
        });
    });
	
	var dataSource = new kendo.data.DataSource({
		transport: {
			read: {
				url:"<?PHP echo base_url()?>index.php/cie/getMainList/",
				dataType: "json",
				method: "post",
				data: function(){
					return{
						search:function(){
							return $("#search").val();
						}
					}
				}				
			}
		},

		schema:{
			data: 'data',
			total: 'rows'
		},
		pageSize: 20,
		serverPaging: true,
		serverFiltering: true,
		serverSorting: true
	});

	$("#grid").kendoGrid({
		dataSource: dataSource,
		height: 550,
		sortable: true,
		pageable: true,
		columns: [  {field:'idd',title:'N°',width:'80px',template:"#= id #"},
		            {field:'codigo',title:'CODIGO',width:'80px'},
					{field:'descripcion',title:'DESCRIPCION',width:'150px'},					
					{field:'cie_editar',title:'&nbsp',width:'60px',template:"#= cie_editar #"},
					{field:'cie_eliminar',title:'&nbsp',width:'60px',template:"#= cie_eliminar #"}
		],
		dataBound: function(e){

			//GALERIA
			$(".show_galeria").click(function(e) {				
                var _val = $(this).data("id");
                javascript:window.open('<?PHP echo base_url() ?>index.php/especialidades/show_galeria/'+_val,'','width=750,height=600,scrollbars=yes,resizable=yes');
                
            });
			//modificar nivel
			$('.btn_modificar_cie').click(function(e){
				var idCie = $(this).data('id');
				$("#myModal").load('<?= base_url()?>index.php/cie/editar/'+idCie,{});
			});

			$('.btn_eliminar_cie').click(function(e){				
				e.preventDefault();
				var idEspecialidad = $(this).data('id');				
				var msg = $(this).data('msg');				

				var url = '<?= base_url()?>index.php/cie/eliminar/'+idEspecialidad;
				$.confirm({
					title: 'Confirmar',
					content: msg,
					buttons: {
						confirm:{
							text:'aceptar',
							btnClass: 'btn-blue',
							action: function(){
								$.ajax({
									url: url,
									dataType: 'json',
									method: 'get',
									success: function(response){
										if(response.status ==  STATUS_OK){
											toast('success',1500,'cie eliminado');
											dataSource.read();
										}
										if(response.status == STATUS_FAIL){
											toast('error',2000,'No se pudo eliminar el registro');
										}
									}
								});
							}
						},
						cancel: function(){
						}
					}
				});
			});
		}
	});

	//nuevo nivel
	$('#btn_nueva_especialidad').click(function(e){
		e.preventDefault();
		$('#myModal').load('<?= base_url()?>index.php/cie/crear',{});
	});

	//buscar nivel
	$('#btn_buscar_especialidad').click(function(e){
		e.preventDefault();
		dataSource.read();
	});

	//buscar nivel por campo texto
	$("#search").keyup(function(e){
		e.preventDefault();
		var enter = 13;
		if(e.which == enter){
			dataSource.read();
		};
	});

	//subir cie por excel
    $("#btn_subir_producto").click(function(e){
         e.preventDefault();
        $("#myModal").load('<?php echo base_url()?>index.php/cie/subirCie',{});       
    });

</script>
<style type="text/css">
#btnproforma{
   display: none;
}

<style>
    #refresh img{
        margin-left: 50px;
    }
</style>
<p class="bg-info">
    <?PHP echo $this->session->flashdata('mensaje'); ?>
</p>
<div class="container">
    <form> 
      <input type="hidden" id="proforma_id" name="proforma_id" value="<?= $proforma_id?>">   
        <h2>Lista de proformas: <?php echo $empresa[0]['empresa']?></h2>

            <div class="row">
                <button type="button" id="btnproforma" data-toggle="modal" data-target="#myModal">MODAL</button>
                <div class="col-xs-12 col-md-6 col-lg-6">
                    <label>Cliente: </label><br>
                    <input type="text" class="form-control input-sm" id="cliente" name="cliente" placeholder="Cliente" value="<?= $proveedor_select;?>">
                    <div id="data_cliente">
                        <input type="hidden" name = "cliente_id" id = "cliente_id" >
                        <?php
                            if(isset($proveedor_select_id) && ($proveedor_select_id != '')){
                            echo '<input type="hidden" value="' . $proveedor_select_id . '" name = "cliente_id" id = "cliente_id" >';
                            }
                        ?>
                    </div>
                </div>                 
                <!-- <div class="col-xs-2">
                    <label>Serie Número</label>
                    <input type="text" class="form-control input-sm" id="serie_numero" name="serie_numero">
                </div> -->
                <div class="col-xs-6 col-md-6 col-lg-3">
                    <label>Fecha Inicio</label>
                    <input type="text" class="form-control input-sm" id="fecha_inicio" name="fecha_inicio" >
                </div> 
                 <div class="col-xs-6 col-md-6 col-lg-3">
                    <label>Fecha Fin</label>
                    <input type="text" class="form-control input-sm" id="fecha_fin" name="fecha_fin" >
                </div> 
                <div class="col-xs-6 col-md-6 col-lg-2">
                    <label>Documento</label>
                    <input type="text" class="form-control input-sm" id="documento" name="documento" >
                </div>
                <div class="col-xs-6 col-md-3 col-lg-3">
                    <label>Usuario</label>
                    <select class="form-control input-sm" id="vendedor" name="vendedor">
                        <option value="">Seleccionar</option>
                            <?PHP foreach ($vendedores as $value_empleado){?>
                        <option value="<?php echo $value_empleado['id']?>"><?php echo $value_empleado['apellido_paterno']." ".$value_empleado['apellido_materno'].", ".$value_empleado['nombre'] ?></option>
                            <?php }?>
                    </select>
                </div>       
                <div class="col-xs-6 col-md-3 col-lg-3">
                    <label>Estado</label>
                    <select class="form-control input-sm" id="proceso_estado" name="proceso_estado">
                        <option value="">Seleccionar</option>
                            <?PHP foreach ($proceso_estados as $value){?>
                        <option value="<?php echo $value->id?>"><?php echo $value->proceso_estado?></option>
                            <?php }?>
                    </select>
                </div>
                <div class="col-xs-12 col-md-6 col-lg-4">
                    <br>
                    <input type="button" class="btn btn-primary " id="btn_search" value="Buscar">
                    <input type="button" class="btn btn-primary " id="btn_limpiar" value="Limpiar">
                    <input type="hidden" value="<?php echo $empresa['id']?>" name="empresa_id" id="empresa_id">
                </div>
                      <div class="col-xs-12 col-md-11 col-lg-11"><br>
                      <div id="totalRows"></div>                                        
                      <div id="total_pendientes"></div>                
                      <div id="total_aceptados"></div> 
                      <div id="total_anulados"></div>
                </div> 
       
            </div> 
    </form>
</div>
<div class="row" align="right" style="padding-right: 25%;">
    <br>
    <a href="<?PHP echo base_url(); ?>index.php/proformas/nuevo/<?php echo $empresa['id']?>" class="btn btn-success">Nueva proforma</a>    
    <a id="exportarExcel" class="btn btn-primary"><i class="glyphicon glyphicon-save"></i> Reporte Listado</a>
    <a id="exportarExcel_rd" class="btn btn-primary"> Reporte Detallado</a>
</div>
<div class="container-fluid">
    <br>
    <div id="grid"></div>    
</div>
<!--<meta http-equiv="refresh" content="20">-->
<script src="<?PHP echo base_url(); ?>assets/js/funciones.js"></script>
<script type="text/javascript">


// capturo el evento click
</script>
<script type="text/javascript">
    // FECHA JAVASCRIPT            
        var fecha = new Date(); //Fecha actual
        var mes = fecha.getMonth()+1; //obteniendo mes
        var dia = 1; //obteniendo dia
        var ano = fecha.getFullYear(); //obteniendo año
        if(dia<10)
          dia='0'+dia; //agrega cero si el menor de 10
        if(mes<10)
          mes='0'+mes //agrega cero si el menor de 10
          fecha_inicio =dia+"-"+mes+"-"+ano;

          ultimoDiaMes = new Date(ano, mes, 0);
          fecha_fin = ultimoDiaMes.getDate()+"-"+mes+"-"+ano;
            
          $("#fecha_inicio").val(fecha_inicio);
          $("#fecha_fin").val(fecha_fin);
            //var lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);
          $("#fecha_inicio").datepicker({
                dateFormat: 'dd-mm-yy' ,                
                firstDay: 1
          });

          $("#fecha_fin").datepicker({
                dateFormat: 'dd-mm-yy',                
                firstDay: 1
          });          

   //Imprimir Boleto    
   jQuery(document).ready(function($){
        $('#exportarExcel').click(function() {
            var cliente = $('#cliente_id').val();           
            var fecha_inicio = $('#fecha_inicio').val();
            var fecha_fin = $('#fecha_fin').val();
            var documento = $('#documento').val();
            var vendedor  = $("#vendedor option:selected").val();
            var proceso_estado =  $("#proceso_estado option:selected").val();

            if(cliente  ==''){
                cliente =0;
            }
            if(fecha ==''){
                fecha = 0;
            }
            if(documento ==''){
                documento = 0;
            }            
            if(vendedor ==''){
                vendedor = 0;
            }            
            if(proceso_estado ==''){
                proceso_estado = 0;
            }            
            var url ='<?PHP echo base_url() ?>index.php/proformas/ExportarExcel/'+cliente+'/'+fecha_inicio+'/'+fecha_fin+'/'+documento+'/'+vendedor+'/'+proceso_estado;
            window.open(url, '_blank');
        });
    });

    jQuery(document).ready(function($){
        $('#exportarExcel_rd').click(function() {
            var cliente = $('#cliente_id').val();           
            var fecha_inicio = $('#fecha_inicio').val();
            var fecha_fin = $('#fecha_fin').val();
            var documento = $('#documento').val();
            var vendedor  = $("#vendedor option:selected").val();
            var proceso_estado =  $("#proceso_estado option:selected").val();

            if(cliente  ==''){
                cliente =0;
            }
            if(fecha ==''){
                fecha = 0;
            }
            if(documento ==''){
                documento = 0;
            }            
            if(vendedor ==''){
                vendedor = 0;
            }            
            if(proceso_estado ==''){
                proceso_estado = 0;
            }            
            var url ='<?PHP echo base_url() ?>index.php/proformas/exportarExcel_rd/'+cliente+'/'+fecha_inicio+'/'+fecha_fin+'/'+documento+'/'+vendedor+'/'+proceso_estado;
            window.open(url, '_blank');
        });
    });



    /*button buscar*/
    $("#btn_search").click(function(e){
        e.preventDefault();
        dataSource.read();
    });
    /*button limpiar*/
    $("#btn_limpiar").click(function(e){
        e.preventDefault();
        $("#cliente_id").val("");
        $("#proveedor").val("");
        $("#vendedor").val("");
        $("#serie_numero").val("");
        $("#fecha").val("");
        $("#documento").val("");
        $("#proceso_estado").val("");
        dataSource.read();
    });    


    // AUTOCOMPLETE CLIENTE
    $(document).on('ready',function() {
        $("#cliente").autocomplete( {
            source: '<?PHP echo base_url(); ?>index.php/proformas/buscadorCliente',
            minLength: 2,
            select: function(event, ui) {
            	console.log(ui.id);
                var data_cliente ='<input type="hidden" value="' + ui.item.id + '" name = "cliente_id" id = "cliente_id" >';
                $("#cliente").val(ui.item.razon_social);
                $('#data_cliente').html(data_cliente);
            }
        });

    // FECHA JAVASCRIPT
    $("#fecha_inicio").datepicker();
    $("#fecha_fin").datepicker();
                     
    });  

    var dataSource = new kendo.data.DataSource({
             transport: {
                read: {
                    url:"<?php echo base_url()?>index.php/proformas/getMainList/",
                    dataType:"json",
                    method:'post',
                    data:function(){
                        return {
                            cliente:function(){
                                return $("#cliente_id").val();
                            },
                            serie_numero:function(){
                                return $("#serie_numero").val();
                            },
                            fecha_inicio:function(){
                                return $("#fecha_inicio").val();
                            },
                            fecha_fin:function(){
                                return $("#fecha_fin").val();
                            },
                            documento:function(){
                            	return $("#documento").val();
                            },
                            vendedor:function(){
                                return $("#vendedor").val();
                            },
                            estado:function(){
                                return $("#proceso_estado").val();
                            }
                        }
                    }
                }
            },
            schema:{
                data:'data',
                total:'rows'
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
        columns: [
                    {field:'prof_correlativo',title:'Nº COMPRA',width:'60px'},
                    {hidden:'totalPendientes',title:'Nº PEDIDO',width:'60px',template:"#= totalPendientes #"},
                    {hidden:'totalAceptado',title:'Nº PEDIDO',width:'60px',template:"#= totalAceptado #"},
                    {hidden:'totalAnulado',title:'Nº PEDIDO',width:'60px',template:"#= totalAnulado #"},
                    {field:'razon_social',title:'CLIENTE',width:'160px'},   
                    {field:'ruc',title:'RUC/DNI',width:'70px'},
                    {field:'prof_doc_fecha',title:'FECHA',width:'80px'},
                    {field:'nombre',title:'USUARIO',width:'80px'},
                    {field:'moneda',title:'MONEDA',width:'60px'},
                    {field:'prof_doc_subtotal',title:'SUB TOTAL',width:'60px'},                          
                    {field:'prof_doc_igv',title:'IGV',width:'60px'},
                    {field:'prof_doc_total',title:'TOTAL',width:'60px'},
                    {field:'proceso_estado',title:'ESTADO',width:'60px'},
                    {field:'boton_editar', title:'&nbsp;',width:'40px',template:"#= boton_editar #"},
                    {field:'boton_eliminar', title:'&nbsp;',width:'40px',template:"#= boton_eliminar #"},
                    {field:'btn_ticket',title:'TICKET',width:'60px',template:"#= btn_ticket #"},                    
                    {field:'boton_pdf', title:'A4',width:'40px',template:"#= boton_pdf #"},
                    {field:'btn_popup',title:'ENVIAR',width:'40px',template:"#= btn_popup #"}                    
        ],
        detailTemplate: '<div class="lista_proformas"></div>',
        detailInit: detailInit,        
        dataBound:function(e){
             
            var pendientes = 0;
            var aceptados = 0;
            var anulados = 0;
            var data = dataSource.data();
            $.each(data,function(e, row){
               
                if(row.prof_procesoestado_id == 3)
                {
                    $('tr[data-uid="' + row.uid + '"] ').css("background-color", "rgb(241, 204, 206)");                     
                }
            });

           

             //capturar el evento para crear pdf  otra pestaña
                 $(".show_pdf").click(function(e) {               
                var idProforma = $(this).data("id");
             javascript:window.open("<?PHP echo base_url()?>index.php/proformas/descargarPdf/"+idProforma,'','width=750,height=600,scrollbars=yes,resizable=yes');
                
            });

            //capturar el evento para crear pdf
                 $(".show_pdf_ticket").click(function(e) {               
                var idProforma = $(this).data("id");
             javascript:window.open("<?PHP echo base_url()?>index.php/proformas/descargarPdf_ticket/"+idProforma,'','width=750,height=600,scrollbars=yes,resizable=yes');
                
            }); 

            var totalRecords = dataSource.total();
            $('#totalRows').html('');
            //TOTAL PENDIENTES
            //var totalPendientes = dataSource.total();
            $(".btn-pendientes").click(function(e){
                var pendientes = $(this).data('id');
            $("#total_pendientes").html('');
            $("#total_pendientes").html('<p  style="text-align:center;font-size:18px; background:#3393FF; color: white; "><b>TOTAL PENDIENTES: '+pendientes+'</b></p>');
            });
            $('.btn-pendientes').trigger('click');
            //TOTAL ACEPTADOS
            //var totalPendientes = dataSource.total();
            $(".btn-aceptados").click(function(e){
                var aceptados = $(this).data('id');
            $("#total_aceptados").html('');
            $("#total_aceptados").html('<p  style="text-align:center;font-size:18px; background:#4CAF50; color: white; "><b>TOTAL ACEPTADOS: '+aceptados+'</b></p>');
            });
            $(".btn-aceptados").trigger('click');
            //TOTAL ANULADOS
            //var totalPendientes = dataSource.total();
            $(".btn-anulados").click(function(e){
                var anulados = $(this).data('id');
            $("#total_anulados").html('');
            $("#total_anulados").html('<p  style="text-align:center;font-size:18px; background:#FF3F33; color: white; "><b>TOTAL ANULADOS: '+anulados+'</b></p>');
            });
            $(".btn-anulados").trigger('click');
            //TOTAL DE PROFORMAS
            var totalRecords = dataSource.total();
            $("#totalRows").html('');
            $("#totalRows").html('<p style="text-align:center;font-size:16px;background:#343333;color: white"><b>TOTAL COMPROBANTES: '+totalRecords+'</b></p>');
            // forzamos el click al boton del modal
            // llamar al popup para enviar proforma
            if($("#proforma_id").val() != ''){
                    $('#btnproforma').trigger('click');
            }

            //modificar compra
            $(".btn-editar").click(function(e){
               var idProforma = $(this).data('id');
               location.href="<?php echo base_url()?>index.php/proformas/editar/"+idProforma;
            });
            //eliminar compra
            $(".btn-eliminar").click(function(e){
                var idProforma = $(this).data('id');
                var msg = $(this).data('msg');
                var url = '<?php echo base_url()?>index.php/proformas/eliminar/'+idProforma
                $.confirm({
                    title: 'Confirmar',
                    content: msg,
                    buttons: {
                        confirm:{
                            text:'aceptar',
                            btnClass: 'btn-blue',
                            action:function(){
                                $.ajax({
                                    url:url,
                                    dataType:'json',
                                    method:'get',
                                    success:function(response){
                                        if(response.status == STATUS_OK)
                                        {
                                            toast('success', 1500, 'proforma eliminada');
                                            dataSource.read();
                                        }
                                        if(response.status == STATUS_FAIL)
                                        {
                                            toast('error', 1500 ,'No se puedo eliminar proforma.');
                                        }
                                    }
                                });

                            }
                        },
                        cancel: function () {
                            
                        }
                    }
                });                
            });                            
        }
    }); 

    function detailInit(e) {
        var detailRow = e.detailRow;

        detailRow.find(".lista_proformas").kendoGrid({
            dataSource: {
                type: "json",
                transport: {
                    read:{
                        url:"<?php echo base_url()?>index.php/proformas/getMainListDetail/",
                        dataType:"json",
                        method:'post',
                        data:function(){
                            return {
                                prof_id:e.data.prof_id
                            }
                        }
                    }
                },
                schema:{
                    data:'data',
                    total:'rows'
                },                
                serverPaging: true,
                serverSorting: true,
                serverFiltering: true,
                pageSize: 7,
            },
            scrollable: false,
            sortable: true,
            pageable: true,
            columns: [
                { field: "profd_descripcion", title:"PRODUCTO", width: "120px" },
                { field: "profd_precio_unitario", title:"PRECIO UNITARIO", width: "50px" },
                { field: "profd_cantidad", title:"CANTIDAD",width:"70px" },
                { field: "profd_subtotal", title:"SUB TOTAL",width:"70px" }
            ],
            dataBound:function(e){
            }
        });
    }      

$(document).on('click',"#btnproforma",function(){

        var proforma_id =  $("#proforma_id").val();
        $("#myModal").load('<?= base_url()?>index.php/proformas/modalEnvioProforma/'+proforma_id,{}); 

    });


</script>

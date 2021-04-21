<h2 align="center"><strong>Rubro</strong></h2>
<br>
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <button id="btn_nuevo_tcRubro" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal">Nueva Rubro</button>
        </div>
        <div class="col-md-4 col-md-offset-4">
            <div class="form">
                <div class="input-group">
                  <input type="text" class="form-control" id="search" placeholder="Buscar por nombre">
                  <span class="input-group-btn">
                    <button class="btn btn-default" type="button" id="btn_buscar_tcRubro"><span class="glyphicon glyphicon-search"></span></button>
                  </span>
                </div>            
            </div>            
        </div>        
    </div>
    <br>
    <div id="grid"></div>
</div>

<script>
    var dataSource = new kendo.data.DataSource({
             transport: {
                read: {
                    url:"<?php echo base_url()?>index.php/tipo_cliente_rubros/getMainList/",
                    dataType:"json",
                    method:'post',
                    data:function(){
                        return {
                            search:function(){
                                return $("#search").val();
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
                    {field:'tcr_nombre',title:'NOMBRE',width:'150px'},
                    {field:'tcr_precio_text',title:'PRECIO',width:'150px'},
                    {field:'tcr_editar', title:'&nbsp;',width:'60px',template:"#= tcr_editar #"},
                    {field:'tcr_eliminar', title:'&nbsp;',width:'60px',template:"#= tcr_eliminar #"},
        ],
        dataBound:function(e){
            //modificar producto
            $(".btn_modificar_tcRubro").click(function(e){
               var id_tcRubro = $(this).data('id');               
                $("#myModal").load('<?php echo base_url()?>index.php/tipo_cliente_rubros/editar/'+id_tcRubro,{});
            });

            //editar producto
            $(".btn_eliminar_tcRubro").click(function(e){
                e.preventDefault();
                var id_tcRubro = $(this).data('id');
                var msg = $(this).data('msg');
                var url = '<?php echo base_url()?>index.php/tipo_cliente_rubros/eliminar/'+id_tcRubro
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
                                            toast('success', 1500, 'rubro eliminado');
                                            dataSource.read();
                                        }
                                        if(response.status == STATUS_FAIL)
                                        {
                                            toast('error', 2000 ,'No se puedo eliminar la rubro porque tiene rubros agregados.');
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
    //nuevo seccion
    $("#btn_nuevo_tcRubro").click(function(e){
        e.preventDefault();
        $("#myModal").load('<?php echo base_url()?>index.php/tipo_cliente_rubros/crear',{});
    }); 
    //buscar seccion
    $("#btn_buscar_tcRubro").click(function(e){
        e.preventDefault();
        dataSource.read();
    });

    //buscar seccion por campo texto
    $("#search").keyup(function(e){
        e.preventDefault();
        var enter = 13;
        if(e.which == enter)
        {
            dataSource.read();
        };
    })
</script>
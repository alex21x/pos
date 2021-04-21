<?PHP //var_dump($cliente);exit;?>

<script type="text/javascript">
    $(function() {
        $("#fecha_nacimiento").datepicker();
    });
          
        
    $( document ).ready(function() {        
                       
        $("#tipo_cliente").change(function () {
            var op = $("#tipo_cliente option:selected").val();
            var array = op.split('xx-xx-xx');

            if (array[0] == 1) {
                $("#lbl_DNI_RUC").text('DNI');
                $("#ruc").attr("placeholder","DNI");
                $("#ruc").attr("maxlength","8");

                $("#lbl_RAZ_APE").text('Apellidos');
                $("#razon_social").attr("placeholder","Apellidos");
                $("#nombres").show();
                $("#razon_social_sunat").hide();
            }

            if (array[0] == 2) {
                $("#lbl_DNI_RUC").text('RUC');
                $("#ruc").attr("placeholder","RUC");
                $("#ruc").attr("maxlength","11");
                
                $("#lbl_RAZ_APE").text('Razon Social');
                $("#razon_social").attr("placeholder","razon_social");
                $("#nombres").hide();
                $("#razon_social_sunat").show();
            }
        });        
    });    
</script> 
<style type="text/css">
    #images_gallery img{
        margin-top: 10px;        
        margin-right: 100px;
        border: 1px solid #ccc;
        width: 150px;
        height: 160px;
    }     
</style> 
<br>
<div class="container">
    <!-- Example row of columns -->

    <div class="row">                
        <div class="col-md-3">
    </div>
        <div class="col-md-6">
            <a href="<?PHP echo base_url()?>index.php/clientes/index" class="btn btn-success btn-xs" role="button">&nbsp;&nbsp;Atras&nbsp;&nbsp;</a>
            <div align="center"><h2>Modificar Cliente</h2></div>
            <form class="form-horizontal" enctype="multipart/form-data" action="<?PHP echo base_url() ?>index.php/clientes/modificar_g" method="POST">                                
                <div class="form-group">
                     <div id="images_gallery">
                        <div class='col-md-12' align='right'>
                          <a class='example-image-link' href='"+objeto_url+"' data-lightbox='example-1'>
                            <img src="<?= base_url().'images/clientes/'.$cliente['foto'];?>">
                          </a>
                        </div>
                      </div>
                </div><br>
                <div class="form-group">
                    <label for="tipo_cliente" class="col-xs-5 col-md-5 col-lg-5 control-label text-right ">Tipo Cliente</label>                                                                                                  
                    <div class="col-xs-4">
                        <select class="form-control" name="tipo_cliente" id="tipo_cliente" required="">
                            <option value="0">Seleccionar</option>
                            <?PHP foreach ($tipo_clientes as $value_tipo_clientes){
                                $selected = ($value_tipo_clientes['id'] == $cliente['tipo_cliente_id']) ? "SELECTED" : '';?>                            
                            <option <?PHP echo $selected ;?> value="<?PHP echo $value_tipo_clientes['id'].'xx-xx-xx'.$value_tipo_clientes['tipo_cliente']?>"><?PHP echo $value_tipo_clientes['tipo_cliente']?></option>                            
                            <?PHP }?>                            
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <?PHP if($cliente['tipo_cliente_id']=='1'){?>
                    <label id="lbl_DNI_RUC" for="ruc" class="col-xs-5 col-md-5 col-lg-5 control-label text-right">DNI :</label>
                    <div class="col-xs-6">    
                        <input type="text" class="form-control" name="ruc" id="ruc" maxLength="8" value="<?PHP echo $cliente['ruc']?>" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                    </div>                    
                    <?PHP } else {?>
                    <label id="lbl_DNI_RUC" for="ruc" class="col-sm-5 control-label">RUC :</label>
                    <div class="col-xs-6">    
                        <input type="text" class="form-control" name="ruc" id="ruc" maxLength="11" value="<?PHP echo $cliente['ruc']?>" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);">
                    </div>
                    <?PHP }?>
                    <div class="col-xs-1">
                            <a href="#"><span class="glyphicon glyphicon-search searchCustomer"></span></a>
                    </div>
                    
                </div>
                <div class="form-group">
                    <?PHP if($cliente['tipo_cliente_id']=='1'){?>
                    <label id="lbl_RAZ_APE" for="razon_social" class="col-xs-5 col-md-5 col-lg-5 control-label text-right">Nombres: </label>
                    <?PHP } else {?>
                    <label id="lbl_RAZ_APE" for="razon_social" class="col-xs-5 col-md-5 col-lg-5 control-label text-right">Razón Social: </label>
                    <?PHP }?>
                    <div class="col-xs-7">
                        <input type="text" class="form-control" name="razon_social" id="razon_social" value="<?PHP echo $cliente['razon_social']?>">
                    </div>
                </div>                               
                <div class="form-group">
                    <label for="domicilio1" class="col-xs-5 col-md-5 col-lg-5 control-label text-right ">Domicilio1:</label>
                    <div class="col-xs-7">
                        <input type="text" class="form-control" name="domicilio1" id="domicilio1" value="<?PHP echo $cliente['domicilio1']?>">
                    </div>
                </div>
                 <div class="form-group">
                    <label for="domicilio2" class="col-xs-5 col-md-5 col-lg-5 control-label text-right ">Domicilio2:</label>
                    <div class="col-xs-7">
                        <input type="text" class="form-control" name="domicilio2" id="domicilio2" value="<?PHP echo $cliente['domicilio2']?>">
                    </div>
                </div>                
                <div class="form-group">
                    <label for="email" class="col-xs-5 col-md-5 col-lg-5 control-label text-right">Email:</label>
                    <div class="col-xs-7">
                        <input type="text" class="form-control" name="email" id="email" value="<?PHP echo $cliente['email']?>">
                    </div>
                </div>
               <div class="form-group">
                    <label for="email2" class="col-xs-5 col-md-5 col-lg-5 control-label text-right">Email2:</label>
                    <div class="col-xs-7">
                        <input type="text" class="form-control" name="email2" id="email2" value="<?PHP echo $cliente['email2']?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="email3" class="col-xs-5 col-md-5 col-lg-5 control-label text-right">Email3:</label>
                    <div class="col-xs-7">
                        <input type="text" class="form-control" name="email3" id="email3" value="<?PHP echo $cliente['email3']?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="pagina_web" class="col-xs-5 col-md-5 col-lg-5 control-label text-right">Página web:</label>
                    <div class="col-xs-7">
                        <input type="text" class="form-control" name="pagina_web" id="pagina_web" value="<?PHP echo $cliente['pagina_web']?>">
                    </div>
                </div>
                <div class="form-group">
                    <label for="telefono_fijo_1" class="col-xs-5 col-md-5 col-lg-5 control-label text-right">Telefono fijo 1:</label>
                    <div class="col-xs-7">
                        <input type="number" class="form-control" name="telefono_fijo_1" id="telefono_fijo_1" value="<?PHP echo $cliente['telefono_fijo_1']?>" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="7">
                    </div>
                </div>              
                <div class="form-group">
                    <label for="telefono_movil_1" class="col-xs-5 col-md-5 col-lg-5 control-label text-right">Telefono movil 1:</label>
                    <div class="col-xs-7">
                        <input type="number" class="form-control" name="telefono_movil_1" id="telefono_movil_1" value="<?PHP echo $cliente['telefono_movil_1']?>" oninput="if(this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="9">
                    </div> 

                </div>

                    <div class="form-group">
                        <label  for="placa" class="col-xs-5 col-md-5 col-lg-5 control-label text-right">Placa :</label>
                        <div class="col-xs-7 col-md-7 col-lg-7">
                            <input type="text" class="form-control" name="Placa" id="Placa" placeholder="Ingrese placa" value="<?= $cliente['placa']?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label  for="descuento%" class="col-xs-5 col-md-5 col-lg-5 control-label text-right">Descuento%:</label>
                        <div class="col-xs-7 col-md-7 col-lg-7">
                            <input type="text" class="form-control" name="descuento" id="descuento" placeholder="Descuento%" value="<?= $cliente['descuento']?>">
                        </div>
                    </div>

                       <div class="form-group">
                        <label for="línea de crédito " class="col-xs-5 col-md-5 col-lg-5 control-label text-right">Línea De Crédito:</label>
                        <div class="col-xs-7 col-md-7 col-lg-7">
                            <input type="text" class="form-control" name="linea_de_credito" id="linea_de_credito" placeholder="Línea De Crédito" value="<?= $cliente['linea_de_credito']?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="rubro" class="col-xs-5 col-md-5 col-lg-5 control-label text-right">Rubro:</label>
                        <div class="col-xs-7 col-md-7 col-lg-7">                                                
                            <select class="form-control" name="rubro" id="rubro" required="">
                                <option>Seleccionar</option>
                                <?PHP foreach ($tipo_cliente_rubros as $value) { 
                                    $SELECTED = ($value->tcr_id == $cliente['tipo_cliente_rubro_id']) ? 'SELECTED' : '';?>
                                    <option value="<?PHP echo $value->tcr_id; ?>" <?= $SELECTED?>><?PHP echo $value->tcr_nombre; ?></option>
                                <?PHP }?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="zona " class="col-xs-5 col-md-5 col-lg-5 control-label text-right">Zona:</label>
                        <div class="col-xs-7 col-md-7 col-lg-7">                                                
                            <select class="form-control" name="zona" id="zona" required="">
                                <option>Seleccionar</option>
                                <?PHP foreach ($zonas as $value) { 
                                    $SELECTED = ($value->zon_id == $cliente['zona_id']) ? 'SELECTED' : '';?>
                                    <option value="<?PHP echo $value->zon_id; ?>" <?= $SELECTED?>><?PHP echo $value->zon_nombre;?></option>
                                <?PHP }?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="puntos " class="col-xs-5 col-md-5 col-lg-5 control-label text-right">Ubicación Maps:</label>
                        <div class="col-xs-6 col-md-6 col-lg-6">
                            <input type="text" class="form-control" name="maps" id="maps" placeholder="Ubicación Maps"  value="<?= $cliente['maps']?>">
                        </div>
                        <div class="col-xs-1">
                            <a href="https://www.google.com.pe/maps/@-12.0630149,-77.0296179,13z?hl=es-419" target="_blank" class="btn btn-primary btn-sm">MAPS</a>
                        </div>
                    </div>                                 
                    <div class="form-group">
                        <label for="puntos " class="col-xs-5 col-md-5 col-lg-5 control-label text-right">Puntos:</label>
                        <div class="col-xs-7 col-md-7 col-lg-7">
                            <input type="text" class="form-control" name="puntos" id="puntos" placeholder="Puntos" value="<?= $cliente['puntos']?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="bonus" class="col-xs-5 col-md-5 col-lg-5 control-label text-right">Bonus:</label>
                        <div class="col-xs-7 col-md-7 col-lg-7">
                            <input type="text" class="form-control" name="bonus" id="bonus" placeholder="Bonus" value="<?= $cliente['bonus']?>">
                        </div>
                    </div>
                        
                        <div class="form-group">
                        <label for="bonus" class="col-xs-5 col-md-5 col-lg-5 control-label text-right">Foto</label>
                        <div class="col-xs-7 col-md-7 col-lg-7">
                            <input type="file" class="form-control" name="foto" id="foto" placeholder="Foto">
                </div>                
                <div class="form-group">
                    <label for="empresa" class="col-xs-5 col-md-5 col-lg-5 control-label text-right" style="display:none;">Empresa:<?PHP echo $cliente['empresa_id'];?></label>
                    <div class="col-xs-4" style="display:none;">
                        <select class="form-control" name="empresa" id="empresa" required="">
                            <option value="">Seleccionar</option>
                            <?PHP foreach ($empresas as $value_empresa) { 
                                $selected = ($cliente['empresa_id'] == $value_empresa['id'])? 'SELECTED' : '';
                                ?>
                                <option <?PHP echo $selected; ?> value="<?PHP echo $value_empresa['id'] ?>"><?PHP echo $value_empresa['empresa']; ?></option>
                                <?PHP
                            }
                            ?>                                
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="activo" class="col-xs-5 col-md-5 col-lg-5 control-label text-right">Activo:</label>
                    <div class="col-xs-6 col-md-6 col-lg-6">
                        <select class="form-control" name="activo" id="activo">
                            <?PHP
                            $selected = '';
                            foreach ($activos as $value_activos) {
                                $selected = ($value_activos->activo == $cliente['activo']) ? "SELECTED" : '';?>
                                <option <?PHP echo $selected;?> value="<?PHP echo $value_activos->activo ?>"><?PHP echo $value_activos->activo;?></option>
                                <?PHP
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-6 col-sm-8">
                        <input type="hidden" name="id" id="email" value="<?PHP echo $cliente['id'];?>">
                        <button type="submit" class="btn btn-primary">Modificar</button>
                    </div>
                </div>
            </form>

        </div>
        <div class="col-md-3">
        </div>
    </div>
</div>

<script type="text/javascript">  
$(document).ready(function(){

    /* DETALLE DE CAMBIO         / AUTOR               / FECHA
    *-----------------------------------------------------------   
    * CARGAR FOTO PACIENTE      / ALEXADER FERNANDEZ   / 10-04-202 */
    $('#foto').change(function(){
        /* Limpiar vista previa */
           $("#images_gallery").html('');
           var archivos = document.getElementById('foto').files;
           var navegador = window.URL || window.webkitURL;
           /* Recorrer los archivos */
           for(x=0; x<archivos.length; x++)
           {
               /* Validar tamaño y tipo de archivo */
               var size = archivos[x].size;
               var type = archivos[x].type;
               var name = archivos[x].name;
               if (size > 1024*1024)
               {
                   $("#images_gallery").append("<p style='color: red'>El archivo "+name+" supera el máximo permitido 1MB</p>");
               }
               else if(type != 'image/jpeg' && type != 'image/jpg' && type != 'image/png' && type != 'image/gif')
               {
                   $("#images_gallery").append("<p style='color: red'>El archivo "+name+" no es del tipo de imagen permitida.</p>");
               }
               else
               {
                 var objeto_url = navegador.createObjectURL(archivos[x]);                 
                 $("#images_gallery").append("<div class='col-md-12' align='right'><a class='example-image-link' href='"+objeto_url+"' data-lightbox='example-1'><img src="+objeto_url+"></a></div>");
               }
           }
    });


    $(".searchCustomer").on("click",function(){
        consulta_sunat();
    })

    function consulta_sunat(){
        var num = $("#ruc").val();

        if(num!=''){
        if(num.length == 8){//DNI
            $.getJSON('https://mundosoftperu.com/reniec/consulta_reniec.php',{dni:num})
             .done(function(json){                
                if(json[0].length!=undefined){
                    var dni = json[0];
                    var nombres = json[2]+' '+json[3]+' '+json[1];                    
                    $("#razon_social").val(nombres);
                    $("#domicilio1").val('LIMA');
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
                    $("#razon_social").val(json.result.RazonSocial);
                    $("#domicilio1").val(json.result.Direccion);                    
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

});        
</script>
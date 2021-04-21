<style type="text/css"> 

.container2 span{
    width:25%;
    display: inline-block;
    padding: 10px;
    border-radius: 10px;
    background: white;
    border: 2px solid black;
    margin-left: 100px;
    font-size: 18px;
    font-family: serif;
    color: green;
    font-weight: bold;
}

.container3 span{
    width:30%;
    display: inline-block;
    padding: 10px;
    border-radius: 10px;
    background: white;
    border: 2px solid black;
    margin-left: 100px;
    font-size: 18px;
    font-family: serif;
    color: #0229B6;
    font-weight: bold;
}

@media (max-width:500px) {
    .container2 span{
        width: 50%;
        margin-right: 100px;
}
    .container3 span{
        width: 70%;
        margin-right: 20px;
        margin-left: 30px;
}}
</style>
<script type="text/javascript">
            function getCookie(cname) {
                var name = cname + "=";
                var ca = document.cookie.split(';');
                for(var i=0; i<ca.length; i++) {
                    var c = ca[i];
                    while (c.charAt(0)==' ') c = c.substring(1);
                    if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
                }
                return "";
            }
            
            var x = document.cookie;
            var y = getCookie('cookie');
        </script>
<h1 align="center"></h1>
<br>
<p class="bg-warning" align="center">
<?PHP echo $this->session->flashdata('mensaje');?>
</p>

<?PHP 


if(isset($redireccion)){
echo $redireccion;
}
?>
<div class="container">
    <div class="row"> 

      <div class="col-md-1">

        </div>
    <div class="col-md-11" style="text-align: center;">
         <?php                                                                                 
                                        $empresa = $this->db->select('id,empresa,foto')->from('empresas')->where('id',1)->get()->row();
                                        echo "<img  src='".base_url()."images/sistemasunat.jpg' width='60%'>";
                                     ?> 
    </div>      
        <div class="col-md-4" >
        </div>
        <div class="col-md-5" >            
            <form class="form-signin" role="form" method="post" action="<?PHP echo base_url(); ?>index.php/acceso/login">
                <h2 class="form-signin-heading" style="text-align: center;"> Iniciar Sesión </h2>                
                    <input class="form-control" type="password" autofocus="" required="" placeholder="Contraseña" name="usuario" id="usuario" value="<?PHP if(isset($dni)) echo $dni;?>">               
                <br>           
              <select id="almacen" class="form-control input-sm" name="almacen" requerid>
              
                <?php foreach($almacenes as $almacen):?>
                  <option value="<?php echo $almacen->alm_id?>" <?php if($compra->comp_almacen_id==$almacen->alm_id):?> selected <?php endif?> ><?php echo $almacen->alm_nombre?></option>
                <?php endforeach?>
              </select>
                <div class="checkbox">
                    <label>
                        <!--<input type="checkbox" checked="" name="recordar" value="recordar">Recordarme-->
                    </label>
                </div>        
                <input type="submit" class="btn btn-lg btn-primary btn-block" value="Ingresar" style="border:0;"/>
            </form>
        </div>
    
    <div class="col-md-3" >
    </div>
    </div>    
    <div class="row text-center container2"><br><br>
        <span class="label label-default" ><?= MODO;?></span>
    </div>   
    <div class="row text-center container3"><br><br>
        <span class="label label-default buscar_comprobante">BUSCAR COMPROBANTE</span>
    </div>   
</div>

<script type="text/javascript">    
    $(".buscar_comprobante").on("click",function(){        
        setTimeout(function() {
              var a = document.createElement('a');
              a.href="<?= base_url()?>index.php/sunnat/consultaComprobantes";
              a.target = '_blank';
              document.body.appendChild(a);
              a.click();
              }, 50);
    })
</script>
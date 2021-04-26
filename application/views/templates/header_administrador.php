<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/TR/REC-html40" lang="en">
    <head>
        <title>IFA-SOFT®</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">      
        <link rel="shortcut icon" type="image/x-icon" href="<?PHP echo base_url();?>images/siti01.ico" />
       

        <link rel="stylesheet" type="text/css" href="<?PHP echo base_url();?>assets/plugins/lightbox2/dist/css/lightbox.min.css">
        <script src="<?PHP echo base_url(); ?>assets/plugins/lightbox2/dist/js/lightbox-plus-jquery.min.js"></script>
        <link rel="stylesheet" href="<?PHP echo base_url();?>assets/css/kendo.common-material.min.css">                
        <link rel="stylesheet" href="<?PHP echo base_url();?>assets/css/kendo.material.min.css">          
        <link rel="stylesheet" href="<?PHP echo base_url();?>assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?PHP echo base_url()?>assets/plugins/chosen/chosen.css">
        <link rel="stylesheet" href="<?PHP echo base_url();?>assets/css/themes-smoothness-jquery-ui.css">         
        <link rel="stylesheet" href="<?PHP echo base_url();?>assets/css/jquery.toast.min.css">         
        <link rel="stylesheet" href="<?PHP echo base_url();?>assets/css/jquery-confirm.min.css">         
        <link rel="stylesheet" href="<?PHP echo base_url();?>assets/css/style_hector.css">  
        <link rel="stylesheet" href="<?PHP echo base_url();?>assets/css/pos.css">
         <!-- custom css -->
        <link rel="stylesheet" href="<?PHP echo base_url();?>assets/css/custom.css">
        <link rel="stylesheet" href="<?PHP echo base_url();?>assets/css/jquery.dataTables.min.css">   
        
     
                        
        <script src="<?PHP echo base_url(); ?>assets/js/jquery-1.11.1.min.js"></script> 
        <script src="<?PHP echo base_url()?>assets/plugins/chosen/chosen.jquery.js"></script>
        <script src="<?PHP echo base_url(); ?>assets/js/jquery-ui-1.11.0.js"></script>        
        <script src="<?PHP echo base_url(); ?>assets/js/jquery.toast.min.js"></script>        
        <script src="<?PHP echo base_url(); ?>assets/js/jquery-confirm.min.js"></script>        
        <script src="<?PHP echo base_url(); ?>assets/js/function_dashboard.js"></script>
        <script src="<?PHP echo base_url(); ?>assets/js/chart.min.js"></script>
        <script src="<?PHP echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>                
        <script src="<?PHP echo base_url(); ?>assets/js/kendo.all.min.js"></script>    
        <script src="https://cdn.jsdelivr.net/gh/jquery-form/form@4.2.2/dist/jquery.form.min.js" integrity="sha384-FzT3vTVGXqf7wRfy8k4BiyzvbNfeYjK+frTVqZeNDFl8woCbF0CYG6g2fMEFFo/i" crossorigin="anonymous"></script>
        <script src="<?PHP echo base_url(); ?>assets/js/paciente.js"></script>
        <script src="<?PHP echo base_url(); ?>assets/js/cliente.js"></script>

        <style type="text/css" >

        input[type=number]::-webkit-inner-spin-button, 
        input[type=number]::-webkit-outer-spin-button { 
          -webkit-appearance: none; 
          margin: 0; 
        }
        input[type=number] { -moz-appearance:textfield; }   

/*
    DEMO STYLE
*/

@import "https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;1,900&display=swap";
body {
    font-family: 'Poppins', sans-serif;
    background: #fafafa;
}

p {
    font-family: 'Poppins', sans-serif;
    font-size: 20px;
    font-weight: 300;
    line-height: 1.7em;
    color: #999;
}

a,
a:hover,
a:focus {
    color: inherit;
    text-decoration: none;
    transition: all 0.3s;
}

.navbar {
    padding: 15px 10px;
    background: #fff;
    border: none;
    border-radius: 0;
    margin-bottom: 40px;
    box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.1);
}

.navbar-btn {
    box-shadow: none;
    outline: none !important;
    border: none;
}

.line {
    width: 100%;
    height: 1px;
    border-bottom: 1px dashed #ddd;
    margin: 40px 0;
}



/* ---------------------------------------------------
    CONTENT STYLE
----------------------------------------------------- */

#contenedor {
    width: 100%;
    padding: 20px;
    min-height: 100vh;
    transition: all 0.3s;
}

/* ---------------------------------------------------
    MEDIAQUERIES
----------------------------------------------------- */

@media (max-width: 768px) {
    #sidebar {
        margin-left: -250px;
    }
    #sidebar.active {
        margin-left: 0;
    }
    #sidebarCollapse span {
        display: none;
    }
}
        /* ---------------------------------------------------
    SIDEBAR STYLE
----------------------------------------------------- */

.wrapper {
    display: flex;
    width: 100%;
    align-items: stretch;
    font-family: ""OpenSansRegular",Arial,Helvetica,sans-serif !important";
    font-size: 13px;
    font-weight: 300;
    line-height: 1.1em;    
}

#sidebar {
    font-family: ""OpenSansRegular",Arial,Helvetica,sans-serif !important";
    min-width: 250px;
    max-width: 250px;
    background: #02223A;
    color: #b8c7ce;
    transition: all 0.3s;
    border-bottom: 1px solid #D6DBDF;
    border-left: 1px solid #D6DBDF;
    border-right:  1px solid #D6DBDF;
}

#sidebar.active {
    margin-left: -250px;
}

#sidebar .sidebar-header {
    padding: 20px;
    background: #6d7fcc;
}

#sidebar ul.components {
    padding: 20px 0;
    border-bottom: 1px solid #47748b;
}

#sidebar ul p {
    color: #fff;
    padding: 10px;
}

#sidebar ul li a {
    padding: 10px;
    font-size: 1.1em;
    display: block;
}

#sidebar ul li a:hover {
    /*color: #1ed760;*/
    color: #FFF;
    background: #0789c9;
}

#sidebar ul li.active>a,
a[aria-expanded="true"] {
    color: #FBA707;
    background: #fff;
}

a[data-toggle="collapse"] {
    position: relative;
}

.dropdown-toggle::after {
    display: block;
    position: absolute;
    top: 50%;
    right: 20px;
    transform: translateY(-50%);
}

ul ul a {
    font-size: 0.9em !important;
    padding-left: 30px !important;
    background: #222d32;
}

ul.CTAs {
    padding: 20px;
}

ul.CTAs a {
    text-align: center;
    font-size: 0.9em !important;
    display: block;
    border-radius: 5px;
    margin-bottom: 5px;
}

a.download {
    background: #fff;
    color: #7386D5;
}

a.article,
/*a.article:hover {
    background: #6d7fcc !important;
    color: #fff !important;
}*/
.dropdown-toggle::after {
    display: inline-block;
    width: 0;
    height: 0;
    margin-left: .255em;
    vertical-align: .255em;
    content: "";
    border-top: .3em solid;
    border-right: .3em solid transparent;
    border-bottom: 0;
    border-left: .3em solid transparent;
}


</style>                                                                                                    
    </head>
    <body>        
            <!-- Example row of columns -->
            <div class="wrapper">
                    <nav id="sidebar">
                            <!-- Brand and toggle get grouped for better mobile display -->
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">MENU
                                    <span class="sr-only"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>                                                                                
                                <ul class="list-unstyled components">                                  
                                     <li class="active"><a href="<?PHP echo base_url(); ?>index.php/acceso/inicio_administrador">
                                            <div class="img">
                                                <img src="<?= base_url();?>images/menus/inicio.png?>" height="61" width="61" style="margin:5px 25px;"/>
                                            </div><i class="glyphicon glyphicon-list-alt"></i> INICIO</a></li>                                  
                                    <?php $i = 0;foreach($_SESSION['modulos'] as $padre){?>
                                        <?php if(count($padre->modulos_hijos)>0):?>
                                            <li class="dropdown">
                                                <a href="#homeSubmenu_<?= $i?>" class="dropdown-toggle" data-toggle="collapse" aria-expanded="false"><div class="img"><img src="<?= base_url();?>images/menus/<?= $padre->mod_imagen?>" height="41" width="61" style="margin:5px 25px;"/></div><?= $padre->mod_descripcion?></a>
                                                <ul class="collapse list-unstyled" id="homeSubmenu_<?= $i?>">
                                                    <?php foreach($padre->modulos_hijos as $hijo):?>
                                                        <li>
                                                            <?php if($hijo->mod_sunat ==1):?>
                                                                <a href="<?php echo $hijo->mod_enlace?>" target="_blank"><span class="glyphicon glyphicon-plus"></span>&nbsp;<?php echo $hijo->mod_descripcion?></a>                                                                
                                                            <?php else: ?>
                                                                <a href="<?php echo base_url()?>index.php/<?php echo $hijo->mod_enlace?>" onclick="javascript:toggleSlideBox('book_renew_div');"><span class="glyphicon glyphicon-plus"></span>&nbsp;<?php echo $hijo->mod_descripcion?></a>                                                                
                                                            <?php endif ?>
                                                        </li>
                                                    <?php endforeach?>
                                                </ul>
                                            </li>
                                        <?php endif?>    
                                    <?php $i++;}                                        
                                    if($this->session->userdata('grande')==1){?>
                                    <li><a href="<?PHP echo base_url(); ?>index.php/acceso/menu_principal">Menu</a></li>
                                    <?PHP }                                    
                                          $empresa = $this->db->get('empresas')->row();
                                          if($empresa->save==1):
                                    ?>
                                        <li><a href="<?php echo IP.':'.PUERTO_FACTURADOR.'/#';?>" target="_blank" onclick="cargar_facturador()">Facturador SUNAT</a></li>
                                    <?php endif ?>   

                                    <li><a href="<?PHP echo base_url(); ?>index.php/acceso/logout"><div class="img"><img src="<?= base_url();?>images/menus/salir.png?>" height="40" width="51" style="margin:5px 25px;"/></div><i class="glyphicon glyphicon-list-alt"></i> CERRAR SESION</a></li>                              
                                </ul>
                                <ul class="nav navbar-nav navbar-right">
                                    <?php                                                                                 
                                        $empresa = $this->db->select('id,empresa,foto')->from('empresas')->where('id',1)->get()->row();
                                        echo "<img width='100px' src='".base_url()."images/".$empresa->foto."'>";                                    
                                    $nombre = (strpos($this->session->userdata('usuario'), ' ') != '')?substr($this->session->userdata('usuario'), 0,  strpos($this->session->userdata('usuario'), ' ')):$this->session->userdata('usuario');
                                    ?>
                                    <li><strong>Sesión :</strong>&nbsp;<?PHP echo $nombre; ?><?PHP echo "<br>".$this->session->userdata('almacen_nom'); ?>&nbsp;&nbsp;&nbsp;&nbsp;</li>
                                </ul>                     
                        <span class="label label-primary"><?= MODO;?></span>
                    </nav>
<div id="contenedor">
    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fas fa-align-left"></i>
                        <span>Toggle Sidebar</span>
    </button>
    <div id="book_renew_div">
    <div class="menu_header" style="margin:50px"><div class="close" onclick="javascript:toggleSlideBox('contenedor');" style="font-size: 50px">X</div></div>
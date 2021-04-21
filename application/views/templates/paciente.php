<html>

    <head>

        <style>

            html, body {

                margin: 10px 20px;

                padding: 0;

                font-family: sans-serif;

            }

            span #height-container { position: absolute; left: 0px; right: 0px; top: 0px; }

            .datos_titulo{

                width: 100%;                                    

            }

            .cabecera{

                text-align: center;

                font-size: 9px;

            }    

            .datos_titulo1{

                font-size: 14px;                

                font-weight: bold;

                background-color: #4169E1;   

                padding: 1px; 

                color: #FFF;            

                text-align: left;

                line-height: 1.1em;                

            }    

            img.historia{        

                width: 70px;

                height: 70px;   

                margin-left: 15px;              

            }           

            .tabla_cabecera{

                font-size: 10px;  

                text-align: center;              

            }

            .tabla_datos{

                font-size: 10px;

                text-align: center;

            }

            .tabla_datos_cantidad{

                font-size: 10px;

                text-align: center;

            }

            .datos_totales{

                font-size: 10px;                                

            }

            .datos_totales_bold{

                font-size: 10px;

                font-weight: bold;                  

            }

            .datos_cabecera{

                font-size: 8.3px;                

                text-align: center;       

                line-height: 1em;         

            }            

            .datos_cabecera_bold{

                font-weight: bold;

            }

            .datos_cliente{

                width: 100%;

                text-align: left;   

                margin-left: 4px;             

                font-size: 10.5px;                

                line-height: 1.8em; 

                border: 1;            

            }



            .datos_imagen{

                width: 100%;

                text-align: center;   

                margin-left: 4px;                            

                border: 1;            

            }

            .datos_firma{

                width: 100%;

                text-align: right;                   

            }



            .imagenHistoria{

                margin-top: 100px;

                width: 600px; 

                height: 800px;

            }

            .imagenFirma{

                margin-top: 10px;

                width: 150px; 

                height: 150px;

            }        

            h2{

                text-align: center;

                margin-left: 100px;

            }            

            h6{

                text-align: right;

            }            



        </style>

        <title>Historia</title>

    </head>

    <body><br><br>

<?php 

    $ruta_foto = base_url()."images/".$empresa->foto;

 ?>



        <table class="cabecera">

            <tr>

                <td><img src="<?php echo "images/".$empresa->foto;?>" height="100"  width="20%" style="text-align:center;" border="0"></td>            

                <td>

                <?php echo $empresa->ruc;?><br>            

                <?php echo $empresa->empresa;?><br>

                <?php echo $empresa->domicilio_fiscal;?><br>            

                <?php echo $empresa->telefono_movil;?>

                </td>

            </tr>            


        </table>        
        <table align="center">
            <tr >
                <td><img src="<?php echo "images/pacientes/".$paciente->foto;?>" height="100" width="25%" border="0"></td>
            </tr>
            <br>            

        </table>                  

            <table class="datos_cliente">

                <tr class="datos_titulo1">

                    <td colspan="4">DATOS PACIENTE </td>

                </tr>

                <tr>

                    <td class="datos_totales_bold">N° DE PACIENTE:</td>

                    <td><?php echo $paciente->id?> </td>

                    <td class="datos_totales_bold">PAGINAS</td>

                    <td>----</td>

                </tr>

                <tr>

                    <td class="datos_totales_bold">PACIENTE :</td>

                    <td><?php echo $paciente->razon_social;?></td>

                    <td class="datos_totales_bold">EDAD :</td>

                    <td><?php echo $paciente->edad.' años '.$paciente->mes.' mes '.$paciente->dia.'  días'?></td>                    

                </tr>      

                <tr>

                    <td class="datos_totales_bold">FECHA DE NACIMIENTO :</td>

                    <td><?php echo $paciente->fecha_nacimiento;?></td>

                    <td class="datos_totales_bold">TELEFONO</td>

                    <td><?php echo $paciente->telefono?></td>               

                </tr>      

                <tr>

                    <td class="datos_totales_bold">ALERGIAS</td>
                    <td><?php echo $paciente->alergia;?></td>
                    <td class="datos_totales_bold">CORREO</td>
                    <td><?php echo $paciente->correo;?></td>
                   

                </tr>
                  <tr>
                    <td class="datos_totales_bold">SEXO:</td>

                    <td><?php echo $paciente->sexo;?></td>
                    <td class="datos_totales_bold">RESPONSABLE:</td>
                    <td><?php echo $paciente->responsable;?></td>
                </tr>

                   <tr>
                    <td class="datos_totales_bold">ESTADO CIVIL:</td>
                     <td><?php echo $paciente->estado_civil;?></td>
                   <!-- <td><?php echo $paciente->observacion;?></td>-->
                    <td class="datos_totales_bold">OBSERVACION:</td>
                    <td><?php echo $paciente->observacion;?></td>
                    <!--<td><?php echo $paciente->estado_civil;?></td>-->
                   </tr>
                  
                  <tr>                    
                    <td class="datos_totales_bold">FECHA DE REGISTRO :</td>
                    <td><?php echo $paciente->fecha_insert;?></td>
                </tr>


            <br> <br>
            

           





            <table class="datos_imagen">                                        



                <?PHP foreach($imagenes as $value){?>

                <tr>

                    <td>                        

                        <div id="images_gallery">

                          <img class="imagenHistoria" src="<?php echo 'images/historias/'.$value->hii_foto;?>">

                        </div>

                    </td>

                </tr>                  

                <?PHP }?>

            </table>



        </span><br>        

    </body>

</html>
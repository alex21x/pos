
</style>        
        <script src="<?PHP echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>        
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog">
        </div>	
        <div class="modal fade" id="modalCajaMov" tabindex="-1" role="dialog">        
        </div>          
        <div class="modal fade" id="modalCajaMovCierre" tabindex="-1" role="dialog">        
        </div>          
        <div class="modal fade" id="myModalProducto" tabindex="-1" role="dialog">
        </div>
        <div class="modal fade" id="myModalPrecio" tabindex="-1" role="dialog">
        </div>
        <div class="modal fade" id="myModalNuevoCliente" tabindex="-1" role="dialog">
        </div>        
        <div class="modal fade" id="myModalPagoMonto" tabindex="-1" role="dialog">
        </div>
        <div class="modal fade" id="myModalNuevoPaciente" tabindex="-1" role="dialog">
        </div>
    </body>
</html>

<!-- ALEXANDER FERNANDEZ DE LA CRUZ 13-10-2020 -->
<script type="text/JavaScript">  

  $(".close").on("click",function(){
   location.href ='<?= base_url()?>index.php/acceso/inicio_administrador';
  })

   $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
</script>    

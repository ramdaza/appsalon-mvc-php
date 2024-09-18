<?php
  if(isset($_SESSION['admin']) && $_SESSION['admin']==="1"){ ?>
    <div class="barra-servicios">
      <!--<a href="/empresa" class="boton">Home</a>-->
      <a href="/admin" class="boton">Ver Citas</a>
      <a href="/servicios" class="boton">Ver Servicios</a>
      <a href="/servicios/crear" class="boton">Nuevo Servicio</a>
    </div>
<?php } ?>
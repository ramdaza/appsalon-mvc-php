<?php include_once __DIR__ . '/../templates/logout.php'; ?>
<?php @include_once __DIR__ . '/../templates/barra.php'; ?>
<h1 class="nombre-pagina">Citas</h1>
<p class="descripcion-pagina">Historial de Citas</p>
<form action="" class="formulario">
  <div id="citas-admin">
    <ul class="citas">
      <?php
        foreach($citas as $key =>$cita){ ?>
          <li>
              <input type="hidden" id="id" value="<?php echo $cita->id; ?>">
              <p>Fecha: <span><?php echo $cita->fecha; ?></span></p>
              <p>Hora: <span><?php echo $cita->hora; ?></span></p>
              <form method="POST">
                  <input
                      type="hidden"
                      name="id"
                      value="<?php echo $cita->id; ?>"
                      >
                  <input
                      type="submit"
                      class="boton"
                      value="Servicios"
                      > 
              </form>
          </li>
      <?php } ?>
    </ul>
  </div>
</form>
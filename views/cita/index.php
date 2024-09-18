<?php include_once __DIR__ . '/../templates/logout.php'; ?>
<?php include_once __DIR__ . '/../templates/barra.php'; ?>
<h1 class="nombre-pagina">Crear Nueva Cita</h1>
<p class="descripcion-pagina">Elige tus servicios e Ingresa tus Datos</p>
<div id="app">
  <nav class="tabs">
      <button class="paso actual" type="button" data-paso="1">Información Cita</button>
      <button class="paso" type="button" data-paso="2">Servicios</button>
      <button class="paso" type="button" data-paso="3">Resúmen</button>
      <!--<form action="/api/historia" method="POST" style="display: flex;">
        <button type="button" data-paso="4">Historial</button>
      </form>-->
  </nav>
  <div id="paso-1" class="seccion">
    <h2>Servicios</h2>
    <p class="text-center"></p>
    <form class="formulario">
      <fieldset>
        <legend class="text-center">Ingresa tus Datos y Fecha de tu cita</legend>
        <div class="campo">
          <label for="nombre">Nombre: <span>*</span></label>
          <input
            id="nombre"
            type="text"
            placeholder="Tu Nombre"
            value="<?php echo $nombre; ?>"
            disabled
            >
        </div>
        <div class="campo">
          <label for="fecha">Fecha: <span>*</span></label>
          <input
            id="fecha"
            type="date"
            min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>"
            >
        </div>
        <input type="hidden" id="id" value="<?php echo $id; ?>">
        <div class="campo">
          <label for="hora">Hora: <span>*</span></label>
          <input
            id="hora"
            type="time"
            >
        </div>
        <span>(*) Estos campos son Obligatorios</span>
      </fieldset>
    </form>
  </div>
  <div id="paso-2" class="seccion">
    <h2>Tus Datos y Citas</h2>
    <fieldset>
      <legend class="text-center">Selecciona tus servicios a continuación</legend>
      <div class="listado-servicios" id="servicios"></div>
    </fieldset>
  </div>
  <div id="paso-3" class="seccion contenido-resumen">
    <p class="text-center"></p>
  </div>
  <div id="paso-4" class="seccion contenido-historial">
    <!--
    <fieldset>
      <legend class="text-center">Historial de Citas</legend>
      <table class="table-primary table-bordered">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Fecha</th>
            <th scope="col">Hora</th>
            <th scope="col">Estatus</th>
            <th scope="col">Detalle</th>
          </tr>
        </thead>
        <tbody>

        </tbody>
      </table>
    </fieldset>
    -->
  </div>
  <div class="paginacion">
    <button
      id="anterior"
      class="boton"
      >&laquo; Anterior</button>
    <button
      id="siguiente"
      class="boton"
      >Siguiente &raquo; </button>
  </div>
</div>
<?php $script = "
  <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
  <script src='build/js/app.js'></script>
  ";
?>
<?php include_once __DIR__ . '/../templates/footer.php'; ?>
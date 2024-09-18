<?php include_once __DIR__ . '/../templates/logout.php'; ?>
<h1 class="nombre-pagina">Nuevo Servicio</h1>
<p class="descripcion-pagina">Llena todos los campos para Añadir un Nuevo Servicio  </p>
<?php
    @include_once __DIR__ . '/../templates/barra.php';
    @include_once __DIR__ . '/../templates/alertas.php';
?>
<form action="/servicios/crear" method="POST" class="formulario">
    <?php include_once __DIR__ . '/formulario.php'; ?>
    <input type="submit" class="boton" value="Guardar Servicio">
</form>
<?php include_once __DIR__ . '/../templates/footer.php'; ?>
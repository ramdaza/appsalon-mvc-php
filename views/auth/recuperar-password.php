<h1 class="nombre-pagina">Recuperar Password</h1>
<p class="descripcion-pagina">Ingresa tu nuevo Password a continuación</p>
<?php include_once __DIR__ . '/../templates/alertas.php'; ?>
<?php if($error) return; ?>
<form class="formulario" method="POST">
  <div class="campo">
    <label for="password">Password: <span>*</span></label>
    <input
      type="password"
      id="password"
      name="password"
      placeholder="Nuevo Password">
  </div>
  <span>(*) Estos campos son Obligatorios</span>
  <input type="submit" class="boton" value="Guardar Nuevo Password">
</form>
<div class="acciones">
  <a href="/">Ya tienes una Cuenta?, Iniciar Sesión</a>
  <a href="/crear-cuenta">Crear una Cuenta?</a>
</div>
<?php include_once __DIR__ . '/../templates/footer.php'; ?>
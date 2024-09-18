<h1 class="nombre-pagina">Crear Cuenta</h1>
<p class="descripcion-pagina">Llena el Siguiente Formulario para Crear una Cuenta</p>
<?php include_once __DIR__ . '/../templates/alertas.php'; ?>
<form action="/crear-cuenta" class="formulario" method="POST">
  <div class="campo">
    <label for="nombre">Nombre: <span>*</span></label>
    <input
      type="text"
      id="nombre"
      name="nombre"
      placeholder="Tu Nombre"
      value="<?php echo sanitizar($usuario->nombre); ?>">
  </div>
  <div class="campo">
    <label for="apellido">Apellido(s): <span>*</span></label>
    <input
      type="text"
      id="apellido"
      name="apellido"
      placeholder="Tu(s) Apellido(s)"
      value="<?php echo sanitizar($usuario->apellido); ?>">
  </div>
  <div class="campo">
    <label for="telefono">Telefono: <span>*</span></label>
    <input
      type="tel"
      id="telefono"
      name="telefono"
      placeholder="Tu Teléfono"
      value="<?php echo sanitizar($usuario->telefono); ?>">
  </div>
  <div class="campo">
    <label for="email">Email: <span>*</span></label>
    <input
      type="email"
      id="email"
      name="email"
      placeholder="Tu Email"
      value="<?php echo sanitizar($usuario->email); ?>">
  </div>
  <div class="campo">
    <label for="password">Password: <span>*</span></label>
    <input
      type="password"
      id="password"
      name="password"
      placeholder="Tu Password">
  </div>
  <span>(*) Estos campos son Obligatorios</span>
  <input type="submit" value="Crear Cuenta" class="boton">
</form>
<div class="acciones">
  <a href="/">Ya tienes una Cuenta?, Iniciar Sesión</a>
  <a href="/olvide">Recuperar Password?</a>
</div>
<?php include_once __DIR__ . '/../templates/footer.php'; ?>


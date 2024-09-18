<h1 class="nombre-pagina">Login</h1>
<p class="descripcion-pagina">Inicia sesión con tus datos</p>
<?php include_once __DIR__ . '/../templates/alertas.php'; ?>
<form action="/" class="formulario" method="POST">
  <div class="campo">
    <label for="email">Email: <span>*</span></label>
    <input 
      type="email"
      id="email"
      placeholder="Tu Email"
      name="email"
      value="<?php echo sanitizar($auth->email); ?>">
  </div>
  <div class="campo">
    <label for="password">Password: <span>*</span></label>
    <input
      type="password"
      name="password"
      id="password"
      placeholder="Tu Password">
  </div>
  <span>(*) Estos campos son Obligatorios</span>
  <input type="submit" class="boton" value="Iniciar Sesión">
</form>
<div class="acciones">
  <a href="/crear-cuenta">Crear una Cuenta?</a>
  <a href="/olvide">Recuperar Password?</a>
</div>
<?php include_once __DIR__ . '/../templates/footer.php'; ?>
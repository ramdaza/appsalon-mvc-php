<h1 class="nombre-pagina">Olvidé Password</h1>
<p class="descripcion-pagina">Reestablece tu Password, escribiendo tu Email a continuación</p>
<?php include_once __DIR__ . '/../templates/alertas.php'; ?>
<form action="/olvide" class="formulario" method="POST">
    <div class="campo">
        <label for="email">Email: <span>*</span></label>
        <input
            type="email"
            name="email"
            id="email"
            placeholder="Tu Email">
    </div>
    <span>(*) Estos campos son Obligatorios</span>
    <input type="submit" class="boton" value="Enviar Instrucciones">
</form>
<div class="acciones">
  <a href="/">Ya tienes una Cuenta?, Iniciar Sesión</a>
  <a href="/crear-cuenta">Crear una Cuenta?</a>
</div>
<?php include_once __DIR__ . '/../templates/footer.php'; ?>
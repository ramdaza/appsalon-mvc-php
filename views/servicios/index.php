<?php include_once __DIR__ . '/../templates/logout.php'; ?>
<h1 class="nombre-pagina">Servicios</h1>
<p class="descripcion-pagina">Administración de Servicios</p>
<?php @include_once __DIR__ . '/../templates/barra.php'; ?>
<ul class="servicios">
    <?php foreach($servicios as $servicio){ ?>
        <li>
            <p>Nombre: <span><?php echo $servicio->nombre; ?></span></p>
            <p>Precio: <span>$<?php echo $servicio->precio; ?></span></p>
            <div class="acciones">
                <a class="boton" href="/servicios/actualizar?id=<?php echo $servicio->id; ?>">Actualizar</a>
                <form action="/servicios/eliminar" method="POST" id="formEliminarServicio" >
                    <input
                        type="hidden"
                        name="id"
                        value="<?php echo $servicio->id; ?>"
                        >
                    <input
                        type="submit"
                        value="Eliminar"
                        class="boton-eliminar"
                        onclick="confirmDelete(event, '#formEliminarServicio')"
                        >
                </form>
            </div>
        </li>
    <?php }; ?>
</ul>
<?php
    $script = "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script src='https://kit.fontawesome.com/d74a8aa5fa.js' crossorigin='anonymous'></script>
        ";
?>
<?php include_once __DIR__ . '/../templates/footer.php'; ?>
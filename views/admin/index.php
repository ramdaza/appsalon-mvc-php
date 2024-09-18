<?php include_once __DIR__ . '/../templates/logout.php'; ?>
<h1 class="nombre-pagina">Panel de Administración</h1>
<?php include_once __DIR__ . '/../templates/barra.php'; ?>
<h2>Buscar Citas</h2>
<div class="busqueda">
    <form action="" class="formulario">
        <div class="campo">
          <label for="fecha">Fecha:</label>
          <input
            id="fecha"
            type="date"
            name="fecha"
            value="<?php echo $fecha; ?>"
            >
        </div>
    </form>
</div>
<?php if(count($citas)===0){
        echo "<h2>No hay Citas en la Fecha Seleccionada</h2>";
    }
?>
<div id="citas-admin">
    <ul class="citas">
        <?php
            $idCita = 0;
            foreach($citas as $key => $cita){
                if($idCita !== $cita->id){ $total = 0; ?>
                <li>
                    <input type="hidden" id="id" value="<?php echo $cita->id; ?>">
                    <!--<p>ID: <span><?php echo $cita->id; ?></span></p>-->
                    <p>Cliente: <span><?php echo $cita->cliente; ?></span></p>
                    <p>Hora: <span><?php echo $cita->hora; ?></span></p>
                    <p>Email: <span><?php echo $cita->email; ?></span></p>
                    <p>Teléfono: <span><?php echo $cita->telefono; ?></span></p>
                    <h3>Servicios</h3>
                    <?php
                        $idCita = $cita->id;
                    }
                        $total += $cita->precio;
                    ?>
                    <p class="servicio"><?php echo $cita->servicio . ' $' . $cita->precio; ?></p>
                <?php
                    $actual = $cita->id;
                    $proximo = $citas[$key+1]->id ?? 0;
                    if(esUltimo($actual, $proximo)){ ?>
                        <p class="total">Total: <span>$ <?php echo $total; ?></span></p>
                        <form action="/api/eliminar" method="POST">
                            <input
                                type="hidden"
                                name="id"
                                value="<?php echo $cita->id; ?>"
                                >
                            <input
                                type="submit"
                                class="boton-eliminar"
                                value="Eliminar"
                                > 
                        </form>
                <?php }
            } ?>
    </ul>
</div>
<?php
    $script = "
        <script src='build/js/buscador.js'></script>
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js'></script>
        <script src='https://kit.fontawesome.com/d74a8aa5fa.js' crossorigin='anonymous'></script>
        ";
?>
<?php include_once __DIR__ . '/../templates/footer.php'; ?>
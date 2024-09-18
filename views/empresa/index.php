<?php include_once __DIR__ . '/../templates/logout.php'; ?>
<h1 class="nombre-pagina">Home</h1>
<?php @include_once __DIR__ . '/../templates/barra.php'; ?>
<form action="" class="formulario" method="POST">
    <fieldset>
        <legend class="text-center">Datos de la Empresa</legend>
        <div class="campo">
            <label for="nombre">Nombre: <span>*</span></label>
            <input 
                type="text"
                name="nombre"
                id="nombre"
                placeholder="Nombre de la Empresa"
                >
        </div>
        <div class="campo">
            <label for="direccion">Dirección: <span>*</span></label>
            <input 
                type="text"
                name="direccion"
                id="direccion"
                placeholder="Dirección de la Empresa"
                >
        </div>
        <div class="campo">
            <label for="telefono">Teléfono: <span>*</span></label>
            <input 
                type="tel"
                name="telefono"
                id="telefono"
                placeholder="Teléfono"
                >
        </div>
        <div class="campo">
            <label for="email">Email: <span>*</span></label>
            <input 
                type="email"
                name="email"
                id="email"
                placeholder="Email de la Empresa"
                >
        </div>
        <div class="campo">
            <label for="ubicacion">Ubicación: <span>*</span></label>
            <input 
                type="text"
                name="ubicacion"
                id="ubicacion"
                placeholder="Ubicación de la Empresa"
                >
        </div>
    </fieldset>
    <span>(*) Estos campos son Obligatorios</span>
    <input type="submit" class="boton" value="Guardar">
</form>
<?php include_once __DIR__ . '/../templates/footer.php'; ?>
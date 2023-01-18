<div class="contenedor">
    <?php include_once __DIR__ . '/../templates/nombre-sitio.php' ?>

    <div class="contenedor-sm">
        <p class="saludos">Saludos, Administrador: <?php echo $_SESSION['nombre'] ?></p>
        <?php include_once __DIR__ . '/../templates/navegacion.php' ?>
        <div class="botones">
            <a class="boton" href="/admin-citas">Volver</a>
        </div>
        <h3 class="titulo-admin">Citas por fecha</h3>
        <p>Introduzca la fecha en la que desea buscar citas</p>

        <?php include_once __DIR__ . '/../templates/alertas.php' ?>
        <form class="formulario" action="/admin-citas/buscar" method="POST">
            <div class="campo">
                <label for="fecha">Fecha</label>
                <input type="date" id="fecha" name="fecha" value="<?php echo $cita->fecha ?>">
            </div>
            <input class="boton" type="submit" value="Buscar">
        </form>

        <?php include_once __DIR__ . '/../templates/tabla-citas.php' ?>

    </div>
</div>
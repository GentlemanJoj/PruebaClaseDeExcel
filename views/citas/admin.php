<div class="contenedor">
    <?php include_once __DIR__ . '/../templates/nombre-sitio.php' ?>

    <div class="contenedor-sm">
        <p class="saludos">Saludos, Administrador: <?php echo $_SESSION['nombre'] ?></p>
        <?php include_once __DIR__ . '/../templates/navegacion.php' ?>
        <div class="botones">
            <a class="boton" href="/admin-citas/crear">Reservar Cita</a>
            <a class="boton" href="/admin-citas/buscar">Buscar Citas</a>
            <a class="boton" href="/admin-citas/calendario">Calendario</a>
        </div>

        <?php
        if ($eliminado === 1) {
            $alertas['exito'][] = 'Eliminado correctamente';
        }
        ?>

        <h3 class="titulo-admin">Citas</h3>
        <?php include_once __DIR__ . '/../templates/alertas.php' ?>

        <?php include_once __DIR__ . '/../templates/tabla-citas.php' ?>

    </div>

</div>
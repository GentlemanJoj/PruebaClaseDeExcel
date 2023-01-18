<div class="contenedor">
    <?php include_once __DIR__ . '/../templates/nombre-sitio.php' ?>

    <div class="contenedor-sm">
        <p>Saludos, Administrador: <?php echo $_SESSION['nombre'] ?></p>
        <div class="botones">
            <a class="boton" href="/admin-citas">Volver</a>
        </div>

        <h3 class="titulo-admin">Actualizar Cita</h3>
        <p>Introduzca la información de la reserva que desea actualizar</p>

        <?php include_once __DIR__ . '/../templates/alertas.php' ?>

        <p class="texto-info">Introduzca la mascota y la fecha </p>
        <p class="texto-info">El horario de atención es de 08:00am-12:00pm y de 01:00pm-06:00pm, de lunes-viernes</p>
        <p class="texto-info">Cada cita dura 1 hora</p>

        <form class="formulario login" method="POST">
            <?php include_once __DIR__ . '/../templates/formulario-reservar-cita.php' ?>
            <input type="submit" value="Reservar">
        </form>
    </div>
</div>
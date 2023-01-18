<div class="contenedor">
    <?php include_once __DIR__ . '/../templates/nombre-sitio.php' ?>

    <div class="contenedor-sm">
        <p>Saludos, Administrador: <?php echo $_SESSION['nombre'] ?></p>
        <div class="botones">
            <a class="boton" href="/admin-citas">Volver</a>
        </div>

        <h3 class="titulo-admin">Reservar Cita</h3>
        <p>Introduzca la información de la reserva</p>

        <?php include_once __DIR__ . '/../templates/alertas.php' ?>
        <p class="center">Introduzca la información del propietario</p>
        <form class="formulario" action="/admin-citas/buscar-usuario" method="POST">
            <div class="campo seleccion">
                <label for="nombre"> Nombre Propietario: </label>
                <select name="id" id="usuario">
                    <option value="">--Seleccione--</option>
                    <?php foreach ($propietarios as $propietario) : ?>
                        <option value="<?php echo s($propietario->id); ?>"><?php echo s($propietario->nombre) . ' ' . s($propietario->apellido); ?></option>
                    <?php endforeach ?>
                </select>
                <input type="submit" value="Escoger">
            </div>
        </form>

        <p class="center">Introduzca la mascota y la fecha </p>
        <p class="texto-info">El horario de atención es de 08:00am-12:00pm y de 01:00pm-06:00pm, de lunes-viernes</p>
        <p class="texto-info">Cada cita dura 1 hora</p>

        <div class="seleccion">
            <form class="formulario" method="POST">
                <?php include_once __DIR__ . '/../templates/formulario-reservar-cita.php' ?>
                <input class="boton" type="submit" value="Reservar">
            </form>
        </div>
    </div>
</div>
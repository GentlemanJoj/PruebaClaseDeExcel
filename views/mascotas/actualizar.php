<div class="contenedor">
    <?php include_once __DIR__ . '/../templates/nombre-sitio.php' ?>

    <div class="contenedor-sm">
        <p>Saludos, Administrador: <?php echo $_SESSION['nombre'] ?></p>
        <div class="botones">
            <a class="boton" href="/admin-mascotas">Volver</a>
        </div>

        <h3 class="titulo-admin">Actualizar Mascota</h3>
        <p>Introduzca la información de la mascota que desea actualizar</p>

        <?php include_once __DIR__ . '/../templates/alertas.php' ?>

        <form class="formulario" method="POST">
            <?php include_once __DIR__ . '/../templates/formulario-crear-mascota.php' ?>
            <input class="boton" type="submit" value="Actualizar Mascota">
        </form>

    </div>

</div>
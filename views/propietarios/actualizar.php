<div class="contenedor">
    <?php include_once __DIR__ . '/../templates/nombre-sitio.php' ?>

    <div class="contenedor-sm">
        <p>Saludos, Administrador: <?php echo $_SESSION['nombre'] ?></p>
        <div class="botones">
            <a class="boton" href="/admin-propietarios">Volver</a>
        </div>
        <h3 class="titulo-admin">Actualizar Propietario</h3>
        <p>Introduzca la información del propietario que desea actualizar</p>

        <?php include_once __DIR__ . '/../templates/alertas.php' ?>

        <form class="formulario" method="POST">
            <?php include_once __DIR__ . '/../templates/formulario-crear-usuario.php' ?>
            <input class="boton" type="submit" value="Actualizar Propietario">
        </form>
    </div>
</div>
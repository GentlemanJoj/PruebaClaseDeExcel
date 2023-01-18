<div class="contenedor">
    <?php include_once __DIR__ . '/../templates/nombre-sitio.php' ?>

    <div class="contenedor-sm">
        <p class="saludos">Saludos, Administrador: <?php echo $_SESSION['nombre'] ?></p>
        <?php include_once __DIR__ . '/../templates/navegacion.php' ?>

        <div class="botones">
            <a class="boton" href="/admin-citas">Volver</a>
        </div>

        <h3 class="titulo-admin">Calendario de Citas</h3>

        <?php include_once __DIR__ . '/../templates/alertas.php' ?>

        <div class="calendario" id="calendario""></div>

    </div>
</div>

<?php
$script = "
    <script src='../build/js/app.js'></script> 
    ";
?>
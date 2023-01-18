<div class="contenedor">
    <?php include_once __DIR__ . '/../templates/nombre-sitio.php' ?>

    <div class="contenedor-sm login">
        <?php include_once __DIR__ . '/../templates/alertas.php';
        if ($vista) {
        ?>
            <p>Introduzca la contraseña nueva</p>
            <form class="formulario" method="POST">
                <div class="campo">
                    <label for="password"> Contraseña </label>
                    <input type="password" id="password" placeholder="Tu contraseña" name="password">
                </div>
                <input type="submit" value="Restablecer Contraseña">
            </form>
        <?php
        } else {
        ?>
            <div class="acciones">
                <a href="/">Regresar al Inicio</a>
            </div>
        <?php
        }
        ?>

    </div>
</div>
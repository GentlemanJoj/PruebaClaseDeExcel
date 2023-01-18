<div class="contenedor olvide">
    <?php include_once __DIR__ . '/../templates/nombre-sitio.php' ?>

    <div class="contenedor-sm">
        <p>Introduzca su correo para restablecer contraseña</p>
        <?php include_once __DIR__ . '/../templates/alertas.php'; ?>

        <form class="formulario login" action="/olvide" method="POST">
            <div class="campo">
                <label for="correo"> Correo </label>
                <input type="email" id="correo" placeholder="Tu Correo" name="correo" value="<?php echo $usuario->correo; ?>">
            </div>

            <input type="submit" value="Enviar Correo">
        </form>

        <div class="acciones">
            <a href="/">Iniciar Sesión</a>
            <a href="/crear">Crear una Cuenta</a>
        </div>
    </div>

</div>
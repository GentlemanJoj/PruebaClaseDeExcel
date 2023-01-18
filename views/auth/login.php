<div class="contenedor login">
    <?php include_once __DIR__ . '/../templates/nombre-sitio.php' ?>

    <div class="contenedor-sm">

        <p>Inicia sesión con tus datos</p>

        <?php include_once __DIR__ . '/../templates/alertas.php' ?>

        <form class="formulario" action="/" method="POST">
            <div class="campo">
                <label for="correo"> Correo </label>
                <input type="email" id="correo" placeholder="Tu Correo" name="correo" value="<?php echo $usuario->correo; ?>">
            </div>

            <div class="campo">
                <label for="password"> Contraseña </label>
                <input type="password" id="password" placeholder="Tu contraseña" name="password">
            </div>

            <input type="submit" value="Iniciar Sesión">

        </form>

        <div class="acciones">
            <a href="/crear">¿No tienes cuenta?, Crea una</a>
            <a href="/olvide">¿Olvidaste tu contraseña?</a>
        </div>

    </div>
</div>
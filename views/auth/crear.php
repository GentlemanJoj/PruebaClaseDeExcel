<div class="contenedor login">
    <?php include_once __DIR__ . '/../templates/nombre-sitio.php' ?>

    <div class="contenedor-sm">

        <p>Completa el formulario para crear una cuenta</p>

        <?php include_once __DIR__ . '/../templates/alertas.php' ?>

        <form class="formulario" action="/crear" method="POST">
            <?php include_once __DIR__ . '/../templates/formulario-crear-usuario.php' ?>
            <input type="submit" value="Crear Cuenta">
        </form>

        <div class="acciones">
            <a href="/">Iniciar Sesión</a>
            <a href="/olvide">¿Olvidaste tu contraseña?</a>
        </div>

    </div>
</div>
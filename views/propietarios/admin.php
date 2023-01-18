<div class="contenedor">
    <?php include_once __DIR__ . '/../templates/nombre-sitio.php' ?>

    <div class="contenedor-sm">
        <p class="saludos">Saludos, Administrador: <?php echo $_SESSION['nombre'] ?></p>
        <?php include_once __DIR__ . '/../templates/navegacion.php' ?>

        <div class="botones">
            <a class="boton" href="/admin-propietarios/crear">Crear Propietario</a>
        </div>

        <?php
        if ($eliminado === 1) {
            $alertas['exito'][] = 'Eliminado correctamente';
        }
        ?>

        <h3 class="titulo-admin">Propietarios</h3>

        <?php include_once __DIR__ . '/../templates/alertas.php' ?>
        <?php if (sizeof($propietarios) > 0) : ?>
            <table class="tabla">
                <thead>
                    <th>Nombre Completo</th>
                    <th>Correo</th>
                    <th>Celular</th>
                    <th>Acciones</th>
                </thead>

                <tbody>
                    <?php foreach ($propietarios as $propietario) : ?>
                        <tr>
                            <td><?php echo $propietario->nombre . ' ' . $propietario->apellido ?></td>
                            <td><?php echo $propietario->correo ?></td>
                            <td><?php echo $propietario->celular ?></td>
                            <td>
                                <form class="w-100" action="/admin-propietarios/eliminar" method="POST">
                                    <input type="hidden" name="id" value="<?php echo $propietario->id ?>">
                                    <input type="submit" class="boton-eliminar" value="Eliminar">
                                </form>

                                <a href="/admin-propietarios/actualizar?id=<?php echo $propietario->id ?>" class="boton-actualizar">Actualizar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>

    </div>
</div>
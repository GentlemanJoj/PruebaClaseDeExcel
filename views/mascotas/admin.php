<div class="contenedor">
    <?php include_once __DIR__ . '/../templates/nombre-sitio.php' ?>

    <div class="contenedor-sm">
        <p class="saludos">Saludos, Administrador: <?php echo $_SESSION['nombre'] ?></p>
        <?php include_once __DIR__ . '/../templates/navegacion.php' ?>

        <div class="botones">
            <a class="boton" href="/admin-mascotas/crear">Crear Mascota</a>
        </div>

        <?php
        if ($eliminado === 1) {
            $alertas['exito'][] = 'Eliminado correctamente';
        }
        ?>

        <h3 class="titulo-admin">Mascotas</h3>

        <?php include_once __DIR__ . '/../templates/alertas.php' ?>

        <?php if (sizeof($mascotas)  > 0) : ?>
            <table class="tabla">
                <thead>
                    <th>Nombre</th>
                    <th>Propietario</th>
                    <th>Tipo</th>
                    <th>Acciones</th>
                </thead>

                <tbody>
                    <?php foreach ($mascotas as $mascota) : ?>
                        <tr>
                            <td><?php echo $mascota->nombre ?></td>

                            <?php foreach ($propietarios as $propietario) : ?>
                                <?php if ($mascota->usuarioId === $propietario->id) : ?>
                                    <td><?php echo $propietario->nombre . ' ' . $propietario->apellido ?></td>
                                <?php endif; ?>
                            <?php endforeach; ?>

                            <?php foreach ($tipos as $tipo) : ?>
                                <?php if ($mascota->tipomascotaId === $tipo->id) : ?>
                                    <td><?php echo $tipo->tipomascota ?></td>
                                <?php endif; ?>
                            <?php endforeach; ?>

                            <td>
                                <form class="w-100" action="/admin-mascotas/eliminar" method="POST">
                                    <input type="hidden" name="id" value="<?php echo $mascota->id ?>">
                                    <input type="submit" class="boton-eliminar" value="Eliminar">
                                </form>

                                <a href="/admin-mascotas/actualizar?id=<?php echo $mascota->id ?>" class="boton-actualizar">Actualizar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>
<?php if (sizeof($reservas) > 0) : ?>
    <table class="tabla">
        <thead>
            <th>Propietario</th>
            <th>Mascota</th>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Acciones</th>
        </thead>

        <tbody>
            <?php foreach ($reservas as $reserva) : ?>
                <tr>
                    <?php foreach ($propietarios as $propietario) : ?>
                        <?php if ($reserva->usuarioId == $propietario->id) : ?>
                            <td><?php echo $propietario->nombre . ' ' . $propietario->apellido; ?></td>
                        <?php endif; ?>
                    <?php endforeach; ?>

                    <?php foreach ($mascotas as $mascota) : ?>
                        <?php if ($reserva->mascotaId == $mascota->id) : ?>
                            <td><?php echo $mascota->nombre ?></td>
                        <?php endif; ?>
                    <?php endforeach; ?>

                    <td><?php
                        $fecha = date_create($reserva->fecha);
                        $fecha = date_format($fecha, 'd-m/y');
                        echo $fecha;
                        ?>
                    </td>
                    <td>
                        <?php
                        $hora = date_create($reserva->hora);
                        $hora = date_format($hora, 'g:00 a');
                        echo $hora;
                        ?>
                    </td>
                    <td>
                        <?php
                        $hora_actual = date('G');
                        $hora_reserva = date_create($reserva->hora);
                        $hora_reserva = date_format($hora_reserva, 'G');
                        if (strtotime($reserva->fecha) > strtotime(date('Y-m-d'))) {
                        ?>
                            <a href="/admin-citas/actualizar?id=<?php echo $reserva->id ?>" class="boton-actualizar">Actualizar</a>
                            <form class="w-100" action="/admin-citas/eliminar" method="POST">
                                <input type="hidden" name="id" value="<?php echo $reserva->id ?>">
                                <input type="submit" class="boton-eliminar" value="Eliminar">
                            </form>
                        <?php } else if (strtotime($reserva->fecha) < strtotime(date('Y-m-d')) ||  ((strtotime($reserva->fecha) == strtotime(date('Y-m-d'))) && ($hora_actual > $hora_reserva))) { ?>
                            <p>Cita Cumplida</p>
                            <form class="w-100" action="/admin-citas/eliminar" method="POST">
                                <input type="hidden" name="id" value="<?php echo $reserva->id ?>">
                                <input type="submit" class="boton-eliminar" value="Eliminar">
                            </form>
                        <?php } else if (strtotime($reserva->fecha) == strtotime(date('Y-m-d')) && $hora_reserva == $hora_actual) { ?>
                            <p>Cita en proceso</p>
                        <?php } else if (strtotime($reserva->fecha) == strtotime(date('Y-m-d')) && ($hora_reserva - $hora_actual) < 2) { ?>
                            <p>Quedan menos de 2 horas para la Cita,</br> no es posible editarla o eliminarla</p>
                        <?php } else if (strtotime($reserva->fecha) == strtotime(date('Y-m-d'))) { ?>
                            <a href="/admin-citas/actualizar?id=<?php echo $reserva->id ?>" class="boton-actualizar">Actualizar</a>
                            <form class="w-100" action="/admin-citas/eliminar" method="POST">
                                <input type="hidden" name="id" value="<?php echo $reserva->id ?>">
                                <input type="submit" class="boton-eliminar" value="Eliminar">
                            </form>
                        <?php } ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
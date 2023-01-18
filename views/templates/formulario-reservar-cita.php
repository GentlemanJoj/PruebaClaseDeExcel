<input type="hidden" id="usuarioId" name="usuarioId" value="<?php echo $usuario->id ?>" aria-disabled="true">
<?php if (!$actualizar) : ?>
    <div class="campo">
        <label for="nombre"> Nombre </label>
        <input type="text" id="nombre" name="nombre" value="<?php echo $usuario->nombre; ?>" disabled>
    </div>
    <div class="campo">
        <label for="docIdentidad"> D.Identidad </label>
        <input type="number" id="docIdentidad" name="docIdentidad" value="<?php echo $usuario->docIdentidad; ?>" disabled>
    </div>
<?php endif; ?>
<div class="campo">
    <label for="mascotaId"> Nombre Mascota: </label>
    <select name="mascotaId" id="mascotaId">
        <option value="">--Seleccione--</option>
        <?php foreach ($mascotas as $mascota) : ?>
            <option <?php echo $cita->mascotaId === $mascota->id ? 'selected' : ''; ?> value="<?php echo s($mascota->id); ?>"><?php echo s($mascota->nombre) ?></option>
        <?php endforeach ?>
    </select>
</div>
<div class="campo">
    <label for="fecha">Fecha</label>
    <input type="date" id="fecha" name="fecha" min="<?php echo date('Y-m-d') ?>" value="<?php echo $cita->fecha ?>">
</div>

<div class="campo">
    <label for="hora">Hora</label>
    <input type="time" id="hora" name="hora" min="<?php echo date('h:i a') ?>" value="<?php echo $cita->hora ?>">
</div>
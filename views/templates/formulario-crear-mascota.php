<?php if ($actualizar === false) : ?>
    <div class="campo">
        <label for="usuarioId"> Propietario: </label>
        <select name="usuarioId" id="usuarioId">
            <option value="">--Seleccione--</option>
            <?php foreach ($propietarios as $propietario) : ?>
                <option <?php echo $mascota->usuarioId === $propietario->id ? 'selected' : ''; ?> value="<?php echo s($propietario->id); ?>"><?php echo s($propietario->nombre) . ' ' . s($propietario->apellido) ?></option>
            <?php endforeach ?>
        </select>
    </div>

    <div class="campo">
        <label for="tipomascotaId"> Tipo Mascota: </label>
        <select name="tipomascotaId" id="tipomascotaId">
            <option value="">--Seleccione--</option>
            <?php foreach ($tipos as $tipo) : ?>
                <option <?php echo $mascota->tipomascotaId === $tipo->id ? 'selected' : ''; ?> value="<?php echo s($tipo->id); ?>"><?php echo s($tipo->tipomascota) ?></option>
            <?php endforeach ?>
        </select>
    </div>
<?php endif; ?>

<div class="campo">
    <label for="nombre"> Nombre </label>
    <input type="text" id="nombre" placeholder="Nombre(s) de la mascota" name="nombre" value="<?php echo $mascota->nombre; ?>">
</div>
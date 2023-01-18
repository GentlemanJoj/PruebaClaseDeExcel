<div class="campo">
    <label for="nombre"> Nombre </label>
    <input type="text" id="nombre" placeholder="Tu nombre(s)" name="nombre" value="<?php echo $usuario->nombre; ?>">
</div>
<div class="campo">
    <label for="apellido"> Apellido </label>
    <input type="text" id="apellido" placeholder="Tu apellido(s)" name="apellido" value="<?php echo $usuario->apellido; ?>">
</div>
<div class="campo">
    <label for="docIdentidad"> D.Identidad </label>
    <input type="number" id="docIdentidad" placeholder="Tu documento de identidad" name="docIdentidad" value="<?php echo $usuario->docIdentidad; ?>">
</div>
<div class="campo">
    <label for="celular"> Celular </label>
    <input type="text" id="celular" placeholder="Tu número de celular" name="celular" value="<?php echo $usuario->celular; ?>">
</div>
<div class="campo">
    <label for="correo"> Correo </label>
    <input type="email" id="correo" placeholder="Tu Correo" name="correo" value="<?php echo $usuario->correo; ?>">
</div>

<?php if ($actualizar == false) { ?>
    <div class="campo">
        <label for="password"> Contraseña </label>
        <input type="password" id="password" placeholder="Tu contraseña" name="password">
    </div>
<?php } ?>
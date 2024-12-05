<?php require('views/header.php') ?>
<h1><?php if($accion=="crear"):echo('Nuevo');else:echo('Modificar');endif; ?> Producto</h1>
<form method="post" action="producto.php?accion=<?php if($accion=="crear"):echo('nuevo');else:echo('modificar&id=' . $productos['id_producto']);endif;?>">
    <div class="mb-3">
        <label for="producto" class="form-label">Nombre del Producto</label>
        <input class="form-control" type="text" name="data[producto]" placeholder="Escribe aqui el nombre" id="producto"
        value="<?php if(isset($productos['producto'])):echo($productos['producto']);endif; ?>"/>
    </div>

    <div class="mb-3">
        <label for="categoria" class="form-label">Categoría del Producto</label>
        <input class="form-control" type="text" name="data[categoria]" placeholder="Escribe aqui la categoria" id="categoria"
        value="<?php if(isset($productos['categoria'])):echo($productos['categoria']);endif; ?>"/>
    </div>

    <div class="mb-3">
        <label for="longitud" class="form-label">Longitud del Producto</label>
        <input class="form-control" type="text" name="data[longitud]" placeholder="Escribe aqui la longitud" id="longitud"
        value="<?php if(isset($productos['longitud'])):echo($productos['longitud']);endif; ?>"/>
    </div>

    <div class="mb-3">
        <label for="area" class="form-label">Area del Producto (m<sup>2</sup>)</label>
        <input class="form-control" id="area" type="number" name="data[area]" placeholder="Escribe aqui el area" 
        value="<?php if(isset($productos['area'])):echo($productos['area']);endif; ?>"/>
    </div>

    <div class="mb-3">
        <label class="form-label" for="fecha">Fecha</label>
        <input class="form-control" id="fecha" type="date" name="data[fecha_creacion]" placeholder="Escribe aqui la fecha" 
        value="<?php if(isset($productos['fecha_creacion'])):echo($productos['fecha_creacion']);endif; ?>"/>
    </div>

    <div class="mb-3">
        <input class="btn btn-success" type="submit" name="data[enviar]" value="Guardar"/>
    </div>
</form>
<?php require('views/footer.php') ?>
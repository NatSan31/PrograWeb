<div class="container">
    <h1><?php echo ($action == 'UPDATE') ? 'Actualizar información de la categoría' : 'Agregar nueva categoría'; ?></h1>
    <form action="categoria.php?action=<?php echo ($action == 'UPDATE') ? 'EDIT&id_categoria=' . $datos['id_categoria'] : 'SAVE'; ?>" method="post">
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa fa-tag"></i></span>
                    <div class="form-floating">
                        <input required="required" type="text" class="form-control" id="categoria" placeholder="Categoría" name="categoria" value="<?php echo (isset($datos['categoria'])) ? $datos['categoria'] : ''; ?>">
                        <label for="categoria">Categoría</label>
                    </div>
                </div>
                <input type="submit" value="Guardar" class="btn btn-success mb-3 btn-lg" style="width: auto;" name="SAVE">
            </div>
        </div>
    </form>
</div>

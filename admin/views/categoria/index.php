<div class="container">
    <h1>Categorías</h1>
    <div class="row">
        <div class="col-lg-4 col-md-12">
            <div class="btn-group" role="group" aria-label="Basic example">
                <a href="#" class="btn btn-primary">Regresar</a>
                <a href="categoria.php?action=CREATE" class="btn btn-success">Nuevo</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Categoría</th>
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($datos as $dato) : ?>
                        <tr>
                            <th scope="row"><?php echo $dato['id_categoria']; ?></th>
                            <td><?php echo htmlspecialchars($dato['categoria'], ENT_QUOTES, 'UTF-8'); ?></td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="categoria.php?action=UPDATE&id_categoria=<?php echo $dato['id_categoria']; ?>" class="btn btn-primary">Actualizar</a>
                                    <a href="categoria.php?action=DELETE&id_categoria=<?php echo $dato['id_categoria']; ?>" class="btn btn-danger">Eliminar</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <p><?php echo ($app->getCount() > 1) ? "Se encontraron ".$app->getCount()." categorías" : "Se encontró ".$app->getCount()." categoría"?></p>
        </div>
    </div>
</div>

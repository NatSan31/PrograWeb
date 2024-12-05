<div class="container mt-4">
    <?php if (!empty($alert)) : ?>
        <div class="alert alert-<?php echo $alert['type']; ?>" role="alert">
            <?php echo $alert['message']; ?>
        </div>
    <?php endif; ?>

    <h1>Lista de Productos</h1>
    <a href="productos.php?action=CREATE" class="btn btn-primary mb-3"><i class="fa fa-plus"></i> Agregar Nuevo Producto</a>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Producto</th>
                <th>Precio</th>
                <th>Marca</th>
                <th>Categoría</th>
                <th>Fotografía</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($datos) > 0): ?>
                <?php foreach ($datos as $producto): ?>
                    <tr>
                        <td><?php echo $producto['id_producto']; ?></td>
                        <td><?php echo htmlspecialchars($producto['producto']); ?></td>
                        <td>$<?php echo number_format($producto['precio'], 2); ?></td>
                        <td><?php echo htmlspecialchars($producto['marca']); ?></td>
                        <td><?php echo htmlspecialchars($producto['categoria']); ?></td>
                        <td>
                            <?php if (!empty($producto['fotografia'])): ?>
                                <img src="../uploads/productos/<?php echo $producto['fotografia']; ?>" alt="Fotografía del producto" style="width: 50px; height: 50px;">
                            <?php else: ?>
                                <span>No disponible</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="productos.php?action=UPDATE&id_producto=<?php echo $producto['id_producto']; ?>" class="btn btn-warning btn-sm">
                                <i class="fa fa-edit"></i> Editar
                            </a>
                            <a href="productos.php?action=DELETE&id_producto=<?php echo $producto['id_producto']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar este producto?');">
                                <i class="fa fa-trash"></i> Eliminar
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7" class="text-center">No hay productos registrados</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<div class="container mt-4">
    <h1><?php echo ($action == 'UPDATE') ? 'Actualizar Información del Producto' : 'Agregar Nuevo Producto'; ?></h1>
    <form action="productos.php?action=<?php echo ($action == 'UPDATE') ? 'EDIT&id_producto=' . $datos['id_producto'] : 'SAVE'; ?>" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-lg-8 col-md-12">
                
                <!-- Campo Producto -->
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-box"></i></span>
                    <div class="form-floating">
                        <input required type="text" class="form-control" id="producto" placeholder="Producto" name="producto" value="<?php echo isset($datos['producto']) ? htmlspecialchars($datos['producto']) : ''; ?>">
                        <label for="producto">Producto</label>
                    </div>
                </div>
                
                <!-- Campo Precio -->
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-dollar-sign"></i></span>
                    <div class="form-floating">
                        <input type="number" step="0.01" class="form-control" id="precio" placeholder="Precio" name="precio" value="<?php echo isset($datos['precio']) ? htmlspecialchars($datos['precio']) : ''; ?>" required>
                        <label for="precio">Precio</label>
                    </div>
                </div>
                
                <!-- Seleccionar Marca -->
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-tag"></i></span>
                    <div class="form-floating">
                        <select name="id_marca" id="selectIdMarca" class="form-select" required>
                            <option value="">Seleccionar Marca</option>
                            <?php foreach ($marcas as $marca) : ?>
                                <option value="<?php echo $marca['id_marca']; ?>" <?php echo (isset($datos['id_marca']) && $marca['id_marca'] == $datos['id_marca']) ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($marca['marca']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <label for="selectIdMarca">Marca</label>
                    </div>
                </div>
                
                <!-- Seleccionar Categoría -->
                <div class="input-group mb-3">
                    <span class="input-group-text"><i class="fa-solid fa-list"></i></span>
                    <div class="form-floating">
                        <select name="id_categoria" id="selectIdCategoria" class="form-select" required>
                            <option value="">Seleccionar Categoría</option>
                            <?php foreach ($categorias as $categoria) : ?>
                                <option value="<?php echo $categoria['id_categoria']; ?>" <?php echo (isset($datos['id_categoria']) && $categoria['id_categoria'] == $datos['id_categoria']) ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($categoria['categoria']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <label for="selectIdCategoria">Categoría</label>
                    </div>
                </div>
                
                <!-- Mostrar Imagen Actual (solo en actualización) -->
                <?php if ($action == 'UPDATE' && !empty($datos['fotografia'])) : ?>
                    <div class="mb-3">
                        <label for="fotografia_actual">Imagen Actual</label>
                        <img src="../uploads/productos/<?php echo htmlspecialchars($datos['fotografia']); ?>" alt="Imagen del producto" style="width: 150px; height: 150px;">
                    </div>
                <?php endif; ?>

                <!-- Cargar Nueva Imagen -->
                <div class="input-group mb-3">
                    <label class="input-group-text" for="fotografia"><i class="fa-solid fa-camera"></i></label>
                    <input type="file" accept="image/*" class="form-control" id="fotografia" name="fotografia">
                </div>

                <!-- Botón Guardar -->
                <div class="d-grid">
                    <button type="submit" class="btn btn-success btn-lg">
                        <i class="fa-solid fa-save"></i> Guardar
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

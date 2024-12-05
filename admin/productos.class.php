<?php
require __DIR__ . "\\sistema.class.php";

class Productos extends Sistema {

    // Método de validación de datos del producto
    private function validateProducto($datos) {
        if (empty($datos['producto'])) {
            throw new Exception("El nombre del producto es obligatorio.");
        }
        if (!is_numeric($datos['precio']) || $datos['precio'] <= 0) {
            throw new Exception("El precio debe ser un número positivo.");
        }
        if (empty($datos['id_marca']) || empty($datos['id_categoria'])) {
            throw new Exception("La marca y la categoría son obligatorias.");
        }
        return true;
    }

    // Obtener todos los productos
    function getAll() {
        $this->connect();
        $stmt = $this->conn->prepare("SELECT p.id_producto, p.nombre AS producto, p.precio, m.id_marca, m.marca, c.id_categoria, c.categoria, p.fotografia
                                      FROM producto p 
                                      LEFT JOIN marca m ON p.id_marca = m.id_marca 
                                      LEFT JOIN categoria c ON p.id_categoria = c.id_categoria 
                                      ORDER BY id_producto;");
        $stmt->execute();
        $datos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->setCount(count($datos));
        return $datos;
    }

    // Obtener un producto específico
    function getOne($id_producto) {
        $this->connect();
        $stmt = $this->conn->prepare("SELECT id_producto, nombre AS producto, precio, id_marca, id_categoria, fotografia 
                                      FROM producto 
                                      WHERE id_producto = :id_producto;");
        $stmt->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);
        $stmt->execute();
        $datos = $stmt->fetch(PDO::FETCH_ASSOC);
        $this->setCount($datos ? 1 : 0);
        return $datos;
    }

    // Insertar un nuevo producto
    function insert($datos) {
        $this->connect();
        $nombre_archivo = $this->upload('productos');
        if ($this->validateProducto($datos)) {
            // Verificar si la categoría existe
            $stmt = $this->conn->prepare("SELECT COUNT(*) FROM categoria WHERE id_categoria = :id_categoria");
            $stmt->bindParam(':id_categoria', $datos['id_categoria'], PDO::PARAM_INT);
            $stmt->execute();
            $categoria_exists = $stmt->fetchColumn() > 0;

            // Verificar si la marca existe
            $stmt = $this->conn->prepare("SELECT COUNT(*) FROM marca WHERE id_marca = :id_marca");
            $stmt->bindParam(':id_marca', $datos['id_marca'], PDO::PARAM_INT);
            $stmt->execute();
            $marca_exists = $stmt->fetchColumn() > 0;

            if ($categoria_exists && $marca_exists) {
                $stmt = $this->conn->prepare("INSERT INTO producto(nombre, precio, id_marca, id_categoria, fotografia) 
                                              VALUES (:producto, :precio, :id_marca, :id_categoria, :fotografia);");
                $stmt->bindParam(':producto', $datos['producto'], PDO::PARAM_STR);
                $stmt->bindParam(':precio', $datos['precio'], PDO::PARAM_STR);
                $stmt->bindParam(':id_marca', $datos['id_marca'], PDO::PARAM_INT);
                $stmt->bindParam(':id_categoria', $datos['id_categoria'], PDO::PARAM_INT);
                $stmt->bindParam(':fotografia', $nombre_archivo, PDO::PARAM_STR);
                $stmt->execute();
                return $stmt->rowCount();
            }
        }
        return 0;
    }

    // Actualizar un producto
    function update($id_producto, $datos) {
        $this->connect();
        $nombre_archivo = $this->upload('productos');
        if ($this->validateProducto($datos)) {
            // Verificar si la categoría existe
            $stmt = $this->conn->prepare("SELECT COUNT(*) FROM categoria WHERE id_categoria = :id_categoria");
            $stmt->bindParam(':id_categoria', $datos['id_categoria'], PDO::PARAM_INT);
            $stmt->execute();
            $categoria_exists = $stmt->fetchColumn() > 0;

            // Verificar si la marca existe
            $stmt = $this->conn->prepare("SELECT COUNT(*) FROM marca WHERE id_marca = :id_marca");
            $stmt->bindParam(':id_marca', $datos['id_marca'], PDO::PARAM_INT);
            $stmt->execute();
            $marca_exists = $stmt->fetchColumn() > 0;

            if ($categoria_exists && $marca_exists) {
                $stmt = $this->conn->prepare("UPDATE producto 
                                              SET nombre = :producto, precio = :precio, id_marca = :id_marca, id_categoria = :id_categoria, fotografia = :fotografia 
                                              WHERE id_producto = :id_producto;");
                $stmt->bindParam(':producto', $datos['producto'], PDO::PARAM_STR);
                $stmt->bindParam(':precio', $datos['precio'], PDO::PARAM_STR);
                $stmt->bindParam(':id_marca', $datos['id_marca'], PDO::PARAM_INT);
                $stmt->bindParam(':id_categoria', $datos['id_categoria'], PDO::PARAM_INT);
                $stmt->bindParam(':fotografia', $nombre_archivo, PDO::PARAM_STR);
                $stmt->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->rowCount();
            }
        }
        return 0;
    }

    // Eliminar un producto
    public function delete($id_producto) {
        $this->connect();
        try {
            $stmt = $this->conn->prepare("DELETE FROM producto WHERE id_producto = :id_producto");
            $stmt->bindParam(':id_producto', $id_producto, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }
}
?>

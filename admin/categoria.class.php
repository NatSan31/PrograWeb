<?php
require_once(__DIR__.'/sistema.class.php');

class Categoria extends Sistema
{
    function getAll()
    {
        $this->connect();
        $stmt = $this->conn->prepare("SELECT id_categoria, categoria FROM categoria;");
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $datos = $stmt->fetchAll();
        $this->setCount(count($datos));
        return $datos;
    }
    function getOne($id_categoria)
    {
        $this->connect();
        $stmt = $this->conn->prepare("SELECT id_categoria, categoria FROM categoria WHERE id_categoria = :id_categoria;");
        $stmt->bindParam(':id_categoria', $id_categoria, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $datos = $stmt->fetchAll();
        if (isset($datos[0])) {
            $this->setCount(count($datos));
            return $datos[0];
        }
        return $datos;
    }
        function insert($datos)
    {
        $this->connect();
        if ($this->validateCategoria($datos)) {
            $stmt = $this->conn->prepare("INSERT INTO categoria(categoria) VALUES (:categoria);");
            $stmt->bindParam(':categoria', $datos['categoria'], PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->rowCount();
        }
        return 0;
    }
    function delete($id_categoria)
    {
        $this->connect();
        $stmt = $this->conn->prepare("DELETE FROM categoria WHERE id_categoria = :id_categoria;");
        $stmt->bindParam(':id_categoria', $id_categoria, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->rowCount();
        return $result;
    }

    function update($id_categoria, $datos)
    {
        $this->connect();
        $stmt = $this->conn->prepare("UPDATE categoria SET categoria = :categoria WHERE id_categoria = :id_categoria;");
        $stmt->bindParam(":categoria", $datos["categoria"], PDO::PARAM_STR);
        $stmt->bindParam(':id_categoria', $id_categoria, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount();
    }

    // Validar que la categoría no esté vacía
    function validateCategoria($datos)
    {
        if (empty($datos["categoria"])) {
            return false;
        }
        return true;
    }
}
?>
